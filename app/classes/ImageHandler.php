<?php 

namespace app\classes;

use Imagick;

class ImageHandler {

    public static function organize($image_array, $options = null) {
        $image_names = $image_array['name'] ?? false;
        $type = $image_array['type'] ?? false;
        $tmp_names = $image_array['tmp_name'] ?? false;
        $size = $image_array['size'] ?? false;
        $format = $options ?? false;

        if(!$image_names || !$type || !$tmp_names || !$size || !$format) {
            throw new \Exception("Array de imagens inválido");
        }

        $image_objects = array_map(function ($name, $type, $tmp_name, $size, $format) {
            $image = new Image($name, $tmp_name, $type, $size, $format);
            return $image;
        }, $image_names, $type, $tmp_names, $size, $format);
        
        return $image_objects;
    }

    public static function save($image, $target_path) {
        if(move_uploaded_file($image->getTmpName(), $target_path . $image->getName())) {
            $imagick = new Imagick($target_path . $image->getName());

            $target_path .= "convertion/";
            if(!is_dir($target_path)) {
                mkdir($target_path);
            }
            $path_image = $target_path . $image->getNameWithType();

            $imagick->setImageFormat($image->getFormat());
            $imagick->setImageCompressionQuality(90);
            // $imagick->resizeImage(100, 100, Imagick::FILTER_POINT, 0);

            $imagick->writeImage($path_image);

            return true;
        }
        throw new \Exception('Salvar a imagem deu errado!');
        
    }
    
}