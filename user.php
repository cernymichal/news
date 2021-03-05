<?php

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

require_once "./php/Application.php";
Application::init();

$db = new Database();
$ar = new ArticleRepository($db);
$ur = new UserRepository($db);

$user = $ur->getUser($_GET["id"]);
$articles = $ar->getArticlesUser($_GET["id"]);

$title = "Články - " . $user["name"];
$heading = $user["name"];

include "./php/templates/article_list.php";
