<?php

namespace myvendor\Core;

use myvendor\Core\ResourceModelInterface;
use myvendor\Config\Database;
use PDO;

    class ResourceModel implements ResourceModelInterface {
        public $table;
        public $id;
        public $model;
        public function __init($table, $id, $model){
            $this->table = $table;
            $this->id = $id;
            $this->model = $model;
        }

        public function save($model){
            $properties = $this->model->getProperties();

            if($model->{$this->id} == null){
                $model_create = [];
                $str1 = "";
                $str2 = "";
        
                for ($i=0; $i < count($properties); $i++) { 
                    if($properties[$i] != $this->id && $properties[$i]!= "updated_at"){
                        echo "<pre>";
                        var_dump($model->{$properties[$i]});
                        echo "<pre>";
                        $model_create[$properties[$i]] = $model->{$properties[$i]};
                        $str1 = $str1 . "$properties[$i],";
                        $str2 = $str2 . ":$properties[$i],";
                    }
                }
                $str1 = rtrim($str1, ",");
                $str2 = rtrim($str2, ",");
        
                $sql = "INSERT INTO $this->table ($str1) VALUES ($str2)";
        
                $req = Database::getBdd()->prepare($sql);
        
                return $req->execute($model_create);
            }
            else{
                $model_update = [];
                $str = "";
        
                for ($i=0; $i < count($properties); $i++) { 
                    if($properties[$i] != $this->id && $properties[$i] != "created_at"){
                        $model_update[$properties[$i]] = $model->{$properties[$i]};
                        $str = $str . "$properties[$i]=:$properties[$i]," ;
                    }
                }
                $model_update[$this->id] = $model->id;
                $model_update["updated_at"] = date('Y-m-d H:i:s');
                
                $str = rtrim($str, ",");
        
                $sql = "UPDATE $this->table SET $str WHERE $this->id=:$this->id";
        
                $req = Database::getBdd()->prepare($sql);
        
                return  $req->execute($model_update);
            }
        }

        public function delete($model){
            $model_delete[$this->id] = $model[$this->id];
            $sql = "DELETE FROM $this->table WHERE $this->id=:$this->id";
            echo $sql;
            $req = Database::getBdd()->prepare($sql);
            return $req->execute($model_delete);
        }
        public function showTask($id)
        {
            $sql = "SELECT * FROM $this->table WHERE $this->id =" . $id;
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetch();
        }
    
        public function showAllTasks($model)
        {
            $class_name = get_class($this->model);
            $sql = "SELECT * FROM " . $this->table;
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            $arr_obj = [];
            $arr = $req->fetchAll();
            for ($i = 0; $i < count($arr); $i++) { 
                $task = new $class_name;
                foreach ($arr[$i] as $key => $value) {
                    $task->$key = $value;
                }
                array_push($arr_obj, $task);
            }
            return $arr_obj;
        }
    }

?>