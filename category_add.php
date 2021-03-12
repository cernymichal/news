<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();

if (isset($_POST["name"])) {
  $cr = new CategoryRepository($db);
  $cr->addCategory($_POST["name"]);

  header("Location: category_administration.php");
  die();
}

$heading = "Přidat kategorii";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/category_form.php";

include "./php/partials/document_end.php";
