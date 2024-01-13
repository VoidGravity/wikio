<?php

class Article
{
    private $conn;
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $created_at;
    public $updated_at;
    public $CategorieId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to create an article
    public function create($tags)
    {
        $this->conn->beginTransaction();

        try {
            // Insert into wikis table
            $query = "INSERT INTO wikis (title, content, Author_id, CategorieId) VALUES (:title, :content, :author_id, :CategorieId)";
            $stmt = $this->conn->prepare($query);

            // Sanitize and bind wikis parameters
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->content = htmlspecialchars(strip_tags($this->content));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->CategorieId = htmlspecialchars(strip_tags($this->CategorieId));

            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":content", $this->content);
            $stmt->bindParam(":author_id", $this->author_id);
            $stmt->bindParam(":CategorieId", $this->CategorieId);

            $stmt->execute();
            $wikiId = $this->conn->lastInsertId(); // Get the ID of the newly created wiki

            // Insert tags into wikitag table
            $query = "INSERT INTO wikitag (WikiId, TagId) VALUES (:WikiId, :TagId)";
            $stmt = $this->conn->prepare($query);

            // Bind wikitag parameters and insert each tag
            foreach ($tags as $tagId) {
                // Sanitize each tagId just to be safe
                $tagId = htmlspecialchars(strip_tags($tagId));
                $stmt->bindParam(":WikiId", $wikiId);
                $stmt->bindParam(":TagId", $tagId);
                $stmt->execute();
            }

            $this->conn->commit(); // Commit the transaction
            return true;
        } catch (Exception $e) {
            // An error occurred; rollback the transaction
            $this->conn->rollBack();
            // Log the error or send a message to the developer
            error_log($e->getMessage());
            return false;
        }
    }
    // Method to read an article
    public function read()
    {
        $query = "SELECT * FROM wikis WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row['title'];
        $this->content = $row['content'];
        $this->author_id = $row['Author_id'];
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
        $this->CategorieId = $row['CategorieId'];
    }
    // Method to update an article
    public function update()
    {
        $query = "UPDATE wikis SET title = :title, content = :content, CategorieId = :CategorieId WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize and bind parameters
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->CategorieId = htmlspecialchars(strip_tags($this->CategorieId));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":CategorieId", $this->CategorieId);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to delete an article
    public function delete()
    {
        $query = "DELETE FROM wikis WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize and bind parameter
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    // Methods for read, update, and delete operations
    // ...
}
