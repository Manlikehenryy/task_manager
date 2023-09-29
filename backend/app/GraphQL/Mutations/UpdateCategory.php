<?php

namespace App\GraphQL\Mutations;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UpdateCategory
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
       $category->title = $args['title'];
       $category->save();
     
        return $category;
      }
      else{
          //returns empty object
          return new Category();
      }
    }
}
