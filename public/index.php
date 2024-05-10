<?php

require "../bootstrap.php";

use app\classes\Routes;


$routes = [
    '/' => 'homeController',
    '/submit-images' => 'submitController',
];


require Routes::load($routes);