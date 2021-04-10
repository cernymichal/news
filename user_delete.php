<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();
Application::assert_admin("user_administration.php");

if (empty($_GET["id"])) {
  header("Location: user_administration.php");
  die();
}

$ur = Application::context()->user_repository;
$ar = Application::context()->article_repository;

$user = $ur->getUser($_GET["id"]);

if (empty($user)) {
  header("Location: user_administration.php");
  die();
}

if (!empty($ar->getArticlesUser($user["id"]))) {
  $message = "Autor má stále články!";
  $url = "user_administration.php?error=" . rawurlencode($message);
  header("Location: $url");
  die();
}

$ur->deleteUser($user["id"]);

header("Location: user_administration.php");
die();
