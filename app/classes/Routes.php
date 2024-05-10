<?php

namespace app\classes;

class Routes {

    public static function load($routes) {
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        if(!array_key_exists($url_path, $routes)) {
            throw new \Exception('Rota não existe');
        }

        $controller = $routes[$url_path];

        return "../app/controllers/{$controller}.php";
    }
}