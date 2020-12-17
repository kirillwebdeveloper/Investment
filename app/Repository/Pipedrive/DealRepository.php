<?php

namespace App\Repository\Pipedrive;

use App\Service\Repository\RepositoryInterface;
use Devio\Pipedrive\PipedriveFacade;
use Devio\Pipedrive\Resources\Deals;

class DealRepository implements RepositoryInterface
{
    public const OPEN    = 'open';
    public const WON     = 'won';
    public const LOST    = 'lost';
    public const DELETED = 'deleted';

    /**
     * @var Deals
     */
    private $repository;

    /**
     * DealRepository constructor.
     */
    public function __construct()
    {
        $this->repository = PipedriveFacade::deals();
    }

    /**
     * @param $title
     * @param $personId
     * @param $orgId
     * @param string $status
     * @return \Devio\Pipedrive\Http\Response
     * @throws \Exception
     */
    public function createDeal($title, $personId, $orgId, $status = self::OPEN)
    {
        return $this->repository->add([
            'title'     => $title,
            'person_id' => $personId,
            'org_id'    => $orgId,
            'status'    => $status,
            'add_time'  => (new \DateTime())->format('YYYY-MM-DD HH:MM:SS')
        ]);
    }
}
