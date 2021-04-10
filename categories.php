<?php

require_once "./php/Application.php";
Application::init();

$cr = Application::context()->category_repository;

$categories = $cr->getCategories();

$title = "Články - Kategorie";
$heading = "Kategorie";

include "./php/partials/document_start.php";

?>

<?php foreach ($categories as $category) : ?>
  <div class="article-preview text-center">
    <a href="<?= "category.php?id=" . $category["id"] ?>">
      <h2 class="article-title">
        <?= $category["name"] ?>
      </h2>
    </a>
  </div>
<?php endforeach; ?>

<?php include "./php/partials/document_end.php"; ?>