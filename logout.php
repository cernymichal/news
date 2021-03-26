<?php

include "./php/Application.php";
Application::init();
Application::assert_logged_in();

session_destroy();

header("Location: index.php");