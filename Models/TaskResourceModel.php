<?php

namespace myvendor\Models;

use myvendor\Models\TaskModel;
use myvendor\Config\Database;
use myvendor\Core\Model;
use PDO;
use myvendor\Core\ResourceModel;

class TaskResourceModel extends ResourceModel
{   
    public function __construct($table, $id, $model)
    {
        $this->__init($table, $id, $model);
    }

    public function create($model)
    {   
        $properties = $this->model->getProperties();

        /*
        echo "<pre>";
        var_dump($properties);
        echo "<pre>";
        */

        $model_create = [];
        $str1 = "";
        $str2 = "";

        for ($i=0; $i < count($properties); $i++) { 
            if($properties[$i] != $this->id && $properties[$i]!= "updated_at"){
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
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

        echo $sql;

        $req = Database::getBdd()->prepare($sql);

        return $req->execute($model_create);
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
        //var_dump($arr);
        for ($i = 0; $i < count($arr); $i++) { 
            $task = new $class_name;
            //var_dump($task);
            foreach ($arr[$i] as $key => $value) {
                $task->$key = $value;
            }
            //echo "<pre>";
            //var_dump($task);
            //echo "<pre>";
            array_push($arr_obj, $task);
        }
        //var_dump($arr_obj);
        return $arr_obj;
    }

    public function edit($model)
    {   
        $properties = $this->model->getProperties();

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
        
        //$model_update["created_at"] = $model->created_at;
        // var_dump($model_update);
        //echo "<pre>";
        $str = rtrim($str, ",");
        //echo $str;
        //echo '<br>';

        $sql = "UPDATE $this->table SET $str WHERE $this->id=:$this->id";
        echo $sql;

        $req = Database::getBdd()->prepare($sql);

        return  $req->execute($model_update);
        
    }

    public function delete($model)
    {   //echo "<pre>";
        //echo $model["$this->id"];
        //echo "<pre>";
        $model_delete[$this->id] = $model[$this->id];
        $sql = "DELETE FROM $this->table WHERE $this->id=:$this->id";
        echo $sql;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute($model_delete);
    }
}
?>