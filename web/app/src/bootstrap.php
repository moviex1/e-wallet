<?php

use App\Helpers\DB;

$queryBuilder = DB::createQueryBuilder();

$migrations = [
    \App\Migrations\Migration_1::class
];

foreach ($migrations as $migration) {
    call_user_func_array("$migration::up", [$queryBuilder]);
}
