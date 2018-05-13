<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;



class TasksController extends Controller
{

    public function main()
    {
        return view('tasks.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderBy('created_at','desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $task=new Task;

        
        $task->name=request('name');
        $task->save();

        return $task;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->name = request('name');
        $task->save();

        return $task;
    }
    public function done(Request $request, Task $task)
    {
        $task->completionDate = date('Y-m-d H:i:s');
        $task->save();
        return $task;
    }
    public function undone(Request $request, Task $task)
    {
        $task->completionDate = null;
        $task->save();
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $taskId=$task->id;
        $task->delete();

        return $taskId;
    }
}
