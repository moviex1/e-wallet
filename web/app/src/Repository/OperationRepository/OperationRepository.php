<?php

namespace App\Repository\OperationRepository;

use App\Entity\Operation;

interface OperationRepository
{
    public function addOperation(Operation $operation);
}