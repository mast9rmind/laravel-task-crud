<?php

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::redirect('/', '/tasks');

Route::get('/tasks', function () {
    return view('index', ['tasks' => Task::latest()/* ->where('completed', true) */->get()]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
    ->name('tasks.create');


Route::get('tasks/{task}/edit', function (Task $task) {
    return view('edit', [
        'task' => $task
    ]);
})->name('tasks.edit');

Route::get('tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task created successfully');
})->name('tasks.store');

Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully');
})->name('tasks.update');


Route::delete('/tasks/{task}', function (Task $task , Request $request) {
    $task->delete();

    return redirect()->route('tasks.index')
        ->with('success', 'Task deleted successfully');
})->name('tasks.destroy');


// Route::get('/hello', function () {
//     return view('hello');
// })->name('hello');

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// })->name('hallo');

// Route::get('/hallo', function () {
//     return redirect()->route('hello');
// });

// Route::fallback( function() {
//     return "You didn't match any route";
// })->name('not-found');
