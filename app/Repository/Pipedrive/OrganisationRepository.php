<?php

namespace App\Repository\Pipedrive;

use App\Service\Repository\RepositoryInterface;
use Devio\Pipedrive\PipedriveFacade;
use Devio\Pipedrive\Resources\Organizations;

class OrganisationRepository implements RepositoryInterface
{
    /**
     * @var Organizations
     */
    private $repository;

    public function __construct()
    {
        $this->repository = PipedriveFacade::organizations();
    }

    public function getAllOrganisations()
    {
        return $this->repository->all();
    }

    public function getOrganisationById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $name
     * @return \Devio\Pipedrive\Http\Response
     */
    public function addOrganisation($name)
    {
        return $this->repository->add([
            'name' => $name
        ]);
    }

    /**
     * @param $name
     * @return \Devio\Pipedrive\Http\Response
     */
    public function getOrganisationByName($name)
    {
        return $this->repository->findByName($name);
    }
}
