<?php
require_once __DIR__ . '/../model/article.php';
require_once __DIR__ . '/../helpers/functions.php';

class ArticleController
{
    private $articleModel;


    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

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
                header('Location: ../views/pages/editeAuthorWiki.php?status=updatesuccess&EAWid='.$id);
            } else {
                header('Location: ../views/pages/editeAuthorWiki.php?status=updateerror&EAWid='.$id);
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
    public function getCategorieCount()
    {
        $catcount = $this->articleModel->getCategorieCount();
        return $catcount;
    }
    public function getWikiCount()
    {
        $artcount = $this->articleModel->getWikiCount();
        return $artcount;
    }
    
    public function getTagCount()
    {
        $tagcount = $this->articleModel->getTagCount();
        return $tagcount;
    }
    public function getUserCount()
    {
        $usercount = $this->articleModel->getUserCount();
        return $usercount;
    }
    public function getTags()
    {
        $tags = $this->articleModel->getTags();
        return $tags;
    }
    public function getCategories()
    {
        $tags = $this->articleModel->getCategories();
        return $tags;
    }
    public function getTagById($id)
    {
        $tag = $this->articleModel->getTagById($id);
        return $tag;
    }
    public function getCatById($id)
    {
        $tag = $this->articleModel->getCatById($id);
        return $tag;
    }
    public function delateTags($id){
        
           
            
            $result = $this->articleModel->delateTags($id);
            if ($result) {
                header('Location:../views/pages/tags.php?status=deletesuccess&EAWid='.$id);
            } else {
                header('Location:../views/pages/tags.php?status=deleteerror&EAWid='.$id);
            }
    }
    public function delateCat($id){
        
           
            
            $result = $this->articleModel->delateCat($id);
            if ($result) {
                header('Location:../views/pages/categories.php?status=deletesuccess&EAWid='.$id);
            } else {
                header('Location:../views/pages/categories.php?status=deleteerror&EAWid='.$id);
            }
    }
    public function editTags($id,$tag){
        $result = $this->articleModel->editTag($id,$tag);
        if ($result) {
            header('Location: ../views/pages/dashboard.php?status=updatesuccess&EAWid='.$id);
        } else {
            header('Location: ../views/pages/editeAuthorWiki.php?status=updateerror&EAWid='.$id);
        }
        
    }
    public function editCat($id,$tag){
        $result = $this->articleModel->editCat($id,$tag);
        if ($result) {
            header('Location: ../views/pages/dashboard.php?status=updatesuccess&EAWid='.$id);
        } else {
            header('Location: ../views/pages/editeAuthorWiki.php?status=updateerror&EAWid='.$id);
        }
        
    }
    public function addTag($tag){
        $result = $this->articleModel->addTag($tag);
        if ($result) {
            header('Location: ../views/pages/dashboard.php?status=updatesuccess&EAWid='.$tag);
        } else {
            header('Location: ../views/pages/editeAuthorWiki.php?status=updateerror&EAWid='.$tag);
        }
        
    }
    public function addCat($cat){
        $result = $this->articleModel->addCat($cat);
        if ($result) {
            header('Location: ../views/pages/dashboard.php?status=updatesuccess&EAWid='.$cat);
        } else {
            header('Location: ../views/pages/editeAuthorWiki.php?status=updateerror&EAWid='.$cat);
        }
        
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

    public function getArticleById($id)
    {
        $article = $this->articleModel->getArticleById($id);
        return $article;
    }

public  function search($search){
    $search = sanitize($search);
    $search = "%$search%";
    $articles = $this->articleModel->search($search);
    return $articles;
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

if (isset($_POST['updateArticle'])) {
    $article = new ArticleController();
    $article->update();
}

if (isset($_GET['action']) && $_GET['action'] == 'search') {
    $article = new ArticleController();
    echo json_encode($article->search($_GET['value']));
}

if (isset($_GET["tagId"])) {
    $id = $_GET["tagId"];
    $tag = $_POST["TagName"];
    $article = new ArticleController();
    $article->editTags($id,$tag);
}
if (isset($_GET["catId"])) {
    $id = $_GET["catId"];
    $tag = $_POST["CatName"];
    $article = new ArticleController();
    //make the new model
    $article->editCat($id,$tag);
}
if (isset($_GET["TagDelate"])) {
    $id = $_GET["TagDelate"];
    $article = new ArticleController();
    $article->delateTags($id);
}
if (isset($_GET["CatDelate"])) {
    $id = $_GET["CatDelate"];
    $article = new ArticleController();
    $article->delateCat($id);
}
if (isset($_POST["addTag"])) {
    $tag = $_POST["TagName"];
    $article = new ArticleController();
    $article->addTag($tag);
}
if (isset($_POST["addCategory"])) {
    $tag = $_POST["CategoryName"];
    $article = new ArticleController();
    $article->addCat($tag);
}