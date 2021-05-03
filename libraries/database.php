<?php

function getPdo(): PDO
{
    $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Attribut une erreur au mode silencieux de mySql
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Attribut un tableau associatif des données
    ]);

    return $pdo;
}