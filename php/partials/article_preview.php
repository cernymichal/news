<div class="article-preview">
  <a href="<?= "article.php?id=" . $article["id"] ?>">
    <h2 class="article-title">
      <?= $article["title"] ?>
    </h2>
    <p class="article-subtitle">
      <?= $article["perex"] ?>
    </p>
  </a>
  <?php include "./php/partials/article_meta.php"; ?>
</div>

<hr>