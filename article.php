<?php

if (empty($_GET["id"])) {
  header("Location: index.php");
  die();
}

require_once "./php/db.php";

$stmt = $conn->prepare("select * from article where id = :id");
$stmt->execute([":id" => $_GET["id"]]);
$article = $stmt->fetch();

if ($article === false) {
  header("Location: index.php");
  die();
}

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
  <header class="masthead">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $article["title"] ?></h1>
            <span class="meta">Zveřejnil
              <a href="#">Start Bootstrap</a>
              <?= date_format(date_create($article["created_at"]), "j.n.Y G:i") ?></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?= $article["text"] ?>
        </div>
      </div>
    </div>
  </article>

  <hr>

  <?php require "./php/footer.php"; ?>

  <?php require "./php/scripts.php"; ?>
</body>

</html>