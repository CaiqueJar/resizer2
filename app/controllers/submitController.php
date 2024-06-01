<?php

use app\classes\ImageHandler;

$images_array = $_FILES["imagem"];

$target_path = __DIR__ . "/../../public/uploads/" . generate_folder_name(6) . "/";
mkdir($target_path);
$images_object = ImageHandler::organize($images_array);

foreach ($images_object as $image) {
    ImageHandler::save($image, $target_path, []);
}