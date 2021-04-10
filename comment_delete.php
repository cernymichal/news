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

$cr->deleteComment($_GET["id"]);

header("Location: article_comments.php?id=" . $comment["article_id"]);
die();
