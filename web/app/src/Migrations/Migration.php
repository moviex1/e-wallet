<?php

namespace App\Migrations;

use App\Helpers\QueryBuilder;

interface Migration
{
    public static function up(QueryBuilder $queryBuilder): void;
}