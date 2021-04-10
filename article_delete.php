<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: article_administration.php");
  die();
}

$ar = Application::context()->article_repository;

$ar->deleteArticle($_GET["id"]);

header("Location: article_administration.php");
die();
