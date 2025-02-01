<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function (){
    return view('index', [
        'tasks' => \App\Models\Task::latest()->get()
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{id}', function ($id) {
   return view('show', [
       'task' => Task::findOrFail($id)
   ]);
})->name('tasks.show');

Route::post('/tasks', function (Request $request) {
    $data = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required'
    ]);

    $task = new Task;
    $task->title = $data['title'];
    $task->description = $data['description'];
    $task->long_description = $data['long_description'];

    $task->save();

    return redirect()->route('tasks.show', ['id' => $task->id])
        ->with('success', 'Task created successfully!');
})->name('tasks.store');

Route::get('/hello', function () {
    return 'Hello';
})->name('hello');

Route::get('/greet/{name}', function ($name) {
    return 'Hello ' . $name . '!';
});

Route::get('/hallo', function () {
    return redirect()->route('hello');
});

Route::fallback(function () {
   return 'Still got somewhere!';
});
