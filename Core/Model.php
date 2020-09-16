<?php

namespace myvendor\Core;

use ReflectionClass;

    class Model
    {
        public function getProperties(){
            $reflect = new ReflectionClass($this);
            $props = $reflect->getProperties();
            $Properties=[];
            $i=0;
            foreach ($props as $prop) {
                $Properties[$i]=$prop->getName();
                $i++;
            }
            return $Properties;
        }
    }
?>