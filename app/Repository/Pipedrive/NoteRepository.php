<?php

namespace App\Repository\Pipedrive;

use App\Service\Repository\RepositoryInterface;
use Devio\Pipedrive\PipedriveFacade;
use Devio\Pipedrive\Resources\Notes;

class NoteRepository implements RepositoryInterface
{
    /**
     * @var Notes
     */
    private $repository;

    /**
     * NoteRepository constructor.
     */
    public function __construct()
    {
        $this->repository = PipedriveFacade::notes();
    }

    /**
     * @param $id
     * @return \Devio\Pipedrive\Http\Response
     */
    public function getNoteById($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $content
     * @param $dealId
     * @param $personId
     * @param $orgId
     * @return \Devio\Pipedrive\Http\Response
     * @throws \Exception
     */
    public function addNote($content, $dealId, $personId, $orgId)
    {
        return $this->repository->add([
            'content'   => $content,
            'deal_id'   => $dealId,
            'person_id' => $personId,
            'org_id'    => $orgId,
            'add_time'  => (new \DateTime())->format('YYYY-MM-DD HH:MM:SS'),
        ]);
    }
}
