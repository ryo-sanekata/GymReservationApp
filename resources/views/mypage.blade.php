@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ Auth::user()->name }}さんのマイページ</h2>

    @auth
        @if(auth()->user()->admin)
            <a class="btn btn-primary" href="{{ route('admin.facilities.create') }}">施設登録</a>

            <h3>登録施設一覧</h3>
            @if ($facilities->isEmpty())
                <p>登録されている施設はありません。</p>
            @else
                <ul>
                    @foreach ($facilities as $facility)
                        <li>
                            <strong>施設名:</strong> {{ $facility->name }}<br>
                            <strong>カテゴリー:</strong> {{ $facility->category }}<br>
                            <!-- 施設削除ボタン -->
                            <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

        @else
            <h3>予約一覧</h3>
            @if ($reservations->isEmpty())
                <p>現在、予約はありません。</p>
            @else
                <ul>
                    @foreach ($reservations as $reservation)
                        <li>
                            <strong>施設名:</strong> {{ $reservation->facility->name }}<br>
                            <strong>日付:</strong> {{ $reservation->reservation_date }}<br>
                            <strong>時間:</strong> {{ $reservation->start_time }} - {{ $reservation->end_time }}<br>
                        </li>
                        <!-- 予約キャンセルボタン -->
                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">予約キャンセル</button>
                        </form>
                    @endforeach
                </ul>
            @endif
        @endif
    @endauth

    <a href="{{ route('facilities.index') }}" class="btn btn-secondary">トップへ戻る</a>
</div>
@endsection
