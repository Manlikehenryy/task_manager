<?php

namespace App\GraphQL\Mutations;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteCategory
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
      
      $category =  Category::where('id',$args['id'])->first();

      //checks if user created the category
      if ($category&&$category->user_id == $args['user_id']) {
       
        //gets all tasks under that category and delete them
        $tasks =  Task::where('user_id',$args['user_id'])->where('category_id',$args['id'])->get();
        foreach($tasks as $task){
          $task->delete();
        }
        $category->delete();
        return $category;
      }
      else{
        //returns empty object
        return new Category();
      }
      
    }
}
