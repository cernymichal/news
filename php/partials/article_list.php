<?php 

foreach($articles as $article) {
    if ($article["published"] == 1) {
        include "./php/partials/article_preview.php";
    }
}