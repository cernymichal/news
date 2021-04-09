<?php

include "./php/Application.php";
Application::init();

$error = false;

if (isset($_POST["email"], $_POST["password"])) {
  $db = new Database();
  $ur = new UserRepository($db);
  $user = $ur->getUserEmail($_POST["email"]);

  if (!empty($user) && password_verify($_POST["password"], $user["password"])) {
    Application::login_session($user);
    header("Location: index.php");
    die();
  } else {
    $error = "Chybně zadané přihlašovací údaje";
  }
}


$heading = "Přihlášení";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<form action="" method="post">
  <div class="form-group">
    <label for="inputEmail">Přihlašovací email</label>
    <input type="text" class="form-control" id="inputEmail" name="email" required>
  </div>
  <div class="form-group">
    <label for="inputPassword">Heslo</label>
    <input type="password" class="form-control" id="inputPassword" name="password">
  </div>
  <div class="row">
    <div class="col-6">
      <button type="submit" class="btn btn-primary">Přihlásit se</button>
    </div>
    <div class="col-6 text-right">
      <a class="btn btn-success" href="register.php">Registrovat se</a>
    </div>
  </div>
</form>

<?php

if (!empty($error)) {
  $error_message = $error;
  $modals = ["./php/partials/modals/error_message.php"];
  $scripts = '<script>MicroModal.show("modal-error-message");</script>';
}

include "./php/partials/document_end.php";
