<!DOCTYPE html>
<html lang="cs">

<head>
  <title><?= empty($title) ? "Články" : $title ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <link href="css/clean-blog.css" rel="stylesheet">

  <?= empty($head) ? "" : $head ?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="index.php">Články</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Zprávy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categories.php">Kategorie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="users.php">Autoři</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="administration.php">Administrace článků</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <header class="masthead" <?= empty($header_background) ? "" : "style=\"background-image: url('$header_background')\"" ?>>
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <?php

          if (empty($header_type)) {
            $header_type = "page";
          }

          include "./php/partials/header_$header_type.php";

          ?>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">