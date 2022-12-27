<?php

namespace App\Interfaces;

interface TasksRepositoryInterface
{
    public function getAllTasks($sortOptions);
    public function getTaskByID($taskId);
    public function deleteTask($taskId);
    public function storeTask($request);
    public function updateTask($data,$id);
    public function storeTimeLog($data,$task_id);
    public function getTotalTime($task_id);


}
