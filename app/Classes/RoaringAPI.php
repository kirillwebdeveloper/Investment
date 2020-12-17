<?php


namespace App\Classes;


use App\Entity\CompanyCache;
use App\Entity\Investor;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class RoaringAPI
{
    public function __construct ()
    {
        $this->client = new Client([
            'http_errors' => false,
            'base_uri'    => 'https://api.roaring.io/',
        ]);
    }

    public function authorize (): void
    {
        $requestData = [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ],
            'auth'        => [
                config('services.roaring.client_id'),
                config('services.roaring.client_secret'),
            ]
        ];

        $response = $this->client->request('POST', 'token', $requestData);
        $fetchedData = json_decode($response->getBody()->getContents());

        session(['token' => $fetchedData->access_token]);
        session(['tokenExpire' => Carbon::now()->addSeconds(3600)]);
    }

    public function sendRequest (string $url, $requestType, $parameters = []): object
    {
        if (!session('token') || session('tokenExpire') < Carbon::now()) {
            $this->authorize();
        }

        $parameters = [
            'headers' => [
                'Authorization' => 'Bearer ' . session('token')
            ]
        ];

        $response = $this->client->request($requestType, $url, $parameters);

        $fetchedData = json_decode($response->getBody()->getContents());

        $data = $response->getStatusCode() === Response::HTTP_OK
            ? $fetchedData
            : [];

        $status = [
                'Response::HTTP_NOT_FOUND' => 'Data not found',
                'Response::HTTP_BAD_REQUEST' => 'Bad request',
                'Response::HTTP_UNAUTHORIZED' => 'Unauthorized',
                'Response::HTTP_INTERNAL_SERVER_ERROR' => 'Error on API side',
                'Response::HTTP_BAD_GATEWAY' => 'Server error',
            ][$response->getStatusCode()] ?? 'ok';

        return (object)[
            'status' => $status,
            'data'   => $data
        ];
    }

    public function getPersonInformationApi ($ssn): ?object
    {
        if (!$ssn) {
            return null;
        }

        $response = $this->sendRequest('person/1.0/person?personalNumber=' . $ssn, 'GET');

        if ($response->status !== 'ok' || empty($response->data)) {
            return null;
        }

        $addressData = $response->data->posts[0]->address->nationalRegistrationAddress[0];
        $personData = $response->data->posts[0]->details[0];

        $addressDelimiter = isset($addressData->deliveryAddress1) && isset($addressData->deliveryAddress2) ? ', ' : '';

        $fullName = $personData->firstName ?? '' . ' ' . $personData->surName ?? '';
        $address = $addressData->deliveryAddress1 ?? '' . $addressDelimiter . $addressData->deliveryAddress2 ?? '';

        $data = [
            'full_name' => $fullName,
            'address'   => $address,
            'postcode'  => $addressData->postalNumber,
            'city'      => $addressData->city
        ];

        Investor::whereSsn($ssn)->update($data);

        return (object) $data;
    }

    public function getCompanyInformationApi ($companyId = null): ?object
    {
        if (!$companyId) {
            return null;
        }

        $response = $this->sendRequest('se/company/overview/1.1/' . $companyId, 'GET');

        if (empty($response->data)) return null;

        $data = [
            'name'              => $response->data->companyName,
            'address'           => $response->data->address,
            'postcode'          => $response->data->zipCode,
            'city'              => $response->data->town,
            'registration_date' => $response->data->companyRegistrationDate, // If it always in format yyyy-mm-dd,
            // Better to cut first 4 chars from that date field
            'registration_year' => Carbon::parse($response->data->companyRegistrationDate)->format('Y'),
        ];

        CompanyCache::where('company_id', $companyId)->update($data);

        return (object)  $data;
    }

    public function getPersonCompaniesApi ($ssn, $investor): array
    {
        $response = $this->sendRequest('se/company/engagement/2.0/' . $ssn, 'GET');

        if (!isset($response->data, $response->data->engagements)) {
            return [];
        }

        $company = $this->getCompaniesArray($response->data->engagements);

        if  (!isset($company['db_ids'])){
            return [];
        }

        $investor
            ->companies()
            ->detach();

        $investor
            ->companies()
            ->attach($company['db_ids']);

        return $company['data'];
    }

    public function getCompaniesArray ($companies): array
    {
        if (!$companies) {
            return [];
        }

        $result = [];

        foreach ($companies as $company) {
            $result['data'][$company->companyId] = $company->companyName;
            $result['db_ids'][] = CompanyCache::updateOrCreate(
                                        ['company_id'=> $company->companyId],
                                        ['name'=> $company->companyName]
                                    )->id;
        }

        return $result;
    }
}
