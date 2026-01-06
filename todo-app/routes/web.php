<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use App\Models\Task;


Route::get('/',function()
 {
   return redirect('tasks');
});
Route::get('/tasks', function ()  {
    $tasks = Task::latest()->paginate();
    return view('index',['tasks' => $tasks]);
})->name('tasks.index');
Route::view('tasks/create',view: 'create')->name('tasks.create');

Route::get('/tasks/{task}/edit',function(Task $task) {
    return view( 'edit',['task'=>$task]);
})->name('tasks.edit');

Route::get('/tasks/{task}',function(Task $task) {
    return view('show',['task'=>$task]);
})->name('tasks.show');

Route::post('/tasks',function(TaskRequest $request){
    $task = Task::create($request->validated());
    return redirect()->route('tasks.show',['task'=>$task->id])
    ->with('success','Task created successfully');
})->name('tasks.store');


Route::put('/tasks/{task}',function(Task $task, TaskRequest $request)
{
     $task->update($request->validated());
    return redirect()->route('tasks.show',['task' => $task])
    ->with('success','Task updated successfully');
})->name('tasks.update');

Route::delete('/tasks/{task}',function(Task $task){
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destroy');

Route::put('tasks/{task}/toggle-complete',function(Task $task){
    $task->toggleCompleted();
    return redirect()->back()->with('success','Task successfully updated!');
})->name('tasks.toggle-complete');