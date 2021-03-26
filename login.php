<?php

include "./php/Application.php";
Application::init();

$error = false;

if (isset($_POST["email"], $_POST["password"])) {
  $db = new Database();
  $ur = new UserRepository($db);
  $user = $ur->getUserEmail($_POST["email"]);

  if (isset($user) && password_verify($_POST["password"], $user["password"])) {
    Application::login_session($user);
    header("Location: index.php");
    die();
  } else {
    $error = true;
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
  <button type="submit" class="btn btn-primary">Přihlásit se</button>
</form>

<?php if ($error) : ?>
  <p>
    <strong>Chybně zadané přihlašovací údaje</strong>
  </p>
<?php endif; ?>

<?php include "./php/partials/document_end.php"; ?>