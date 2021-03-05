<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();
$cr = new CategoryRepository($db);

$categories = $cr->getCategories();

?>

<!DOCTYPE html>
<html lang="cs">

<head>
  <title>Články - Kategorie</title>
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
            <h1>Kategorie</h1>
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <?php foreach ($categories as $category) : ?>
          <div class="post-preview text-center">
            <a href="<?= "search.php?category=" . $category["id"] ?>">
              <h2 class="post-title">
                <?= $category["name"] ?>
              </h2>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <hr>

  <?php include "./php/partials/footer.php"; ?>

  <?php include "./php/partials/scripts.php"; ?>
</body>

</html>