@extends('layouts.app')

@section('content')
<div class="container">
    <h1>施設一覧</h1>

    <!-- 検索フォーム -->
    <form action="{{ route('facilities.search') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="search">施設名で検索:</label>
            <input type="text" name="keyword" id="search" class="form-control" value="{{ request('keyword') }}">
        </div>
        <div class="form-group">
            <label for="category">カテゴリーで絞り込み:</label>
            <select name="category" id="category" class="form-control">
                <option value="">すべてのカテゴリ</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- <div class="form-group">
            <label for="price">最大料金（1時間）:</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ request('price') }}" min="0">
        </div> -->
        <button type="submit" class="btn btn-primary mt-2">検索</button>
    </form>

    <!-- 施設一覧表示 -->
    @if ($facilities->isEmpty())
        <p>該当する施設は見つかりませんでした。</p>
    @else
        <div class="row">
            @foreach ($facilities as $facility)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $facility->name }}</h5>
                            <p class="card-text">{{ $facility->description }}</p>
                            <p><strong>価格:</strong> ¥{{ number_format($facility->price_per_hour) }} / 時間</p>
                            <p><strong>カテゴリー:</strong> {{ $facility->category }}</p>
                            <a href="{{ route('facilities.show', ['id' => $facility->id]) }}" class="btn btn-primary">詳細を見る</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
