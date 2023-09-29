<?php

namespace App\GraphQL\Queries;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FilterTask
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        //filters task based on category and status
       if ($args['status']=='all'&&$args['category_id']!='all') {
        $tasks =   Task::where('user_id',$args['user_id'])->where('category_id',$args['category_id'])->get();
        return $tasks;
       }
       else if($args['status']!='all'&&$args['category_id']=='all'){
        $tasks =   Task::where('user_id',$args['user_id'])->where('status',$args['status'])->get();
        return $tasks;
       }
       else if($args['status']=='all'&&$args['category_id']=='all'){
        $tasks =   Task::where('user_id',$args['user_id'])->get();
        return $tasks;
       }
       else if($args['status']!='all'&&$args['category_id']!='all'){
        $tasks =   Task::where('user_id',$args['user_id'])->where('status',$args['status'])->where('category_id',$args['category_id'])->get();
        return $tasks;
       }
    }
}
