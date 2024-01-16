<?php
require_once "connection.php";

class ArticleModel extends Database
{

    public function create($title, $content, $description, $author_id, $category_id, $tags)
    {
        try {
            $this->conn->beginTransaction();

            $query = "INSERT INTO wikis (title, content,description, AuthorId,CategorieId) VALUES (:title, :content,:description, :author_id, :category_id)";
            $stmt = $this->conn->prepare($query);

            $title = htmlspecialchars(strip_tags($title));
            $content = htmlspecialchars(strip_tags($content));
            $description = htmlspecialchars(strip_tags($description));

            $author_id = htmlspecialchars(strip_tags($author_id));
            $category_id = htmlspecialchars(strip_tags($category_id));
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":content", $content);
            $stmt->bindParam(":author_id", $author_id);
            $stmt->bindParam(":category_id", $category_id);
            $stmt->bindParam(":description", $description);

            $stmt->execute();
            $articleId = $this->conn->lastInsertId();

            if (!empty($tags)) {
                $query = "INSERT INTO wikitag (WikiId, TagId) VALUES (:article_id, :tag_id)";
                $stmt = $this->conn->prepare($query);

                foreach ($tags as $tagId) {
                    $tagId = htmlspecialchars(strip_tags($tagId));
                    $stmt->bindParam(":article_id", $articleId);
                    $stmt->bindParam(":tag_id", $tagId);
                    $stmt->execute();
                }
            }

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log($e->getMessage());
            throw $e;
        }
    }
    public function getCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function read($id)
    {

        $query = "SELECT *,tags.Nom tagName FROM wikis left JOIN categories ON wikis.id = categories.id left JOIN wikitag ON wikis.id = wikitag.WikiId left JOIN tags on wikis.id= tags.id where wikis.id = :id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $content, $category_id)
    {
        $query = "UPDATE wikis SET title = :title, content = :content, CategorieId = :category_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $id = htmlspecialchars(strip_tags($id));
        $title = htmlspecialchars(strip_tags($title));
        $content = htmlspecialchars(strip_tags($content));
        $category_id = htmlspecialchars(strip_tags($category_id));

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":category_id", $category_id);

        return $stmt->execute();
    }

    public function delete($id)
    {

        $query = "DELETE FROM wikitag WHERE WikiId = :id";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(":id", $id);
        if ($stmt->execute()) {
            $query = "DELETE FROM wikis WHERE id = :id";

            $stmt = $this->conn->prepare($query);


            $id = htmlspecialchars(strip_tags($id));
            $stmt->bindParam(":id", $id);
            return $stmt->execute();
        }
        
    }
    public function getLastCategories()
    {
        $query = "SELECT * FROM categories ORDER BY id DESC LIMIT 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getArticles()
    {
        $query = "SELECT * FROM `wikis` left JOIN categories ON wikis.id = categories.id ORDER BY `wikis`.`CategorieId` ASC LIMIT 4";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCrudArticles()
    {
        $query = "SELECT wikis.*, categories.Nom AS categoryName, tags.Nom AS tagName FROM wikis LEFT JOIN categories ON wikis.CategorieId = categories.id LEFT JOIN wikitag ON wikis.id = wikitag.WikiId LEFT JOIN tags ON wikitag.TagId = tags.id;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getTag()
    {

        $query = "SELECT * FROM tags";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleById($id){
        $query = "SELECT wikis.*, categories.Nom AS categoryName, tags.Nom AS tagName,tags.id AS tagId FROM wikis LEFT JOIN categories ON wikis.CategorieId = categories.id LEFT JOIN wikitag ON wikis.id = wikitag.WikiId LEFT JOIN tags ON wikitag.TagId = tags.id WHERE wikis.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function search($search){
        $query = "SELECT * FROM wikis WHERE wikis.title LIKE '%$search%' OR wikis.content LIKE '%$search%'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
