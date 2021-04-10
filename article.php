<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$ar = Application::context()->article_repository;
$cr = Application::context()->comment_repository;

$article = $ar->getArticle($_GET["id"]);

if (empty($article)) {
  header("Location: index.php");
  die();
}

if (isset($_POST["name"], $_POST["email"], $_POST["text"])) {
  $cr->addComment($_GET["id"], $_POST["name"], $_POST["email"], $_POST["text"]);

  header("Location: " . $_SERVER["REQUEST_URI"]);
  die();
}

$comments = $cr->getCommentsArticle($_GET["id"]);

$title = "Články - " . $article["title"];
$heading = $article["title"];
$meta = 'Zveřejnil <a href="user.php?id=' . $article["user_id"] . '">' . $article["user_name"] . "</a>";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<article>
  <?= $article["text"] ?>
</article>

<hr>

<?php include "./php/partials/article_meta.php"; ?>

<h3 class="font-weight-normal mb-3">Napsat komentář</h3>

<?php include "./php/partials/comment_form.php"; ?>

<div class="mt-5">
  <?php include "./php/partials/comment_list.php"; ?>
</div>

<?php

include "./php/partials/document_end.php";
