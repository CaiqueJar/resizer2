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

        $image_objects = array_map(function ($name, $type, $tmp_name, $size) {
            $image = new Image($name, $tmp_name, $type, $size);
            return $image;
        }, $image_names, $type, $tmp_names, $size);
        
        return $image_objects;
    }

    public static function save($image, $target_path, array $options = []) {
        
        if(move_uploaded_file($image->getTmpName(), $target_path . $image->getName())) {
            $resize = new Resize($target_path . $image->getName());
            
            $target_path .= "convertion/";
            if(!is_dir($target_path)) {
                mkdir($target_path);
            }

            $path_image = $target_path . $image->getName('webp');
            $resize->save($path_image, 90, 'webp');
            return true;
        }
        throw new \Exception('Salvar a imagem deu errado!');
        
    }
}