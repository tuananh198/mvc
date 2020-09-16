<?php

namespace myvendor\Core;

use myvendor\Core\ResourceModelInterface;

    class ResourceModel implements ResourceModelInterface {
        public $table;
        public $id;
        public $model;
        public function __init($table, $id, $model){
            $this->table = $table;
            $this->id = $id;
            $this->model = $model;
        }

        public function save($model){}

        public function delete($model){}
    }

?>