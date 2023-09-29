<?php

namespace App\GraphQL\Queries;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FindCategory
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       //checks if user created the category before sending
      $category =  Category::where('user_id',$args['user_id'])->where('id',$args['id'])->first();
      return $category;
    }
}
