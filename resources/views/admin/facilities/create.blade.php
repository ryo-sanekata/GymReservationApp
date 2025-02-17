@extends('layouts.app')

@section('content')
<div class="container">
    <h1>施設を新規登録</h1>

    <form action="{{ route('admin.facilities.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">施設名</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" name="address" id="address" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">説明</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price_per_hour">料金（1時間あたり）</label>
            <input type="number" name="price_per_hour" id="price_per_hour" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category">カテゴリー</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">登録</button>
    </form>
</div>
@endsection
