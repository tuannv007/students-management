<?php

include 'init.php';
include 'database.php';
include 'functions.php';

$uri = $_SERVER['REQUEST_URI'];
list($uri) = explode('?', $uri);

include $file = BASE_PATH . $uri . '.php';
