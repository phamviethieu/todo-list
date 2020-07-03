<?php

use App\Http\Middleware\Locate;
use Illuminate\Http\Request;
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
Route::group(['middleware' => 'locate'], function() {
    Route::get('change-language/{language}', 'TaskController@changeLanguage')
        ->name('user.change-language');
    Auth::routes();
    
    Route::resource('tasks','TaskController');
});
