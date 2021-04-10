<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: article_administration.php");
  die();
}

$cr = Application::context()->comment_repository;

$comment = $cr->getComment($_GET["id"]);

if (empty($comment)) {
  header("Location: article_administration.php");
  die();
}

$article = Application::context()->article_repository->getArticle($comment["article_id"]);

if ($article["user_id"] != Application::user()["id"]) {
  Application::assert_admin("article_administration.php");
}

$cr->deleteComment($comment["id"]);

header("Location: article_comments.php?id=" . $comment["article_id"]);
die();
