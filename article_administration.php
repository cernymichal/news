<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();
$ar = new ArticleRepository($db);

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
            <tr <?= $article["published"] == 1 ? "" : "class=\"table-warning\"" ?>>
                <td><?= $article["title"] ?></td>
                <td>
                    <a class="btn btn-primary w-100" href="<?= "article_edit.php?id=" . $article["id"] ?>">Upravit</a>
                    <a class="btn btn-danger w-100" href="<?= "article_delete.php?id=" . $article["id"] ?>">Odstranit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php

include "./php/partials/document_end.php";
