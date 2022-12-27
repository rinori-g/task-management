<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Repositories\TasksRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TasksController extends Controller
{
    private  $tasksRepository;


    public function __construct(TasksRepository $tasksRepository)
    {
        $this->tasksRepository=$tasksRepository;
    }


    public function index(Request $request)
    {
        return response()->json(
            TaskResource::collection($this->tasksRepository->getAllTasks($request->only('sort_by','sort_order')))
        );
    }
    public function store(Request $request){

        $data = $request->only('name', 'description','priority');
        $validator = Validator::make($data, [
            'name' => 'required',
            'priority' => Rule::in(['Low','Medium','High']),
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'There are validation errors'], 422);
        }

        $task = $this->tasksRepository->storeTask($data);
        if($task) {
            return response()->json(
                TaskResource::make($task)
            );
        }else {
            return response()->json(
                [
                'message' => 'Failed to store the task'
                ],
                500
            );
        }

    }
    public function view($id){
        $task = $this->tasksRepository->getTaskByID($id);
        if(is_null($task)) {
            return response()->json('Task Not Found', 404);
        }
        return response()->json(
            TaskResource::make($task)
        );
    }
    public function update(Request $request,$id){

        $data = $request->only('name', 'description','priority');
        $validator = Validator::make($data, [
            'name' => 'required',
            'priority' => Rule::in(['Low','Medium','High']),
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'There are validation errors'], 422);
        }


        $task = $this->tasksRepository->getTaskByID($id);
        if(is_null($task)) {
            return response()->json('Task Not Found', 404);
        }

        $task = $this->tasksRepository->updateTask($data, $task->id);
        $task = $this->tasksRepository->storeTask($data);
        if($task) {
            return response()->json(
                TaskResource::make($task)
            );
        }else {
            return response()->json(
                [
                    'message' => 'Failed to update the task'
                ],
                500
            );
        }
    }
    public function delete($id){
        $task = $this->tasksRepository->getTaskByID($id);
        if(is_null($task)) {
            return response()->json('Task Not Found', 404);
        }
        if($this->tasksRepository->deleteTask($task->id)) {
            return response()->json(
                [
                'message' => 'The task was deleted'
                ],200
            );
        }else {
            return response()->json(
                [
                    'message' => 'The task was not deleted'
                ],500
            );
        }


    }
    public function createLogTime(Request $request,$task_id){
        $data = $request->only('hours', 'minutes');
        $validator = Validator::make($data, [
            'hours' => 'required|integer',
            'minutes' => 'required|integer|between:1,60',
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'There are validation errors'], 422);
        }
        $task = $this->tasksRepository->getTaskByID($task_id);
        if(is_null($task)) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }
        $this->tasksRepository->storeTimeLog(
            $task_id,
            $data
        );
    }
    public function getTotalTaskTime($task_id){
        $task = $this->tasksRepository->getTaskByID($task_id);
        if(is_null($task)) {
            return response()->json(['message' => 'Task Not Found'], 404);
        }
        return response()->json(
            $this->tasksRepository->getTotalTime($task_id)
        );
    }

}
