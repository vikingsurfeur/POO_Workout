<?php

namespace Models;

class Article extends Model
{
    protected string $table = 'articles';

    public function getAllArticles(): array
    {
        // On utilisera ici la méthode query (pas besoin de préparation car aucune variable n'entre en jeu)
        $resultats = $this->pdo->query("SELECT * FROM articles ORDER BY created_at DESC");

        // On fouille le résultat pour en extraire les données réelles
        return $resultats->fetchAll();
    }
}