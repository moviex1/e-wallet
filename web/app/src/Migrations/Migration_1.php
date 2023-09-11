<?php

namespace App\Migrations;

use App\Helpers\QueryBuilder;

class Migration_1 implements Migration
{
    public static function up(QueryBuilder $queryBuilder): void
    {
        $queryBuilder->addSQL("CREATE TABLE IF NOT EXISTS operations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            operation ENUM ('Credit', 'Debit', 'Deposit', 'Withdraw') NOT NULL,
            amount INT NOT NULL,
            balance INT NOT NULL,
            date DATETIME NOT NULL,
            receiver VARCHAR(255) NOT NULL,
            sender VARCHAR(255) NOT NULL
        )"
        )->getQuery();
    }
}