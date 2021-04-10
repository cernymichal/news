<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$cr = Application::context()->category_repository;

if (isset($_POST["name"])) {
  $cr->editCategory($_GET["id"], $_POST["name"]);

  header("Location: category_administration.php");
  die();
}

$category = $cr->getCategory($_GET["id"]);

if ($category === false) {
  header("Location: index.php");
  die();
}

$title = "Články - " . $category["name"];
$heading = $category["name"];
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/category_form.php";

include "./php/partials/document_end.php";
