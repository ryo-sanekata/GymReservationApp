<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create($facility_id)
    {
        $facility = Facility::findOrFail($facility_id);
    
        // 予約可能な時間リスト（例: 9:00〜21:00）
        $timeSlots = [];
        for ($hour = 9; $hour <= 21; $hour++) {
            $timeSlots[] = sprintf('%02d:00', $hour);
        }
    
        // 予約済みの時間帯を取得
        $reservedTimes = Reservation::where('facility_id', $facility_id)
            ->where('reservation_date', request('reservation_date'))
            ->pluck('start_time', 'end_time')
            ->toArray();
    
        return view('reservations.create', compact('facility', 'timeSlots', 'reservedTimes'));
    }
    

    public function store(Request $request, $facility_id)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
    
        Reservation::create([
            'user_id' => auth()->id(),
            'facility_id' => $facility_id, // ここを修正
            'reservation_date' => $request->reservation_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
    
        return redirect()->route('reservations.complete');
    }    
    

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
    
        // 予約の所有者かどうかを確認
        if ($reservation->user_id !== auth()->id()) {
            return redirect()->route('mypage')->with('error', '削除権限がありません。');
        }
    
        $reservation->delete();
    
        return redirect()->route('mypage')->with('success', '予約を削除しました。');
    }

}
