<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class UserController extends Controller
{
    // マイページを表示するメソッド
    public function mypage()
    {
        // ログインしているユーザー情報を取得
        $user = Auth::user();

        // ユーザーの予約情報を取得（施設情報も一緒に取得）
        $reservations = Reservation::where('user_id', $user->id)
                                    ->with('facility')
                                    ->get();

        // マイページのビューにデータを渡す
        return view('mypage', compact('user', 'reservations'));
    }
}
