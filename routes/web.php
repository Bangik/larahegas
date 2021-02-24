<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function(){
  Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
  Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories-create');
  Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories-store');
  Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories-edit');
  Route::post('/categories/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories-update');
  Route::get('/categories/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('categories-delete');

  Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
  Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('posts-create');
  Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('posts-store');
  Route::post('ckeditor/upload', [App\Http\Controllers\PostController::class, 'upload'])->name('ckeditor.image-upload');
  Route::get('/posts/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('posts-edit');
  Route::post('/posts/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('posts-update');
  Route::get('/posts/buang/{id}', [App\Http\Controllers\PostController::class, 'buang'])->name('posts-buang');
  Route::get('/posts/trashed', [App\Http\Controllers\PostController::class, 'trashed'])->name('posts-trashed');
  Route::get('/posts/restore/{id}', [App\Http\Controllers\PostController::class, 'restore'])->name('posts-restore');
  Route::get('/posts/delete/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts-delete');
});
