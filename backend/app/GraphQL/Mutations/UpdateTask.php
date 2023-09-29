<?php

namespace App\GraphQL\Mutations;
use App\Models\Task;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       
      $task =  Task::where('id',$args['id'])->first();
      $category =  Category::where('id',$args['category_id'])->first();
       //checks if user created the task and category
       if ($task&&$category&&$task->user_id == $args['user_id']&&$category->user_id == $args['user_id']) {
        $task->title = $args['title'];
        $task->category_id = $args['category_id'];
        $task->description = $args['description'];
        $task->due_date = $args['due_date'];
        $task->status = $args['status'];
        $task->save();
      
         return $task;
       }
       else{
           //returns empty object
           return new Task();
       }
    }
}
