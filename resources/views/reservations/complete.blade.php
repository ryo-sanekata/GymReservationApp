@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2 class="my-4">予約が完了しました 🎉</h2>
    <p>ご予約ありがとうございます！</p>
    <a href="{{ route('mypage') }}" class="btn btn-primary">マイページへ</a>
    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">トップへ戻る</a>
</div>
@endsection
