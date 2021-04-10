<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();
Application::assert_admin("category_administration.php");

if (empty($_GET["id"])) {
  header("Location: category_administration.php");
  die();
}

$cr = Application::context()->category_repository;
$ar = Application::context()->article_repository;

$category = $cr->getCategory($_GET["id"]);

if (empty($category)) {
  header("Location: category_administration.php");
  die();
}

if (!empty($ar->getArticlesCategory($category["id"]))) {
  $message = "Kategorie má stále články!";
  $url = "category_administration.php?error=" . rawurlencode($message);
  header("Location: $url");
  die();
}

$cr->deleteCategory($_GET["id"]);

header("Location: category_administration.php");
die();
