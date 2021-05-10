<?php

class Database
{
    private static $instance = null;

    public static function getPdo()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Attribut une erreur au mode silencieux de mySql
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Attribut un tableau associatif des données
            ]);
        }

        return self::$instance;
    }
}

