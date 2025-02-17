<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric|min:0',
            'category' => 'required|string',
        ]);

        Facility::create($request->all());

        return redirect()->route('facilities.index')->with('success', '施設を登録しました！');
    }


    // 施設削除確認ページ
    public function delete(Facility $facility)
    {
        return view('admin.facilities.delete', compact('facility'));
    }

    // 施設削除アクション
    public function destroy(Facility $facility)
    {
        // 施設を削除
        $facility->delete();

        // 施設一覧ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('admin.facilities.index')->with('success', '施設が削除されました');
    }
}

