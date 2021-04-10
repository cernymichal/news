<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();
Application::assert_admin("user_administration.php");

if (isset($_POST["email"], $_POST["password"], $_POST["name"])) {
  $ur = Application::context()->user_repository;

  $_POST["admin"] = isset($_POST["admin"]) && Application::admin() ? 1 : 0;

  if (!empty($ur->getUserEmail($_POST["email"]))) {
    $message = "Tento email už je zaregistrovaný!";
    $url = "user_administration.php?error=" . rawurlencode($message);
    header("Location: $url");
    die();
  } else {
    $ur->addUser($_POST["email"], $_POST["password"], $_POST["name"], $_POST["admin"]);

    header("Location: user_administration.php");
    die();
  }
}

$heading = "Přidat autora";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/user_form.php";

include "./php/partials/document_end.php";
