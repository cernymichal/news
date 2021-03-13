<?php

if (empty($category)) {
  $category = [
    "name" => ""
  ];
}

?>

<form action="" method="post">
  <div class="form-group">
    <div class="form-group">
      <label for="inputName">Název *</label>
      <input type="text" class="form-control" id="inputName" name="name" value="<?= $category["name"] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary"><?= empty($category["id"]) ? "Vytvořit" : "Uložit" ?></button>
</form>