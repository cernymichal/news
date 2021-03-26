<?php

require_once "./php/Application.php";
Application::init();
Application::assert_logged_in();

$title = "Články - Administrace";
$heading = "Administrace";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<div class="text-center">
  <a class="btn btn-primary" href="article_administration.php">Články</a>
  <a class="btn btn-primary" href="category_administration.php">Kategorie</a>
  <a class="btn btn-primary" href="user_administration.php">Autoři</a>
</div>

<?php

include "./php/partials/document_end.php";
