<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Route::get('blade', function () {
   return view('child',['name'=>'还没完！','message' => 'Hello From Welcome Page','time'=>time()]);
});


Route::fallback(function () {
    return '我是最后的屏障';
});

Route::get('task/{id}/delete', function ($id) {
    return '<form method="post" action="' . route('task.delete', [$id]) . '">
                 <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">删除任务</button>
            </form>';
});

Route::delete('task/{id}', function ($id) {
    return 'Delete Task ' . $id;
})->name('task.delete');

Route::middleware('throttle:2,1')->group(function () {
    Route::get('/user', function () {
        return '就说两次';

    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
