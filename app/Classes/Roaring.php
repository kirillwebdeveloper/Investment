<?php

namespace App\Classes;

use App\Entity\CompanyCache;
use App\Entity\Investor;
use Carbon\Carbon;

class Roaring
{
    public function __construct()
    {
        $this->monthAgo     = Carbon::now()->subMonth(5)->toDateTimeString();
        $this->roaringAPI   = new RoaringAPI();
    }

    public function getPersonInformation($ssn): ?object
    {
        $investor = Investor::whereSsn($ssn)->where('updated_at','>=',$this->monthAgo)->first();
        if (isset($investor->city)){
            return (object) $investor->toArray();
        }
        return $this->roaringAPI->getPersonInformationApi($ssn);
    }


    public function getPersonCompanies($ssn): array
    {
        $investor   = Investor::whereSsn($ssn)->first();
        $company    = $investor->companies();

        if (
            $company->count() <= 0
            || $company->where('company_cache_investor.updated_at','<=', $this->monthAgo)->count() > 0
        ) {
            $company = $this->roaringAPI->getPersonCompaniesApi($ssn, $investor);
            return $company;
        }

        return $investor->companies->pluck('name','company_id')->toArray();
    }

    public function getCompanyInformation ($companyId = null): ?object
    {
        $company =  CompanyCache::whereCompanyId($companyId)->where('updated_at','>=',$this->monthAgo)->first();

        if (isset($company->registration_year)){
            return (object) $company->toArray();
        }
        return  $this->roaringAPI->getCompanyInformationApi($companyId);
    }

}
