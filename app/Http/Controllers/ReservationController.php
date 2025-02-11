<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create($facilityId)
    {
        // 施設情報を取得
        $facility = Facility::findOrFail($facilityId);

        // 予約ページに施設情報を渡す
        return view('reservations.create', compact('facility'));
    }

    public function store(Request $request, $facilityId)
    {
        $request->validate([
            'reservation_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // 予約重複チェック
        $conflict = Reservation::where('facility_id', $facilityId)
            ->where('reservation_date', $request->reservation_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                    ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['error' => '指定された時間帯はすでに予約されています。']);
        }

        Reservation::create([
            'user_id' => Auth::id(),
            'facility_id' => $facilityId,
            'reservation_date' => $request->reservation_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('facilities.show', $facilityId)
            ->with('success', '予約が完了しました！');
    }



}
