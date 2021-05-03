<?php

require_once 'libraries/database.php';
abstract class Model
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = getPdo();
    }
}