<?php

$conn = new PDO("mysql:host=localhost;dbname=news", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$conn->query("set names utf8");