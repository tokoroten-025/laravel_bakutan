<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RyokanPageController;
use App\Http\Controllers\UserPageController;

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
//　ログイン認証
Auth::routes();

// トップページ（今回HOME画面になるところ）
Route::get('/', [HomeController::class, 'index']);
// 一般ユーザーマイページ
Route::middleware(['auth', 'role:user'])->get('/mypage', [UserPageController::class,'index'])->name('user.mypage');
// Route::get('/mypage', [UserPageController::class,'index'])->name('user.mypage');

// 旅館ユーザーマイページ
Route::middleware(['auth', 'role:ryokan'])->get('/ryokan/mypage', [RyokanPageController::class,'index'])->name('ryokan.mypage');
// Route::get('/ryokan/mypage', [RyokanPageController::class,'index'])->name('ryokan.mypage');

// 新規投稿画面
Route::get('/posts/create', [PostController::class,'createPostForm'])->name('posts.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');
