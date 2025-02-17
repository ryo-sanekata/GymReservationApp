<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        // 検索クエリの処理
        $query = Facility::query();

        // // カテゴリでの絞り込み
        // if ($request->has('category')) {
        //     $query->where('category', $request->category);
        // }

        // 施設名での検索
        // if ($request->has('search')) {
        //     $query->where('name', 'like', '%' . $request->search . '%');
        // }

        // 価格帯での絞り込み
        if ($request->has('price')) {
            $price = (float) $request->price;  // 数値にキャスト
            $query->where('price_per_hour', '<=', $price);
        }

        $facilities = Facility::all();

        // カテゴリ一覧を取得（重複をなくすためにdistinct()を使用）
        $categories = Facility::select('category')->distinct()->get();
    
        return view('facilities.index', compact('facilities', 'categories'));

        // 施設のリストを取得
        $facilities = $query->get();

        return view('facilities.index', compact('facilities'));
    }

    public function show($id)
    {
        // 指定されたIDの施設を取得
        $facility = Facility::findOrFail($id);

        // 詳細ページビューにデータを渡す
        return view('facilities.show', compact('facility'));
    }

    public function search(Request $request)
    {
        $query = Facility::query();

        // 検索キーワードがある場合のみ検索する
        if ($request->has('keyword') && !empty($request->keyword)) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

            // カテゴリ絞り込み
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        $facilities = $query->get();

        // カテゴリ一覧を取得（ビューのセレクトボックス用）
        $categories = Facility::select('category')->distinct()->get();

        return view('facilities.index', compact('facilities', 'categories'));
    }

}
