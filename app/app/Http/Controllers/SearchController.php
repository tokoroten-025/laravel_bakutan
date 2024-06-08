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
        if ($request->input('keyword')) {
            $search = $request->input('keyword');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // 宿泊可能日検索
        if ($request->input('checkindate')) {
            $date = $request->input('checkindate');
            $query->where('checkindate', '>=', $date);
        }

        // 金額検索
        if ($request->input('price_range')) {
            $priceRange = explode('-', $request->input('price_range'));
            if (count($priceRange) == 2) {
                $query->whereBetween('amount', [intval($priceRange[0]), intval($priceRange[1])]);
            }
        }

        $latestPosts = $query->get();

        $keyword = $request->input('keyword');
        $checkindate = $request->input('checkindate');
        $price_range = $request->input('price_range');


        return view('home', [
            'latestPosts' => $latestPosts,
            'keyword' => $keyword,
            'checkindate' => $checkindate,
            'price_range' => $price_range,
        ]);
    }
}
