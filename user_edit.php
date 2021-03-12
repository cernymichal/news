<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$db = new Database();
$ur = new UserRepository($db);

if (isset($_POST["email"], $_POST["password"], $_POST["name"])) {
  $ur->editUser($_GET["id"], $_POST["email"], $_POST["password"], $_POST["name"]);

  header("Location: user_administration.php");
  die();
}

$user = $ur->getUser($_GET["id"]);

if ($user === false) {
  header("Location: index.php");
  die();
}

$title = "Články - " . $user["name"];
$heading = $user["name"];
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/user_form.php";

include "./php/partials/document_end.php";
