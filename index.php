<?php

require_once "./php/Application.php";
Application::init();

$db = new Database();
$ar = new ArticleRepository($db);

$articles = $ar->getArticlesLast5();

$title = "Články";
$heading = $title;
$subheading = "Nejnovější zprávy z IT";
$header_background = "img/home-bg.jpg";
$header_type = "site";

include "./php/templates/article_list.php";
