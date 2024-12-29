<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\DependencyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/posts/{post:slug}', PostController::class)->name('posts.show');
Route::get('/acciones/{action:slug}', ActionController::class)->name('actions.show');
Route::get('/noticias', NewsController::class)->name('news.index');
Route::get('/dependencias/{dependency:slug}', DependencyController::class)->name('dependencies.show');
