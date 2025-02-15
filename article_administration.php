<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

$ar = Application::context()->article_repository;

$articles = $ar->getArticlesAlphabetically();

$title = "Články - Administrace";
$heading = "Administrace článků";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<div class="text-right mb-3">
  <a class="btn btn-success" href="article_add.php">Přidat článek</a>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nadpis</th>
      <th scope="col">Akce</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($articles as $article) : ?>
      <tr <?= $article["published"] == 1 ? "" : 'class="table-warning"' ?>>
        <td><?= $article["title"] ?></td>
        <td>
          <?php if (Application::admin() || $article["user_id"] == Application::user()["id"]) : ?>
            <a class="btn btn-primary w-100 px-0" href="<?= "article_edit.php?id=" . $article["id"] ?>">Upravit</a>
            <a class="btn btn-secondary w-100 px-0" href="<?= "article_comments.php?id=" . $article["id"] ?>">Komentáře</a>
            <a class="btn btn-danger w-100 px-0" href="<?= "article_delete.php?id=" . $article["id"] ?>">Odstranit</a>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php

if (!empty($_GET["error"])) {
  $error_message = $_GET["error"];
  $modals[] = "./php/partials/modals/error_message.php";
  $scripts .= '<script>MicroModal.show("modal-error-message");</script>';
}

include "./php/partials/document_end.php";
