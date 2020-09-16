<?php
namespace myvendor\Models;

use myvendor\Core\Model;

class TaskModel extends Model
{
    public $title;
    public $description;
    public $created_at;
    public $updated_at;
    public $id;

    public function setTitle($title){
        return $this->title = $title;
    }
    public function getTitle(){
        return $this->title;
    }
    public function setDescription($description){
        return $this->description = $description;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setCreated_at($created_at){
        return $this->created_at = $created_at;
    }
    public function getCreated_at(){
        return $this->created_at;
    }
    public function setUpdate_at($update_at){
        return $this->update_at = $update_at;
    }
    public function getUpdate_at(){
        return $this->update_at;
    }
    public function setId($id){
        return $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function __set($key, $value){
        $this->$key = $value;
    }
}
?>