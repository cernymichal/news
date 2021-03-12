<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();

if (isset($_POST["email"], $_POST["password"], $_POST["name"])) {
  $ur = new UserRepository($db);

  $ur->addUser($_POST["email"], $_POST["password"], $_POST["name"]);

  header("Location: user_administration.php");
  die();
}

$heading = "Přidat autora";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/user_form.php";

include "./php/partials/document_end.php";
