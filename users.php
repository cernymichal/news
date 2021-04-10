<?php

require_once "./php/Application.php";
Application::init();

$ur = Application::context()->user_repository;

$users = $ur->getUsers();

$title = "Články - Autoři";
$heading = "Autoři";

include "./php/partials/document_start.php";

?>

<?php foreach ($users as $user) : ?>
  <div class="article-preview text-center">
    <a href="<?= "user.php?id=" . $user["id"] ?>">
      <h2 class="article-title">
        <?= $user["name"] ?>
      </h2>
    </a>
  </div>
<?php endforeach; ?>

<?php include "./php/partials/document_end.php"; ?>