<?php

namespace Models;

class Comment extends Model
{
    protected string $table = 'comments';

    public function getAllComments(int $article_id): array
    {
        $query = $this->pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        // On exécute la requête en précisant le paramètre :article_id
        $query->execute(['article_id' => $article_id]);

        // On fouille le résultat pour en extraire les données réelles de l'article
        $commentaires = $query->fetchAll();

        return $commentaires;
    }

    public function saveComment(string $author, string $content, int $article_id): void
    {
        $query = $this->pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');

        $query->execute(compact('author', 'content', 'article_id'));
    }
}