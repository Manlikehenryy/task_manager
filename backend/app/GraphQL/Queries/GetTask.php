<?php

namespace App\GraphQL\Queries;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GetTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       //searches for task that matches the search keyword
      $tasks =   DB::select('SELECT * FROM `tasks` WHERE `user_id` = ? AND (`title` LIKE ? OR `description` LIKE ?) LIMIT ?', [$args["user_id"],"%{$args["keyword"]}%","%{$args["keyword"]}%",10]);
      return $tasks;
    }
}
