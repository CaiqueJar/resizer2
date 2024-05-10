<?php 

namespace app\classes;

class ImageHandler {

    public static function organize($image_array) {
        $image_names = $image_array['name'] ?? false;
        $type = $image_array['type'] ?? false;
        $tmp_names = $image_array['tmp_name'] ?? false;
        $size = $image_array['size'] ?? false;

        if(!$image_names || !$type || !$tmp_names || !$size) {
            throw new \Exception("Array de imagens inválido");
        }

        $images = [];

        $image_objects = array_map(function ($name, $type, $tmp_name, $size) {
            // Assuming Image is a class that you have defined elsewhere
            $image = new Image($name, $type, $tmp_name, $size);
            return $image;
        }, $image_names, $type, $tmp_names, $size);
        
        dd($image_objects);
        // return $result;
    }
}