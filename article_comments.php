<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

if (empty($_GET["id"])) {
  header("Location: article_adminstration.php");
  die();
}

$article = Application::context()->article_repository->getArticle($_GET["id"]);

if (empty($article)) {
  header("Location: article_adminstration.php");
  die();
}

if ($article["user_id"] != Application::user()["id"]) {
  Application::assert_admin("article_administration.php");
}

$comments = Application::context()->comment_repository->getCommentsArticle($article["id"]);

$title = "Články - Administrace";
$heading = "Administrace komentářů";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Jméno</th>
      <th scope="col">Email</th>
      <th scope="col">Text</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($comments as $comment) : ?>
      <tr>
        <td><?= $comment["name"] ?></td>
        <td><?= $comment["email"] ?></td>
        <td><?= $comment["text"] ?></td>
        <td><a class="btn btn-danger w-10" href="<?= "comment_delete.php?id=" . $comment["id"] ?>">Odstranit</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php

include "./php/partials/document_end.php";
