<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RyokanPageController;
use App\Http\Controllers\UserPageController;
use Facade\Ignition\Http\Controllers\ExecuteSolutionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;



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
Auth::routes(['reset' => true]);
// ★★★トップページ（今回HOME画面になるところ）
Route::get('/', [HomeController::class, 'index'])->name('home');
// 検索結果ページ
Route::get('/search/result', [SearchController::class, 'search'])->name('search');


// ログインが必要なルート
Route::middleware(['auth'])->group(function () {
// ★★★旅館ユーザーマイページ
Route::get('/ryokan/mypage', [RyokanPageController::class,'index'])->name('ryokan.mypage');
// 旅館ユーザー情報の編集
Route::get('/ryokan/{id}/edit', [RyokanPageController::class,'edit'])->name('ryokan.edit');
// 旅館ユーザー情報の更新
Route::put('/ryokan/{id}/update', [RyokanPageController::class,'update'])->name('ryokan.update');
//　旅館ユーザーの退会
Route::delete('/ryokan/{id}/delete', [RyokanPageController::class,'destroy'])->name('ryokan.destroy');
//　削除確認画面
Route::get('/ryokan/delete/confirm', [RyokanPageController::class,'confirmDelete'])->name('delete.confirm');
//　論理削除
Route::post('/ryokan/delete', [RyokanPageController::class,'delete'])->name('ryokan.delete');

// 投稿関連ルート
// 新規投稿
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
// 投稿保存
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
// 投稿詳細　※routes/web.phpにも紐付けた
Route::get('/posts/{post}/detail', [PostController::class,'show'])->name('posts.detail');
// 投稿編集
Route::get('/posts/{post}/edit', [PostController::class,'edit'])->name('posts.edit');
// 投稿更新
Route::put('/posts/{post}', [PostController::class,'update'])->name('posts.update');
// 投稿削除
Route::delete('/posts/{post}', [PostController::class,'destroy'])->name('posts.destroy');
// 投稿削除
Route::delete('/posts/{post}/soft-delete', [PostController::class, 'softDestroyPost'])->name('posts.softDestroyPost');
});


// 一般ユーザーマイページ
Route::middleware(['auth'])->group(function () {
// ユーザーマイページ
Route::get('/user/mypage', [UserPageController::class,'index'])->name('user.mypage');
// ユーザー編集ページ 
Route::get('/user/{id}/edit', [UserPageController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserPageController::class, 'update'])->name('user.update');
// 削除
Route::delete('/user/{id}', [UserPageController::class, 'destroy'])->name('user.destroy');

// 予約関連ルート
Route::get('/posts/{post}/detail', [PostController::class, 'show'])->name('posts.detail');

// 予約フォーム画面
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
// 予約フォーム画面
Route::get('/bookings/{post}/create', [BookingController::class, 'create'])->name('bookings.create');
// 確認画面表示ルート
Route::post('/bookings/{id}/confirm', [BookingController::class,'confirm'])->name('bookings.confirm');
// 予約処理ルート
Route::post('/bookings/store', [BookingController::class,'store'])->name('bookings.store');
// 詳細　
Route::get('/post/{post}', [PostController::class,'show'])->name('posts.detail');
// 保存
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
});

// 後で書き直す！初期にAuth::routes();をコメントアウトして、これ書いたらなんでかエラー無くなった
// ログアウトルート
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
