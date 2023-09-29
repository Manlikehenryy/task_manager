<?php

namespace App\GraphQL\Mutations;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    { 
      
      $task =  Task::where('id',$args['id'])->first();

      //checks if user created the task
      if ($task&&$task->user_id == $args['user_id']) {
        $task->delete();
        return $task;
      }
      else{
        //returns empty object
        return new Task();
      }
      
    }
}
