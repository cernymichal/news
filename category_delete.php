<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: category_administration.php");
  die();
}

$db = new Database();
$cr = new CategoryRepository($db);

$cr->deleteCategory($_GET["id"]);

header("Location: category_administration.php");
die();
