<?php

use app\classes\ImageHandler;

$images = $_FILES["imagem"];



$image = ImageHandler::organize($images);

dd($images);
