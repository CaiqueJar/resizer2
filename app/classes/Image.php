<?php

namespace app\classes;

class Image {

    private $name;
    private $tmp_name;
    private $type;
    private $size;

    public function __construct($name, $tmp_name, $type, $size) {
        $this->name = $name;
        $this->tmp_name = $tmp_name;
        $this->type = $type;
        $this->size = $size;
    }
    public function getName($type = null) {
        if($type != null) {
            $name = explode('.', $this->name);
            $name[1] = $type;
            return implode('.', $name);
        }

        return $this->name;
    }
    public function getTmpName() {
        return $this->tmp_name;
    }
}