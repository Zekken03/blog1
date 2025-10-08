<?php

use Illuminate\Support\Facades\Route;
//IMPORTAR CONTROLADOR
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;

//ENDPOINT
Route::get('/', function () {
    return view('welcome');
});
Route::get("/contacto", function () {
    return view('contacto');
});
Route::get("/post", function () {
    return view('post');
});
Route::get("/about", function () {
    return view('about');
});
Route::group(['prefix' => 'dashboard'], function () {
    Route::resource('/', DashboardController::class);
    Route::resource('/posts', PostsController::class);
    Route::get('/posts/actions/add', [PostsController::class, 'showAdd']);
    //RUTAS PARA USUARIOS
    Route::get('/users', [UsersController::class, 'getUsers']);
    Route::post("/users",[UsersController::class,'createUsers']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
