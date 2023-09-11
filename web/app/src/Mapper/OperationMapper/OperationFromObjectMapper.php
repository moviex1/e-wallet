<?php

namespace App\Mapper\OperationMapper;

use App\Entity\Operation;
use App\Enums\OperationType;

class OperationFromObjectMapper implements OperationMapper
{
    private ?object $stdOperation = null;

    public function setStdOperation(object $stdOperation): self
    {
        $this->stdOperation = $stdOperation;

        return $this;
    }

    public function map(): Operation
    {
        if($this->stdOperation === null){
            throw new \LogicException('You forgot to add stdOperation');
        }

        $operation = new Operation();
        $operation->setOperationType(OperationType::fromName($this->stdOperation->operation))
            ->setSender($this->stdOperation->sender)
            ->setReceiver($this->stdOperation->receiver)
            ->setBalance($this->stdOperation->balance)
            ->setAmount($this->stdOperation->amount)
            ->setDate(new \DateTime($this->stdOperation->date));

        return $operation;
    }
}