<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: article_administration.php");
  die();
}

$ar = Application::context()->article_repository;

$article = $ar->getArticle($_GET["id"]);

if (empty($article)) {
  header("Location: article_administration.php");
  die();
}

if ($article["user_id"] != Application::user()["id"]) {
  Application::assert_admin("article_administration.php");
}

$ar->deleteArticle($article["id"]);

header("Location: article_administration.php");
die();
