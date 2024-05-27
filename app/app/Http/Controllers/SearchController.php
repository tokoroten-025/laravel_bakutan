<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // もしくは検索対象のモデル

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // フォームの送信内容を取得し、処理するコードを記述する
        $query = Post::query();

        // テキスト検索
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('address', 'LIKE', "%{$search}%");
            });
        }

        // 宿泊可能日検索
        if ($request->filled('date')) {
            $date = $request->input('date');
            $query->where('available_date', '>=', $date);
        }

        // 金額検索
        if ($request->filled('price')) {
            $priceRange = explode('-', $request->input('price'));
            if (count($priceRange) == 2) {
                $query->whereBetween('price', [intval($priceRange[0]), intval($priceRange[1])]);
            }
        }

        $posts = $query->get();

        return view('search', compact('posts'));
    }
}
