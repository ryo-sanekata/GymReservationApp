@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $facility->name }}の予約</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reservations.store', $facility->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="reservation_date" class="form-label">予約日</label>
            <input type="date" name="reservation_date" id="reservation_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="start_time" class="form-label">開始時間</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">終了時間</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">予約する</button>
    </form>
</div>
@endsection
