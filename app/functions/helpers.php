<?php

function dump($dump) {
    echo "<pre style='color:green;background-color:#000'>";
    var_dump($dump);
    echo "</pre>";
}

function dd(...$dump) {
    foreach($dump as $item) {
        dump($item);
    }
    die();
}

function generate_folder_name($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters))];
    }

    return $random_string . "-" . date("Y-m-d-H-i-s");
}

function asset($path) {
    $baseUrl = $_SERVER['HTTP_HOST'];
    return 'http://' . $baseUrl . '/' . ltrim($path, '/');
}

function redirect($destination) {
    header('Location: ' . $destination);
    exit();
}

function redirectBack() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}