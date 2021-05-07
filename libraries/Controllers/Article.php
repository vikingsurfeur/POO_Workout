<?php

namespace Controllers;

use Models\Comment;

require_once './libraries/utils.php';

class Article extends Controller
{
    protected string $modelName = \Models\Article::class;

    public function index()
    {
    // Sert à afficher la liste des articles et l'index
        /**
         * CE FICHIER A POUR BUT D'AFFICHER LA PAGE D'ACCUEIL !
         *
         * On va donc se connecter à la base de données, récupérer les articles du plus récent au plus ancien (SELECT * FROM articles ORDER BY created_at DESC)
         * puis on va boucler dessus pour afficher chacun d'entre eux
         */

        /**
         * 2. Récupération des articles
         */
        $articles = $this->model->getAllArticles();

        /**
         * 3. Affichage
         */
        $pageTitle = "Accueil";

        render('articles/index', compact('pageTitle', 'articles'));


    }

    public function show()
    {
    // Sert à afficher un article
        $commentModel = new Comment();

        /**
         * CE FICHIER DOIT AFFICHER UN ARTICLE ET SES COMMENTAIRES !
         *
         * On doit d'abord récupérer le paramètre "id" qui sera présent en GET et vérifier son existence
         * Si on n'a pas de param "id", alors on affiche un message d'erreur !
         *
         * Sinon, on va se connecter à la base de données, récupérer les commentaires du plus ancien au plus récent (SELECT * FROM comments WHERE article_id = ?)
         *
         * On va ensuite afficher l'article puis ses commentaires
         */

        /**
         * 1. Récupération du param "id" et vérification de celui-ci
         */
// On part du principe qu'on ne possède pas de param "id"
        $article_id = null;

// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $article_id = $_GET['id'];
        }

// On peut désormais décider : erreur ou pas ?!
        if (!$article_id) {
            die("Vous devez préciser un paramètre `id` dans l'URL !");
        }

        /**
         * 3. Récupération de l'article en question
         * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
         * jamais confiance à ce connard d'utilisateur ! :D
         */
        $article = $this->model->find($article_id);

        /**
         * 4. Récupération des commentaires de l'article en question
         * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
         */
        $commentaires = $commentModel->getAllComments($article_id);

        /**
         * 5. On affiche
         */
        $pageTitle = $article['title'];

        render('articles/show', compact('pageTitle', 'article', 'commentaires', 'article_id'));
    }

    public function delete()
    {
        /**
         * DANS CE FICHIER, ON CHERCHE A SUPPRIMER L'ARTICLE DONT L'ID EST PASSE EN GET
         *
         * Il va donc falloir bien s'assurer qu'un paramètre "id" est bien passé en GET, puis que cet article existe bel et bien
         * Ensuite, on va pouvoir effectivement supprimer l'article et rediriger vers la page d'accueil
         */

        /**
         * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
         */
        if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
            die("Ho ?! Tu n'as pas précisé l'id de l'article !");
        }

        $id = $_GET['id'];

        /**
         * 3. Vérification que l'article existe bel et bien
         */
        $article = $this->model->find($id);
        if (!$article) {
            die("L'article $id n'existe pas, vous ne pouvez donc pas le supprimer !");
        }

        /**
         * 4. Réelle suppression de l'article
         */
        $this->model->delete($id);

        /**
         * 5. Redirection vers la page d'accueil
         */
        redirect('index.php');
    }
}