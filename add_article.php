<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $ar = new ArticleRepository($db);

  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];
  $ar->addArticle($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);

  header("Location: edit_article.php?id=" . $db->lastInsertId());
  die();
}

$heading = "Přidat článek";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/article_form.php";

include "./php/partials/document_end.php";
