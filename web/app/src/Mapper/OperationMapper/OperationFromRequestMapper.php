<?php

namespace App\Mapper\OperationMapper;

use App\Entity\Operation;
use App\Enums\OperationType;

class OperationFromRequestMapper implements OperationMapper
{
    public function map(): Operation
    {
        $operation = new Operation();
        $operation->setOperationType(OperationType::fromName($_POST['operation']))
            ->setSender($_POST['sender'])
            ->setReceiver($_POST['receiver'])
            ->setAmount($_POST['amount'])
            ->setBalance($_POST['balance']);

        return $operation;
    }
}