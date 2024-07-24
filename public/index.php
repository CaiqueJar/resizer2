<?php

require "../bootstrap.php";

use app\classes\Routes;

$routes = [
    '/' => 'homeController',
    '/submit-images' => 'submitController',
    '/download-zip' => 'downloadController'
];


require Routes::load($routes);