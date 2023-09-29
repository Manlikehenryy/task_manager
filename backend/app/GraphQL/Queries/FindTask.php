<?php

namespace App\GraphQL\Queries;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FindTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       //checks if user created the task before sending
      $task =  Task::where('user_id',$args['user_id'])->where('id',$args['id'])->first();
      return $task;
    }
}
