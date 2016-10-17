<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    protected $tasks;

    //
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }


    /**
     * List all user's tasks
     * @param Request $request 
     * @return type
     */
    public function index(Request $request)
    {
        //Normal style
        // return view('my_tasks', [
        //     'tasks' => Task::orderBy('created_at', 'asc')->get()
        //     ]);

        //Controller style
        return view('my_tasks', [
            'tasks' => $this->tasks->forUser($request->user()),
            ]);
    }


    /**
     * Save a task
     * @param Request $request 
     * @return type
     */
    public function store(Request $request)
    {
        //Normal style
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required | max:255',
        //     ]);
        // $newTask = new Task;
        // $newTask->name = $request->name;
        // $newTask->save();
        // if ($validator->fails()) {
        //     return redirect('/')
        //         ->withInput()
        //         ->withErrors($validator);
        // }

        //Controller style
        $this->validate($request, [
            'name' => 'required|max:255',
            ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
            ]);

        return redirect('/my_tasks');
    }


    /**
     * Delete a task
     * @return type
     */
    public function destroy(Request $request, Task $task)
    {
        //Normal style
        // Task::findOrFail($id)->delete();
        // return redirect('/my_tasks');

        //Controller style
        $this->authorize('destroy', $task);
        $task->delete();

        return redirect('/my_tasks');
    }
}
