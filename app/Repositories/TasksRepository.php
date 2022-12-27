<?php namespace App\Repositories;


use App\Models\Task;
use App\Models\TimeLog;

use App\Interfaces\TasksRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;
use Tymon\JWTAuth\Facades\JWTAuth;


class TasksRepository implements TasksRepositoryInterface
{

    public function getAllTasks($sortOptions){
        $user = JWTAuth::parseToken()->authenticate();
        $tasks = Task::where('user_id', $user->id)->whereNull('parent_id')->with('children');

        if(!is_null($sortOptions) && isset($sortOptions['sort_by']) && isset($sortOptions['sort_order'])) {
            if(in_array($sortOptions['sort_by'],['name','description','priority']) && in_array($sortOptions['sort_order'],['asc','desc'])){
                $tasks->orderBy($sortOptions['sort_by'],$sortOptions['sort_order']);
            }
        }
        return $tasks->paginate(4);
    }

    /**
     * @param int $id
     * @return Task
     **/
    public function getTaskByID($id){
        return Task::with('user')->with('children')->find($id);
    }

    /**
     * @param int $id
     **/
    public function deleteTask($id){
        $task = $this->getTaskByID($id);
        return $task->delete();
    }

    /**
     *  @param Object $data
     *  @return Task
     **/
    public function storeTask($data)
    {
        return Task::create([
            'user_id' => auth()->user()->id,
            'name' => $data['name'],
            'description' => $data['description'],
            'priority' => $data['priority'],
        ]);
    }

    /**
     *  @param Object $data
     *  @param int $id
     *  @return Task
     **/
    public function updateTask($data,$id)
    {
        $task = $this->getTaskByID($id);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->priority = $data['priority'];
        $task->save();
        return $task;
    }

    /**
     *  @param int $task_id
     *  @param Object $data
     *  @return TimeLog
     **/
    public function storeTimeLog($task_id,$data) {
        return TimeLog::create([
            'task_id' => $task_id,
            'hours' => $data['hours'],
            'minutes' => $data['minutes'],
        ]);
    }

    public function getTotalTime($task_id) {
        $task = $this->getTaskByID($task_id);
        $hours = 0;
        $minutes = 0;

        foreach($task->time_logs as $timelog) {
            $hours += $timelog->hours;
            $minutes += $timelog->minutes;
        }
        foreach ($task->children as $t){
            foreach($t->time_logs as $timelog) {
                $hours += $timelog->hours;
                $minutes += $timelog->minutes;
            }
        }

        $hours +=floor($minutes / 60);
        $minutes = ($minutes % 60);
        return [
            'hours' => $hours,
            'minutes' => $minutes
        ];

    }




}

