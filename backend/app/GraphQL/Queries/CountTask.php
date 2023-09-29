<?php

namespace App\GraphQL\Queries;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CountTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
      //counts task based on status
       $tasks_in_progress =  Task::where('user_id',$args["user_id"])->where('status','In Progress')->count();
       $tasks_completed =  Task::where('user_id',$args["user_id"])->where('status','Completed')->count();
       $tasks_not_started=  Task::where('user_id',$args["user_id"])->where('status','Not Started')->count();
       $task = new Task();
       $task->in_progress =  $tasks_in_progress;
       $task->completed =  $tasks_completed;
       $task->not_started =  $tasks_not_started;
   
      return $task;
    }
}
