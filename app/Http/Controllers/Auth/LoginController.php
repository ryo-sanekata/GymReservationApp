<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    // ログイン前に認証されているか確認
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログインページの表示（既にログインしていなければ）
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // 認証処理
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // ログイン成功後、強制的に施設検索ページ（index）にリダイレクト
            return redirect()->route('facilities.index');
        }
    
        // ログイン失敗時
        return back()->withErrors([
            'email' => '認証に失敗しました。',
        ]);
    }
    

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();  // ログアウト処理

        $request->session()->invalidate();  // セッション無効化
        $request->session()->regenerateToken();  // セッションのトークンを再生成

        return redirect()->route('facilities.index');  // 施設検索ページにリダイレクト
    }
}
