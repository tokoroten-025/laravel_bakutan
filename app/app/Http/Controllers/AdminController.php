<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Post;
// 必要に応じてユーザーモデルをインポートする

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     // 一般ユーザーのリストを取得
     $users = User::where('role', 10)->get();
     // 旅館運営ユーザーの投稿のリストを取得
     $posts = Post::all();

     return view('admins.dashboard', ['users' => $users, 'posts' => $posts]);
    }

    public function adminDashboard()
    {
        // 表示停止された投稿件数の多いユーザー上位10件
        $users = User::withCount(['posts' => function ($query) {
            $query->where('status', 'suspended');
        }])
        ->orderBy('posts_count', 'desc')
        ->take(10)
        ->get();

        // 違反報告数の多い投稿上位20件
        $posts = Post::withCount('reports')
        ->orderBy('reports_count', 'desc')
        ->take(20)
        ->get();

        return view('admin', compact('users', 'posts'));
    }

    
    }
