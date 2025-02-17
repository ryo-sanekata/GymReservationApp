@extends('layouts.app')

@section('content')
<div class="container">
    <h2>施設削除確認</h2>

    <p>施設名: {{ $facility->name }}</p>
    <p>価格: ¥{{ number_format($facility->price_per_hour) }}</p>
    <p>カテゴリー: {{ $facility->category }}</p>

    <p>本当にこの施設を削除しますか？</p>

    <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>
        <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
