@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $facility->name }}</h1>
    <p><strong>住所:</strong> {{ $facility->address }}</p>
    <p><strong>説明:</strong> {{ $facility->description }}</p>
    <p><strong>1時間あたりの料金:</strong> ¥{{ $facility->price_per_hour }}</p>
    <p><strong>カテゴリー:</strong> {{ $facility->category }}</p>

    <a href="{{ route('reservations.create', ['facility' => $facility->id]) }}" class="btn btn-primary">
        予約する
    </a>
</div>
@endsection
