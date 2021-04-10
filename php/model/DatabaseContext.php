<?php

class DatabaseContext
{
    private $database;
    private $article_repository;
    private $category_repository;
    private $comment_repository;
    private $user_repository;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function __get($name)
    {
        if (!isset($this->{$name})) {
            switch ($name) {
                case "article_repository":
                    $this->article_repository = new ArticleRepository($this->database);
                case "category_repository":
                    $this->category_repository = new CategoryRepository($this->database);
                case "comment_repository":
                    $this->comment_repository = new CommentRepository($this->database);
                case "user_repository":
                    $this->user_repository = new UserRepository($this->database);
            }
        }

        return $this->{$name};
    }
}
