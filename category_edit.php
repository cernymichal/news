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

$category = $cr->getCategory($_GET["id"]);

if (empty($category)) {
  header("Location: category_administration.php");
  die();
}

if (isset($_POST["name"])) {
  $cr->editCategory($_GET["id"], $_POST["name"]);

  header("Location: category_administration.php");
  die();
}

$title = "Články - " . $category["name"];
$heading = $category["name"];
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/category_form.php";

include "./php/partials/document_end.php";
