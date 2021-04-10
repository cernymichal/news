<?php

include "./php/Application.php";
Application::init();
Application::logout();

header("Location: index.php");