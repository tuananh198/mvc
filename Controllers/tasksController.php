<?php

namespace myvendor\Controllers;

use myvendor\Models\TaskResourceModel;
use myvendor\Core\Controller;
use myvendor\Config\Database;
use myvendor\Models\TaskModel;

class tasksController extends Controller
{
    function index()
    {
        //require(ROOT . 'Models/Task.php');
        $model = new TaskModel();

        $tasks = new TaskResourceModel("tasks", "id", $model);

        $d['tasks'] = $tasks->showAllTasks($model);
        $this->set($d);
        $this->render("index");
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
           // require(ROOT . 'Models/Task.php');

           $model = new TaskModel();
        
           $model->title = $_POST["title"];
           $model->description = $_POST["description"];
           $model->created_at = date('Y-m-d H:i:s');

           $tasks = new TaskResourceModel("tasks", "id", $model);

            if ($tasks->create($model))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        //require(ROOT . 'Models/Task.php');
        $task = new TaskModel();

        $tasks = new TaskResourceModel("tasks", "id", $task);

        $d["task"] = $tasks->showTask($id);

        if (isset($_POST["title"]))
        {   $task->id = $d["task"]["id"];
            $task->title = $_POST["title"];
            $task->description = $_POST["description"];
            if ($tasks->edit($task))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        //require(ROOT . 'Models/Task.php');
        $model = new TaskModel();

        $tasks = new TaskResourceModel("tasks", "id", $model);
        $model = $tasks->showTask($id);
        if ($tasks->delete($model))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>