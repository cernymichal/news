<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: category_administration.php");
  die();
}

$db = new Database();
$cr = new CategoryRepository($db);
$ar = new ArticleRepository($db);

if (!empty($ar->getArticlesCategory($_GET["id"]))) {
  $message = "Kategorie má stále články!";
  $url = "category_administration.php?error=" . rawurlencode($message);
  header("Location: $url");
  die();
}

$cr->deleteCategory($_GET["id"]);

header("Location: category_administration.php");
die();
