<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: article_administration.php");
  die();
}

$db = new Database();
$ar = new ArticleRepository($db);

$ar->deleteArticle($_GET["id"]);

header("Location: article_administration.php");
die();
