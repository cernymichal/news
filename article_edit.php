<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: article_administration.php");
  die();
}

$ar = Application::context()->article_repository;

$article = $ar->getArticle($_GET["id"]);

if (empty($article)) {
  header("Location: article_administration.php");
  die();
}

if ($article["user_id"] != Application::user()["id"]) {
  Application::assert_admin("article_administration.php");
}

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];

  if (!Application::admin()) {
    $_POST["user_id"] = Application::user()["id"];
  }

  $ar->editArticle($article["id"], $_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);

  header("Location: article_administration.php");
  die();
}

$title = "Články - " . $article["title"];
$heading = $article["title"];
$meta = 'Zveřejnil <a href="user.php?id=' . $article["user_id"] . '">' . $article["user_name"] . "</a>";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/article_form.php";

include "./php/partials/document_end.php";
