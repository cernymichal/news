<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $ar = Application::context()->article_repository;

  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];

  if (!Application::admin()) {
    $_POST["user_id"] = Application::user()["id"];
  }

  $ar->addArticle($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);

  header("Location: article_administration.php");
  die();
}

$heading = "Přidat článek";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/article_form.php";

include "./php/partials/document_end.php";
