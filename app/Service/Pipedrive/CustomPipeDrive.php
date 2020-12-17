<?php

namespace App\Service\Pipedrive;

use App\Http\Requests\ContactRequest;
use App\Repository\Pipedrive\DealRepository;
use App\Repository\Pipedrive\NoteRepository;
use App\Repository\Pipedrive\OrganisationRepository;
use App\Repository\Pipedrive\PersonRepository;
use App\Service\Repository\BaseRepository;
use Devio\Pipedrive\Http\Response;

class CustomPipeDrive
{
    /**
     * @var NoteRepository
     */
    protected $noteRepository;

    /**
     * @var OrganisationRepository
     */
    protected $organisationRepository;

    /**
     * @var PersonRepository
     */
    protected $personRepository;

    /**
     * @var DealRepository
     */
    protected $dealRepository;

    /**
     * @var string
     */
    protected $orgName;

    public function __construct(
        BaseRepository $baseRepository
    )
    {
        $this->noteRepository         = $baseRepository->get(NoteRepository::class);
        $this->organisationRepository = $baseRepository->get(OrganisationRepository::class);
        $this->personRepository       = $baseRepository->get(PersonRepository::class);
        $this->dealRepository         = $baseRepository->get(DealRepository::class);
        $this->orgName                = config('services.pipedrive.name_org');
    }

    /**
     * @param ContactRequest $request
     * @return bool|Object
     * @throws \Exception
     */
    public function createDeal(ContactRequest $request)
    {
        $name     = $request->get('name');
        $email    = $request->get('email');
        $phone    = $request->get('phone');
        $ssnInput = $request->get('ssn-input');
        $orderId  = $request->get('order-id');
        $message  = $request->get('message');

        /** @var Response $pipePersonResponse */
        $pipePersonResponse = $this->personRepository->getPersonByEmail($email);
        /** @var Response $pipeOrgResponse */
        $pipeOrgResponse    = $this->organisationRepository->getOrganisationByName($this->orgName);

        if (!$pipePersonResponse->isSuccess() || !$pipeOrgResponse->isSuccess()) return false;

        if (empty($pipeOrgResponse->getData())) {
            $pipeOrgResponse = $this->organisationRepository->addOrganisation($this->orgName);
            $pipeOrg         = $pipeOrgResponse->getData();
        } else {
            $pipeOrg         = $pipeOrgResponse->getData()[0];
        }

        if (empty($pipePersonResponse->getData())) {
            $pipePersonResponse = $this->personRepository->addPerson($name, $pipeOrg->id, $email, $phone);
            $pipePerson         = $pipePersonResponse->getData();
        } else {
            $pipePerson         = $pipePersonResponse->getData()[0];
        }

        /** @var Response $pipeDealResponse */
        $pipeDealResponse = $this->dealRepository->createDeal(
            'Contact ' . $name,
            $pipePerson->id,
            $pipeOrg->id
        );

        if (!$pipeDealResponse->isSuccess() || empty($pipeDealResponse->getData())) return false;

        $pipeDeal = $pipeDealResponse->getData();

        /** @var Response $pipeNoteResponse */
        $pipeNoteResponse = $this->noteRepository->addNote(
            view('email.pipe.note', [
                'name'    => $name,
                'email'   => $email,
                'phone'   => $phone,
                'ssn'     => $ssnInput,
                'orderId' => $orderId,
                'message' => $message,
            ])->render(), $pipeDeal->id, $pipePerson->id, $pipeOrg->id
        );

        return $pipeDeal;
    }
}
