<?php

namespace App\Helpers;

use App\Controller\OperationController;
use App\Mapper\OperationMapper\OperationFromObjectMapper;
use App\Mapper\OperationMapper\OperationFromRequestMapper;
use App\Repository\OperationRepository\DatabaseOperationRepository;
use App\Repository\OperationRepository\OperationRepository;

class Container
{
    private array $objects;

    public function __construct()
    {
        $this->objects = [
            Router::class => fn() => new Router($this),
            OperationController::class => fn() => new OperationController(new OperationFromRequestMapper(), $this->get(OperationRepository::class)),
            OperationRepository::class => fn() => new DatabaseOperationRepository(new OperationFromObjectMapper())
        ];
    }

    public function get(string $class): mixed
    {
        if (isset($this->objects[$class])) {
            return $this->objects[$class]();
        }

        return false;
    }

}