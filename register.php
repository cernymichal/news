
<?php

require_once "./php/Application.php";
Application::init();

$error = false;

if (isset($_POST["email"], $_POST["password"], $_POST["name"])) {
  $db = new Database();
  $ur = new UserRepository($db);

  if (!empty($ur->getUserEmail($_POST["email"]))) {
    $error = "Tento email už je zaregistrovaný!";
  } else {
    $ur->addUser($_POST["email"], $_POST["password"], $_POST["name"]);

    $user = $ur->getUser($db->lastInsertId());

    Application::login_session($user);
    header("Location: index.php");
    die();
  }
}

$heading = "Registrace";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

include "./php/partials/user_form.php";

if (!empty($error)) {
  $error_message = $error;
  $modals = ["./php/partials/modals/error_message.php"];
  $scripts = '<script>MicroModal.show("modal-error-message");</script>';
}

include "./php/partials/document_end.php";
