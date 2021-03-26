<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: user_administration.php");
  die();
}

$db = new Database();
$ur = new UserRepository($db);
$ar = new ArticleRepository($db);

if (!empty($ar->getArticlesUser($_GET["id"]))) {
  $message = "Autor má stále články!";
  $url = "user_administration.php?error=" . rawurlencode($message);
  header("Location: $url");
  die();
}

$ur->deleteUser($_GET["id"]);

header("Location: user_administration.php");
die();
