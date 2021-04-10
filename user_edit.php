<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: user_administration.php");
  die();
}

$ur = Application::context()->user_repository;

$user = $ur->getUser($_GET["id"]);

if (empty($user)) {
  header("Location: user_administration.php");
  die();
}

if ($user["id"] != Application::user()["id"]) {
  Application::assert_admin("user_administration.php");
}

if (isset($_POST["email"], $_POST["password"], $_POST["name"])) {
  $_POST["admin"] = isset($_POST["admin"]) && Application::admin() ? 1 : 0;

  $ur->editUser($user["id"], $_POST["email"], $_POST["password"], $_POST["name"], $_POST["admin"]);

  header("Location: user_administration.php");
  die();
}

$title = "Články - " . $user["name"];
$heading = $user["name"];
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/user_form.php";

include "./php/partials/document_end.php";
