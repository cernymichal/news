<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: administration.php");
  die();
}

$db = new Database();
$ar = new ArticleRepository($db);

$article = $ar->deleteArticle($_GET["id"]);

header("Location: administration.php");
die();
