<?php
require_once __DIR__ . '/../model/article.php';


include __DIR__ . '/../helpers/functions.php';

class ArticleController
{
    private $articleModel;


    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }
    // public function __construct($db) {
    //     $this->articleModel = new ArticleModel($db);
    // }


    // Method to create an article
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['createArticle'])) {
            // It's assumed that you have a separate sanitize function to handle input data
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            session_start();
            $author_id = $_SESSION['user_id'];
            $category_id = sanitize($_POST['CategorieId']);
            $description = sanitize($_POST['addDescription']);
            $tags = array_map('sanitize', $_POST['tags']); // Apply the sanitize function to each tag

            $result = $this->articleModel->create($title, $content, $description, $author_id, $category_id, $tags);

            if ($result) {
                header('Location: ../views/pages/authorWiki.php?status=success');
            } else {
                header('Location: ../index.php?status=error');
            }
        }
    }

    public function read($id)
    {
        $id = sanitize($id);
        $article = $this->articleModel->read($id);

        if ($article) {
            return $article;
        } else {
            header('Location: ../index.php?status=notfound');
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateArticle'])) {
            $id = sanitize($_POST['id']);
            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $category_id = sanitize($_POST['CategorieId']);

            $result = $this->articleModel->update($id, $title, $content, $category_id);

            if ($result) {
                header('Location: ../index.php?status=updatesuccess');
            } else {
                header('Location: ../index.php?status=updateerror');
            }
        }
    }
    public function getCategoriesForView()
    {
        return $this->articleModel->getCategories();
    }
    public function getTagforView()
    {
        return $this->articleModel->getTag();
    }

    public function getNoSideBarData()
    {
        $data = [
            'articles' => $this->articleModel->getArticles(),
            'articlesCrud' => $this->articleModel->getCrudArticles(),
            'categories' => $this->articleModel->getLastCategories()
        ];
        return $data;
    }

    public function delete($id)
    {
        // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteArticle'])) {
            // $id = sanitize($_POST['id']);

            $result = $this->articleModel->delete($id);

            if ($result) {
                header('Location: ../views/pages/authorWiki.php?status=deletesuccess');
            } else {
                header('Location: ../index.php?status=deleteerror');
            }
        // }
    }
}
if (isset($_POST['createArticle'])) {
    $article = new ArticleController();
    $article->create();
}
if (isset($_GET['DAWid'])) {
    $id = $_GET['DAWid'];
    $article = new ArticleController();
    $article->delete($id);
}
