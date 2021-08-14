<?php

use Illuminate\Support\Facades\Route;
   
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\RoleController;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;




Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {return view('home');});
}); 

Route::group(['middleware' => ['role:user|admin']], function() {
    Route::resource('materi', MateriController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('materi/{id}', 'MateriController@show')->name('materi.show');
    Route::post('materi/request/{id}', 'MateriController@request')->name('materi.request');

    //streaming video
    Route::get('get-video/{video}', 'MateriController@getVideo')->name('getVideo');  
});

Route::group(['middleware' => ['role:admin']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
//    Route::resource('content', ContentController::class);

    //upload file
    Route::get('/content', 'ContentController@index')->name('content.index');
    Route::get('/content/create', 'ContentController@create')->name('content.create');
    Route::post('/save','ContentController@store')->name('content.store');
    Route::post('/delete/{id}','ContentController@destroy')->name('content.destroy');
    Route::get('/approve/{id}','ContentController@approve')->name('content.approve');
    Route::post('/approve/{id}/acc','ContentController@acc')->name('content.acc');
    Route::post('/approve/{id}/tolak','ContentController@decline')->name('content.tolak');
});

Route::get('/logout', function(){
    Auth::logout();
    Session::flush();
    return Redirect::to('/login');
});
