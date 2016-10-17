<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

Route::group(['middleware' => ['web']], function () {

    //------------------------------------------------------------------

    //---------------------------------------------------------
    // Route::get('/tasks', 'TaskController@index');
    // Route::post('/task', 'TaskController@store');
    // Route::delete('/task/{task}', 'TaskController@destroy');
    //---------------------------------------------------------

    /**
     * Show Task Dashboard
     */
    // Route::get('/', function () {
    //     return view('tasks', [
    //         'tasks' => Task::orderBy('created_at', 'asc')->get()
    //     ]);
    // });

    // /**
    //  * Add New Task
    //  */
    // Route::post('/task', function (Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|max:255',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect('/')
    //             ->withInput()
    //             ->withErrors($validator);
    //     }

    //     $task = new Task;
    //     $task->name = $request->name;
    //     $task->save();

    //     return redirect('/');
    // });

    // /**
    //  * Delete Task
    //  */
    // Route::delete('/task/{id}', function ($id) {
    //     Task::findOrFail($id)->delete();

    //     return redirect('/');
    // });
//------------------------------------------------------------------------

    // Authentication Routes...
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/', function() {
        return view('welcome');
    });

    Route::get('/free_test', function() {
        return view('free_test');
    });

    Route::post('/test_result', function (Request $request) {
        $client = new Client();
        $response = $client->request('POST', 'https://www.16personalities.com/test-results', [
            'form_params' => $request->all(),
        ]);

        echo $response->getBody();
    });

    Route::get('/my_tasks', 'TaskController@index');
    Route::post('/my_tasks_add', 'TaskController@store');
    Route::delete('/my_tasks_del/{task}', 'TaskController@destroy');


    // /**
    //  * Create myself: task dashboard
    //  */
    // Route::get('/my_tasks', function () {
    //     return view('my_tasks', [
    //         'tasks' => Task::orderBy('created_at', 'asc')->get()
    //         ]);
    // });


    // /**
    //  * Create myself: add new task
    //  */
    // Route::post('/my_tasks_add', function(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required | max:255',
    //         ]);

    //     if ($validator->fails()) {
    //         return redirect('/')
    //             ->withInput()
    //             ->withErrors($validator);
    //     }

    //     $newTask = new Task;
    //     $newTask->name = $request->name;
    //     $newTask->save();

    //     return redirect('/my_tasks');
    // });


    // /**
    //  * Create myself: delete task
    //  */
    // Route::delete('/my_tasks_del/{id}', function($id) {
    //     Task::findOrFail($id)->delete();
    //     return redirect('/my_tasks');
    // });
});
