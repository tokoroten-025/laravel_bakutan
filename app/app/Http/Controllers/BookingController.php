<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Booking; // 予約モデルの使用
use App\Post;

class BookingController extends Controller
{
    public function __construct()
    {
        // このコントローラのすべてのメソッドに認証を要求する
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 予約の一覧を表示
        $bookings = Booking::all();     
        // 取得した予約情報をビューに渡す
        return view('bookings.index', ['bookings' => $bookings]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $post = Post::findOrFail($id);
        //予約を作成　フォームを表示
        return view('bookings.create',compact('post'));
    }

    public function confirm(Request $request)
    {
        //バリデーション 

        // フォームからの入力をセッションに保存
        $request->session()->put([
        'name' => $request->input('name'),
        'tel' => $request->input('tel'),
        'checkindate' => $request->input('checkindate'),
        'checkoutdate' => $request->input('checkoutdate'),
        'guests' => $request->input('guests')
        ]);

        return view('bookingconfirm');

        // $request->session()->put('booking_data', $request->all());

        // $post = Post::findOrFail($request->post_id);
        // $data = $request->all();
        // return view('bookings.confirm', compact('post', 'data'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // バリデーション
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'checkindate' => 'required|date',
            'checkoutdate' => 'required|date',
            'guests' => 'required|integer',
            'tel' => 'required|string|max:15',
        ]);

        // 投稿IDを取得
        $postId = $request->input('post_id');
        // ログインしているユーザーを取得
        $user = Auth::user();
        // もしログイン（登録）していない場合はログイン画面へ
        if (!$user) {
            return redirect()->route('login');
        }

        // 予約を新規作成
        $booking = new Booking();
        // 予約に関するデータをリクエストから取得して設定
        $booking->post_id = $request->post_id;
        $booking->user_id = auth()->id();
        $booking->name = $user->name;
        $booking->num_of_guests = $request->input('guests');
        $booking->checkindate = $request->input('checkindate');
        $booking->checkoutdate = $request->input('checkoutdate');
        $booking->tel = $request->input('tel');
        $booking->email = $user->email;
        $booking->updated_at = now(); // 現在の日時をセットする例
        $booking->reservation_datetime = now();

        $booking->save();

        // セッションにフラッシュメッセージを設定
        // $request->session()->flash('status', '予約が完了しました！');

        $request->session()->flash('status', '予約が完了しました！')->forget(['name', 'tel', 'checkindate', 'checkoutdate', 'guests']);
        // // 予約作成後、詳細ページにリダイレクトする
        return redirect()->route('posts.detail', ['post' => $booking->post_id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            // 指定された予約を取得
        $booking = Booking::findOrFail($id);

        // 予約情報を編集ページに渡して表示
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            // 指定された予約を取得
    $booking = Booking::findOrFail($id);

    // 予約情報を更新
    $booking->name = $request->input('name');
    $booking->checkindate = $request->input('checkindate');
    $booking->checkoutdate = $request->input('checkoutdate');
    $booking->num_of_guests = $request->input('guests');
    $booking->tel = $request->input('tel');
    $booking->save();

    // 予約一覧ページにリダイレクト
    return redirect()->route('my.bookings')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //予約取消
        // 予約をキャンセルするロジックを実装する
        $booking = Booking::findOrFail($id);
        $booking->delete();

        // 予約がキャンセルされたことを通知する
        return redirect()->route('my.bookings')->with('success', '予約がキャンセルされました');
    }
}