<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();
$cr = new CategoryRepository($db);

$categories = $cr->getCategoriesAlphabetically();

$title = "Články - Administrace";
$heading = "Administrace kategorií";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<div class="text-right mb-3">
  <a class="btn btn-success" href="category_add.php">Přidat kategorii</a>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Název</th>
      <th scope="col">Akce</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categories as $category) : ?>
      <tr>
        <td><?= $category["name"] ?></td>
        <td>
          <a class="btn btn-primary w-100" href="<?= "category_edit.php?id=" . $category["id"] ?>">Upravit</a>
          <a class="btn btn-danger w-100" href="<?= "category_delete.php?id=" . $category["id"] ?>">Odstranit</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php

if (!empty($_GET["error"])) {
  $error_message = $_GET["error"];
  $modals = ["./php/partials/modals/error_message.php"];
  $scripts = '<script>MicroModal.show("modal-error-message");</script>';
}

include "./php/partials/document_end.php";
