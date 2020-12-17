<?php

namespace App\Repository\Pipedrive;

use App\Service\Repository\RepositoryInterface;
use Devio\Pipedrive\PipedriveFacade;
use Devio\Pipedrive\Resources\Persons;
use Devio\Pipedrive\Resources\PersonFields;

class PersonRepository implements RepositoryInterface
{
    /**
     * @var Persons
     */
    private $repository;

    /**
     * @var PersonFields
     */
    private $repositoryPersonFields;

    /**
     * PersonRepository constructor.
     */
    public function __construct()
    {
        $this->repository             = PipedriveFacade::persons();
        $this->repositoryPersonFields = PipedriveFacade::personFields();
    }

    /**
     * @param $id
     * @return \Devio\Pipedrive\Http\Response
     */
    public function getPersonById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $email
     * @return \Devio\Pipedrive\Http\Response
     */
    public function getPersonByEmail($email)
    {
        return $this->repository->findByName(
            $email,
            [
                'search_by_email' => true
            ]
        );
    }

    /**
     * @param $name
     * @param $orgId
     * @param $email
     * @param $phone
     * @return \Devio\Pipedrive\Http\Response
     * @throws \Exception
     */
    public function addPerson($name, $orgId, $email, $phone)
    {
        return $this->repository->add([
            'name'   => $name,
            'org_id' => $orgId,
            'email'  => [$email],
            'phone'  => [$phone],
            'add_time' => (new \DateTime())->format('YYYY-MM-DD HH:MM:SS')
        ]);
    }

    /**
     * @param $ssn
     * @return \Devio\Pipedrive\Http\Response
     */
    public function addSsn($ssn)
    {
        return $this->repositoryPersonFields->add([
            'name'       => 'ssn',
            'options'    => $ssn,
            'field_type' => 'varchar'
        ]);
    }

    /**
     * @return \Devio\Pipedrive\Http\Response
     */
    public function getAllFields()
    {
        return $this->repositoryPersonFields->all();
    }
}
