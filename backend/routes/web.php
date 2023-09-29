<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $args = ["user_id"=>"uriel@gmail.com","keyword"=>"g"];
    $tasks_in_progress =  Task::where('user_id',$args["user_id"])->where('status','In Progress')->count();
    $tasks_completed =  Task::where('user_id',$args["user_id"])->where('status','Completed')->count();
    $tasks_not_started=  Task::where('user_id',$args["user_id"])->where('status','Not Started')->count();
    $task = new Task();
    $task->in_progress =  $tasks_in_progress;
    $task->completed =  $tasks_completed;
    $task->not_started =  $tasks_not_started;

   return $task;
   return Task::where('user_id','uriel@gmail.com')->where('status','In Progress')->count();
    $args = ["user_id"=>"uriel@gmail.com","keyword"=>"g"];
    return  DB::select('SELECT * FROM `tasks` WHERE `user_id` = ? AND (`title` LIKE ? OR `description` LIKE ?) LIMIT ?', [$args["user_id"],"%{$args["keyword"]}%","%{$args["keyword"]}%",10]);
    return Hash::make('password');
    $name = "q";
    $email = "z";
    return  dd(User::where("name",'LIKE',"%$name%")->orWhere("email",'LIKE',"%$email%")->get());
    return view('welcome');
});
