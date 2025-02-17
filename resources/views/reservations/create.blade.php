@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $facility->name }} の予約</h2>

    <form action="{{ route('reservations.store', ['facility' => $facility->id]) }}" method="POST">
        @csrf

        <input type="hidden" name="facility_id" value="{{ $facility->id }}">

        <div class="mb-3">
            <label for="reservation_date" class="form-label">予約日</label>
            <input type="date" id="reservation_date" name="reservation_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">開始時間</label>
            <select name="start_time" class="form-control">
                @foreach ($timeSlots as $time)
                    @php
                        $isReserved = false;
                        foreach ($reservedTimes as $end => $start) {
                            if ($time >= $start && $time < $end) {
                                $isReserved = true;
                                break;
                            }
                        }
                    @endphp
                    @if (!$isReserved)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">終了時間</label>
            <select name="end_time" class="form-control">
                @foreach ($timeSlots as $time)
                    <option value="{{ $time }}">{{ $time }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">予約する</button>
        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">トップへ戻る</a>
    </form>
</div>
@endsection
