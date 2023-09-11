<?php

namespace App\Enums;

enum OperationType: string
{
    case Credit = 'Credit';
    case Debit = 'Debit';
    case Deposit = 'Deposit';
    case Withdraw = 'Withdraw';

    public static function fromName(string $name): self|null
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        return null;
    }
}