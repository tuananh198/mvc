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
        return $this->save($model);
    }

    public function showTask($id)
    {
        return ResourceModel::showTask($id);
        
    }

    public function showAllTasks($model)
    {
        return ResourceModel::showAllTasks($model);
    }

    public function edit($model)
    {   
        return $this->save($model);
    }

    public function delete($model)
    {   
        return ResourceModel::delete($model);
    }
}
?>