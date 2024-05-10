<?php

function dump($dump) {
    echo "<pre style='color:green;background-color:#000'>";
    var_dump($dump);
    echo "</pre>";
}

function dd($dump) {
    dump($dump);
    die();

}