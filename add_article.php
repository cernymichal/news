<?php

require_once "./php/Application.php";
Application::init();

$heading = "Přidat článek";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<?php

include "./php/partials/document_end.php";
