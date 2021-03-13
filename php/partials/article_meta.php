<p class="article-meta">Zveřejnil
  <a href="<?= "user.php?id=" . $article["user_id"] ?>"><?= $article["user_name"] ?></a>
  dne <?= date_format(date_create($article["created_at"]), "j.n.Y G:i") ?>
  <br>
  <?php

  if (count($article["categories"]) !== 0) {
    $category_anchors = $article["categories"];
    array_walk($category_anchors, function (&$category) {
      $category = '<a href="category.php?id=' . $category["id"] . '">' . $category["name"] . "</a>";
    });

    echo "v " . join(", ", $category_anchors);
  }

  ?>
</p>