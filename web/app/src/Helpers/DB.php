<?php

namespace App\Helpers;

class DB
{
    private static ?\PDO $pdo = null;

    private function __construct(\PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getInstance(): \PDO
    {
        if (self::$pdo === null) {
            $dsn = sprintf(
                '%s:host=%s;port=%s;dbname=%s',
                $_ENV['DB_DRIVER'],
                $_ENV['DB_HOST'],
                $_ENV["DB_PORT"],
                $_ENV['DB_NAME']
            );
            self::$pdo = new \PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
        }

        return self::$pdo;
    }

    public static function createQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder(self::getInstance());
    }
}