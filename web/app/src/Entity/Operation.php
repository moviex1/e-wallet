<?php

namespace App\Entity;

use App\Enums\OperationType;

class Operation
{
    private \DateTimeInterface $date;
    private OperationType $operationType;
    private int $amount;
    private int $balance;
    private string $receiver;
    private string $sender;

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }

    /**
     * @param int $balance
     */
    public function setBalance(int $balance): self
    {
        $this->balance = $balance;


        return $this;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return $this->receiver;
    }

    /**
     * @param string $receiver
     */
    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;


        return $this;
    }

    /**
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * @param string $sender
     */
    public function setSender(string $sender): self
    {
        $this->sender = $sender;


        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param \DateTimeInterface $date
     */
    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return OperationType
     */
    public function getOperationType(): OperationType
    {
        return $this->operationType;
    }

    /**
     * @param OperationType $operationType
     */
    public function setOperationType(OperationType $operationType): self
    {
        $this->operationType = $operationType;

        return $this;
    }
}