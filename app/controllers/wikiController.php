<?php

class Article {
    private $conn;
    public $id;
    public $title;
    public $content;
    public $author_id;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to create an article
    public function create() {
        $query = "INSERT INTO articles (title, content, author_id) VALUES (:title, :content, :author_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));

        // Bind parameters
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":author_id", $this->author_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Method to read an article
    public function read() {
        $query = "SELECT * FROM articles WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameter
        $stmt->bindParam(":id", $this->id);

        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($article) {
            return $article;
        } else {
            return null;
        }
    }
    // Method to update an article
    public function update() {
        $query = "UPDATE articles SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize and bind parameters
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
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
