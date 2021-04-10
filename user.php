<?php

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

require_once "./php/Application.php";
Application::init();

$ar = Application::context()->article_repository;
$ur = Application::context()->user_repository;

$user = $ur->getUser($_GET["id"]);
$articles = $ar->getArticlesUser($_GET["id"]);

$title = "Články - " . $user["name"];
$heading = $user["name"];

include "./php/templates/article_list.php";
