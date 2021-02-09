<?php

use App\Models\Task;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    $tasks = DB::select("select * from tasks order by created_at");

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

Route::get('/sea', function () {
    $results = array();
    return view('search', [
        'results' => $results
    ]);
});

Route::post('/sea', function (Request $request) {
    $user = 'blogingdb';
    $pass = 'gamemode01';


    try {
        $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=blogingdb', $user, $pass);
        $results = $dbh->query('SELECT * from tasks where name LIKE \'%'.$request->name.'\'');
        $results = $results->fetchAll();

        return view('search', [
            'results' => $results
        ]);
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

});


Route::post('/task', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }

    $task = DB::insert("insert into tasks (name) values ('$request->name');");


    return redirect('/');
});

Route::delete('/task/{task}', function (Task $task) {
    $task->delete();

    return redirect('/');
});
