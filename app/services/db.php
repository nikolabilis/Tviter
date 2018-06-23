<?php

declare(strict_types=1);

function createDbConnection(): ?PDO{
    try {
        $dsn = 'mysql:dbname=oipa-projekt;'
            . 'host=oipa-db;charset=utf8';

        $db = new PDO(
            $dsn,
            'root',
            'oipa-password',
            [
                PDO::ATTR_DEFAULT_FETCH_MODE =>
                    PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE =>
                    PDO::ERRMODE_EXCEPTION
            ]
        );
    } catch (PDOException $e) { throw $e; }
    return $db;
}


