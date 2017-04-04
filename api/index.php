<?php

include 'init.php';
include 'database.php';
include 'functions.php';

$uri = $_SERVER['REQUEST_URI'];
list($uri, $query) = explode('?', $uri);

include $file = BASE_PATH . $uri . '.php'; die;
