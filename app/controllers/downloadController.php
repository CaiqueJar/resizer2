<?php

if(!isset($_SESSION['download-zip-link'])) {
    return redirect('/');
}

$file = basename($_SESSION['download-zip-link']);
$file_path = 'uploads/' . $file;



if (!file_exists($file_path)) {
    unset($_SESSION['download-zip-link']);
    die('file not found');
}

header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename={$file}");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");

readfile($file_path);

$it = new RecursiveDirectoryIterator($_SESSION['upload-folder'], RecursiveDirectoryIterator::SKIP_DOTS);
$files = new RecursiveIteratorIterator(
    $it,
    RecursiveIteratorIterator::CHILD_FIRST
);
foreach ($files as $file) {
    if ($file->isDir()) {
        rmdir($file->getPathname());
    } else {
        unlink($file->getPathname());
    }
}
rmdir($_SESSION['upload-folder']);

unlink($file_path);

unset($_SESSION['download-zip-link']);
unset($_SESSION['upload-folder']);
