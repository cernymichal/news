<?php foreach ($comments as $comment) : ?>
  <div class="mb-4">
    <p class="m-0"><?= $comment["text"] ?></p>
    <p class="article-meta m-0">Od <?= $comment["name"] ?> <?= empty($comment["email"]) ? "" : '(<a href="mailto:' . $comment["email"] . '">' . $comment["email"] . "</a>)" ?></p>
  </div>
<?php endforeach; ?>

<?php if (empty($comments)) : ?>
  <p class="article-meta">Dosud žádné komentáře</p>
<?php endif; ?>