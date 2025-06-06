<?php

use App\Http\Controllers\Api\ContentTypeListController;
use App\Http\Controllers\Api\DependencyListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/content-types', ContentTypeListController::class);
Route::get('/dependencies', DependencyListController::class);
