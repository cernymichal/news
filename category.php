<?php

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

require_once "./php/Application.php";
Application::init();

$ar = Application::context()->article_repository;
$cr = Application::context()->category_repository;

$category = $cr->getCategory($_GET["id"]);
$articles = $ar->getArticlesCategory($_GET["id"]);

$title = "Články - " . $category["name"];
$heading = $category["name"];

include "./php/templates/article_list.php";
