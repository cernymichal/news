<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: user_administration.php");
  die();
}

$db = new Database();
$ur = new UserRepository($db);

$ur->deleteUser($_GET["id"]);

header("Location: user_administration.php");
die();
