<?php

require_once "./php/db.php";

$stmt = $conn->prepare("select * from article order by created_at desc limit 5");
$stmt->execute();
$articles = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <title>Clean Blog - Start Bootstrap Theme</title>
  <?php require "./php/head.php"; ?>
</head>

<body>
  <?php require "./php/navigation.php"; ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Články</h1>
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
              <a href="#">Start Bootstrap</a>
              dne <?= date_format(date_create($article["created_at"]), "j.n.Y G:i") ?>
            </p>
          </div>
          <hr>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <hr>

  <?php require "./php/footer.php"; ?>

  <?php require "./php/scripts.php"; ?>
</body>

</html>