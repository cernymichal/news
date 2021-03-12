<?php

if (empty($user)) {
  $user = [
    "email" => "",
    "name" => "",
    "password" => ""
  ];
}

?>

<form action="" method="post">
  <div class="form-group">
    <label for="inputName">Jméno</label>
    <input type="text" class="form-control" id="inputName" name="name" value="<?= $user["name"] ?>">
  </div>
  <div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user["email"] ?>">
  </div>
  <div class="form-group">
    <label for="inputPassword">Heslo</label>
    <input type="password" class="form-control" id="inputPassword" name="password" value="<?= $user["password"] ?>">
  </div>
  <button type="submit" class="btn btn-primary"><?= empty($user["id"]) ? "Vytvořit" : "Uložit" ?></button>
</form>