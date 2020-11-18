<?php
namespace App;

use \PDO;

class Connection {

    public static function getPDO(): PDO
    {
        return new PDO('mysql:dbname=tpblog;host=127.0.0.1', 'root', 'toortoor', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}