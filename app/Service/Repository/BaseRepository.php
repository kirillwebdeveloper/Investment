<?php

namespace App\Service\Repository;

class BaseRepository
{
    protected $repositories;

    public function __construct()
    {
        $this->repositories = config('repositories');
    }

    /**
     * @param RepositoryInterface $repository
     * @return RepositoryInterface
     */
    public function get(string $repository)
    {
        $this->boot($repository);

        return app()->get($repository);
    }

    public function boot($repository)
    {
        if(in_array($repository,$this->repositories)) {
            app()->singleton($repository, function () use ($repository) {

                return new $repository();
            });
        }
    }
}
