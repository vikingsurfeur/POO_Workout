<?php

namespace Models;
require_once ('./libraries/database.php');
abstract class Model
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = getPdo();
    }

    public function delete(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM {$table} WHERE id = :id');

        $query->execute(['id' => $id]);
    }
}