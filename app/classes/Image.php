<?php

namespace app\classes;

class Image {

    private $name;
    private $tmp_name;
    private $type;
    private $size;
    private $format;
    private $width;
    private $height;

    public function __construct($name, $tmp_name, $type, $size, $format, $width = null, $height = null) {
        $this->name = $name;
        $this->tmp_name = $tmp_name;
        $this->type = $type;
        $this->size = $size;
        $this->format = $format;
        $this->width = $width;
        $this->height = $height;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getNameWithType() {
        $name = explode('.', $this->name);
        $last_index = array_key_last($name);
        $name[$last_index] = $this->format;
        return implode('.', $name);
    }

    public function getFormat() {
        return $this->format;
    }
    
    public function getWidth() {
        return !$this->width ? 0 : $this->width;
    }

    public function getHeight() {
        return !$this->height ? 0 : $this->height;
    }

    public function getTmpName() {
        return $this->tmp_name;
    }
}