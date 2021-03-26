<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

$db = new Database();
$ur = new UserRepository($db);

$users = $ur->getUsersAlphabetically();

$title = "Články - Administrace";
$heading = "Administrace autorů";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<div class="text-right mb-3">
  <a class="btn btn-success" href="user_add.php">Přidat autora</a>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Jméno</th>
      <th scope="col">Akce</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) : ?>
      <tr>
        <td><?= $user["name"] ?></td>
        <td>
          <a class="btn btn-primary w-100 px-2" href="<?= "user_edit.php?id=" . $user["id"] ?>">Upravit</a>
          <a class="btn btn-danger w-100 px-2" href="<?= "user_delete.php?id=" . $user["id"] ?>">Odstranit</a>
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
