<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();
$ar = new ArticleRepository($db);

$articles = $ar->getArticles();

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <title>Články - Vyhledávání</title>
  <?php include "./php/partials/head.php"; ?>
</head>

<body>
  <?php include "./php/partials/navigation.php"; ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Vyhledávání</h1>
            <span class="subheading">Nejnovější zprávy z IT</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php foreach ($articles as $article) : ?>
          <div class="post-preview">
            <a href="<?= "article.php?id=" . $article["id"] ?>">
              <h2 class="post-title">
                <?= $article["title"] ?>
              </h2>
              <p class="post-subtitle">
                <?= $article["perex"] ?>
              </p>
            </a>
            <p class="post-meta">Zveřejnil
              <a href="<?= "search.php?user=" . $article["user_id"] ?>"><?= $article["user_name"] ?></a>
              dne <?= date_format(date_create($article["created_at"]), "j.n.Y G:i") ?>
            </p>
          </div>
          <hr>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <hr>

  <?php include "./php/partials/footer.php"; ?>

  <?php include "./php/partials/scripts.php"; ?>
</body>

</html>