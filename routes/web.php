<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\DependencyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\MexicoNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PhotoGalleryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SegobNewsController;
use App\Http\Controllers\VersionController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/noticias', NewsController::class)->name('news.index');
Route::get('/noticias-segob', SegobNewsController::class)->name('segob-news.index');
Route::get('/versiones', VersionController::class)->name('versions.index');
Route::get('/galerias', [PhotoGalleryController::class, 'index'])->name('photo-galleries.index');
Route::get('/documentos', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/infografias', [InfographicController::class, 'index'])->name('infographics.index');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/noticias-mexico', MexicoNewsController::class)->name('mexico-news.index');

Route::get('/videos/{video:slug}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/galerias/{photoGallery:slug}', [PhotoGalleryController::class, 'show'])->name('photo-galleries.show');
Route::get('/documentos/{document:slug}', [DocumentController::class, 'show'])->name('documents.show');
Route::get('/posts/{post:slug}', PostController::class)->name('posts.show');
Route::get('/acciones/{action:slug}', ActionController::class)->name('actions.show');
Route::get('/dependencias/{dependency:slug}', DependencyController::class)->name('dependencies.show');
