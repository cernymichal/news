<?php

if (empty($user)) {
  $user = [
    "email" => "",
    "name" => "",
    "password" => "",
    "admin" => 0
  ];
}

?>

<form action="" method="post">
  <div class="form-group">
    <label for="inputName">Jméno *</label>
    <input type="text" class="form-control" id="inputName" name="name" value="<?= $user["name"] ?>" required>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email *</label>
    <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user["email"] ?>" required>
  </div>
  <div class="form-group">
    <label for="inputPassword">Heslo <?= empty($user["id"]) ? "*" : "" ?></label>
    <input type="password" class="form-control" id="inputPassword" name="password" <?= empty($user["id"]) ? "required" : "" ?>>
  </div>
  <div class="form-group">
    <label for="inputAdmin">Administrátor</label>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="inputAdmin" name="admin" <?= $user["admin"] == 1 ? "checked" : "" ?> <?= !Application::admin() ? "disabled" : "" ?>>
      <label class="form-check-label" for="inputAdmin">&nbsp;</label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><?= empty($user["id"]) ? "Vytvořit" : "Uložit" ?></button>
</form>

<?php

$scripts .= '
  <script src="js/submit-disabled.js"></script>
';
