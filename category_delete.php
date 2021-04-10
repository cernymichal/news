<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: category_administration.php");
  die();
}

$cr = Application::context()->category_repository;
$ar = Application::context()->article_repository;

if (!empty($ar->getArticlesCategory($_GET["id"]))) {
  $message = "Kategorie má stále články!";
  $url = "category_administration.php?error=" . rawurlencode($message);
  header("Location: $url");
  die();
}

$cr->deleteCategory($_GET["id"]);

header("Location: category_administration.php");
die();
