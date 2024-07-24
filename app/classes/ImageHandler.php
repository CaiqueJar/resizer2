<?php 

namespace app\classes;

use Imagick;

class ImageHandler {

    public static function organize($image_array, $formats = null, $widths = null, $heights = null) {
        $image_names = $image_array['name'] ?? false;
        $type = $image_array['type'] ?? false;
        $tmp_names = $image_array['tmp_name'] ?? false;
        $size = $image_array['size'] ?? false;
        $formats = $formats ?? false;
        $widths = $widths ?? 0;
        $heights = $heights ?? 0;

        if(!$image_names || !$type || !$tmp_names || !$size || !$formats) {
            throw new \Exception("Array de imagens inválido");
        }

        $image_objects = array_map(function ($name, $type, $tmp_name, $size, $formats, $widths, $heights) {
            $image = new Image($name, $tmp_name, $type, $size, $formats, $widths, $heights);
            return $image;
        }, $image_names, $type, $tmp_names, $size, $formats, $widths, $heights);
        
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

            $imagick->resizeImage($image->getWidth(), $image->getHeight(), Imagick::FILTER_CATROM, 0);

            $imagick->writeImage($path_image);

            $imagick->clear();
            $imagick->destroy();

            return true;
        }
        throw new \Exception('Salvar a imagem deu errado!');
        
    }
    
}