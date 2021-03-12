<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$db = new Database();
$ar = new ArticleRepository($db);

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];
  $ar->editArticle($_GET["id"], $_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);
}

$article = $ar->getArticle($_GET["id"]);

if ($article === false) {
  header("Location: index.php");
  die();
}

$title = "Články - " . $article["title"];
$heading = $article["title"];
$meta = "Zveřejnil <a href=\"user.php?id=" . $article["user_id"] . "\">" . $article["user_name"] . "</a>";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/article_form.php";

include "./php/partials/document_end.php";
