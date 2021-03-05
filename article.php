<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$db = new Database();
$ar = new ArticleRepository($db);

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

?>

<article>
  <?= $article["text"] ?>
</article>

<hr>

<?php

include "./php/partials/article_meta.php";

include "./php/partials/document_end.php";