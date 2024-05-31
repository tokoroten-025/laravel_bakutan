<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Post;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RyokanPageController;
use App\Http\Controllers\UserPageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RepostController;
use App\Like;
use App\Http\Controllers\AdminController;



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
// 未ログインユーザーがアクセスできるルート
Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.detail');
//　ログイン認証
Auth::routes(['reset' => true]);
// ★★★トップページ（今回HOME画面になるところ）
Route::get('/', [HomeController::class, 'index'])->name('home');
// 検索結果ページ
Route::get('/search/result', [SearchController::class, 'search'])->name('search.result');


// ログインが必要なルート
Route::middleware(['auth'])->group(function () {
// ★★★旅館ユーザーマイページ
Route::get('/ryokan/mypage', [RyokanPageController::class,'index'])->name('ryokan.mypage');
Route::post('/ajaxlike', [PostController::class, 'ajaxlike'])->name('posts.ajaxlike');
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
// 予約一覧画面へ
Route::get('/user/index', [UserPageController::class, 'myBookings'])->name('my.bookings');
// 
Route::get('/user/bookings', [UserPageController::class, 'myBookings'])->name('user.bookings');
// 予約フォーム画面
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
// 予約作成画面
Route::get('/bookings/{post}/create', [BookingController::class, 'create'])->name('bookings.create');
// 確認画面表示のルート追加
Route::post('/bookings/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
// 予約編集ページ
Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
// 予約更新
Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
// 予約処理
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
// 投稿詳細　
Route::get('/post/{post}', [PostController::class,'show'])->name('posts.detail');
// 保存
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
// 予約キャンセル
Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
// いいね機能
Route::post('/ajaxlike', [PostController::class, 'ajaxlike'])->name('posts.ajaxlike');
// ブックマーク一覧ページ
Route::get('/user/likes', [UserPageController::class, 'likes'])->name('likes');
//  違反報告
    Route::post('/repost/{postId}', [RepostController::class, 'reportPost'])->name('repost.post');
    Route::get('/reposts', [RepostController::class, 'index'])->name('reposts.index');
    Route::get('/reposts/{id}', [RepostController::class, 'show'])->name('reposts.show');
    Route::put('/reposts/{id}/resolve', [RepostController::class, 'resolve'])->name('reposts.resolve');
});

// 管理者
Route::middleware(['auth'])->group(function () {
    Route::get('/admins/dashboard', [AdminController::class, 'index'])->name('admin.index');
});

// ログアウトルート
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
