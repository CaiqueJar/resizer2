<?php

namespace app\classes;

class Image {

    private $name;
    private $tmp_name;
    private $type;
    private $size;
    private $format;

    public function __construct($name, $tmp_name, $type, $size, $format) {
        $this->name = $name;
        $this->tmp_name = $tmp_name;
        $this->type = $type;
        $this->size = $size;
        $this->format = $format;
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
    
    public function getTmpName() {
        return $this->tmp_name;
    }
}