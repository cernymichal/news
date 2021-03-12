<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $ar = new ArticleRepository($db);

  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];
  $ar->addArticle($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);

  header("Location: edit_article.php?id=" . $db->lastInsertId());
  die();
}

$ur = new UserRepository($db);
$users = $ur->getUsers();

$cr = new CategoryRepository($db);
$categories = $cr->getCategories();

$heading = "Přidat článek";
$title = "Články - $heading";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<form action="" method="post">
  <div class="form-group">
    <label for="inputUser">Autor</label>
    <select id="inputUser" class="form-control" name="user_id">
      <?php foreach ($users as $user) : ?>
        <option value="<?= $user["id"] ?>"><?= $user["name"] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputPublished">Zveřejněno</label>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="inputPublished" name="published">
      <label class="form-check-label" for="inputPublished">&nbsp;</label>
    </div>
  </div>
  <div class="form-group">
    <label>Kategorie</label>
    <?php foreach ($categories as $category) : ?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="categories[]" value="<?= $category["id"] ?>" id="inputCategory<?= $category["id"] ?>">
        <label class="form-check-label" for="inputCategory<?= $category["id"] ?>">
          <?= $category["name"] ?>
        </label>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="form-group">
    <label for="inputTitle">Nadpis</label>
    <input type="text" class="form-control" id="inputTitle" name="title">
  </div>
  <div class="form-group">
    <label for="inputPerex">Perex</label>
    <textarea name="perex" id="inputPerex"></textarea>
  </div>
  <div class="form-group">
    <label for="inputText">Text</label>
    <textarea name="text" id="inputText"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Vytvořit</button>
</form>

<?php

$scripts = '
  <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
  <script src="js/create-article-editors.js"></script>
';

include "./php/partials/document_end.php";
