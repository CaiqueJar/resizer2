<?php

use app\classes\ImageHandler;

$images_array = $_FILES["images"];
$formats = $_POST['formats'];
$widths = $_POST['width'];
$heights = $_POST['height'];

$folder_name = generate_folder_name(6);
$target_path = __DIR__ . "/../../public/uploads/" . $folder_name . "/";
mkdir($target_path);


$images_object = ImageHandler::organize($images_array, $formats, $widths, $heights);

foreach ($images_object as $image) {
    ImageHandler::save($image, $target_path);
}


$zip = new ZipArchive();
$zip->open('uploads/zip-' . $folder_name . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

$root_path = realpath($target_path . "convertion");

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root_path),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $file) {
    if (!$file->isDir()) {
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($root_path) + 1);
        $zip->addFile($filePath, $relativePath);
    }
}

$zip->close();

$_SESSION['download-zip-link'] = 'uploads/zip-' . $folder_name . '.zip';
$_SESSION['upload-folder'] = 'uploads/' . $folder_name;

return redirectBack();