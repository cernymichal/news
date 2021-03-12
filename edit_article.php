<?php

require_once "./php/Application.php";
Application::init();

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

$db = new Database();
$ar = new ArticleRepository($db);

if (isset($_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"])) {
  $_POST["published"] = isset($_POST["published"]) ? 1 : 0;
  $_POST["categories"] = empty($_POST["categories"]) ? [] : $_POST["categories"];
  $ar->editArticle($_GET["id"], $_POST["user_id"], $_POST["title"], $_POST["perex"], $_POST["text"], $_POST["published"], $_POST["categories"]);
}

$article = $ar->getArticle($_GET["id"]);

if ($article === false) {
  header("Location: index.php");
  die();
}

$ur = new UserRepository($db);
$users = $ur->getUsers();

$cr = new CategoryRepository($db);
$categories = $cr->getCategories();

$title = "Články - " . $article["title"];
$heading = $article["title"];
$meta = "Zveřejnil <a href=\"user.php?id=" . $article["user_id"] . "\">" . $article["user_name"] . "</a>";
$header_type = "article";

include "./php/partials/document_start.php";

?>

<form action="" method="post">
  <div class="form-group">
    <div class="form-group">
      <label for="inputTitle">Nadpis</label>
      <input type="text" class="form-control" id="inputTitle" name="title" value="<?= $article["title"] ?>">
    </div>
    <label for="inputUser">Autor</label>
    <select id="inputUser" class="form-control" name="user_id">
      <?php foreach ($users as $user) : ?>
        <option value="<?= $user["id"] ?>" <?= $article["user_id"] == $user["id"] ? "selected" : "" ?>><?= $user["name"] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="inputPublished">Zveřejněno</label>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="inputPublished" name="published" <?= $article["published"] == 1 ? "checked" : "" ?>>
      <label class="form-check-label" for="inputPublished">&nbsp;</label>
    </div>
  </div>
  <div class="form-group">
    <label>Kategorie</label>
    <?php foreach ($categories as $category) : ?>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="categories[]" value="<?= $category["id"] ?>" id="inputCategory<?= $category["id"] ?>" <?= in_array($category["id"], array_column($article["categories"], "id")) ? "checked" : "" ?>>
        <label class="form-check-label" for="inputCategory<?= $category["id"] ?>">
          <?= $category["name"] ?>
        </label>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="form-group">
    <label for="inputPerex">Perex</label>
    <textarea name="perex" id="inputPerex">
      <?= str_replace('&', '&amp;', $article["perex"]) ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="inputText">Text</label>
    <textarea name="text" id="inputText">
      <?= str_replace('&', '&amp;', $article["text"]) ?>
    </textarea>
  </div>
  <div class="form-group">
    <label for="inputCreatedAt">Vytvořeno</label>
    <input type="text" class="form-control" id="inputCreatedAt" value="<?= date_format(date_create($article["created_at"]), "j.n.Y G:i") ?>" disabled>
  </div>
  <button type="submit" class="btn btn-primary">Uložit</button>
</form>

<?php

$scripts = '
  <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>
  <script src="js/create-article-editors.js"></script>
';

include "./php/partials/document_end.php";
