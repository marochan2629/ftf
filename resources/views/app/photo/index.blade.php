@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像一覧</h1>
    <div class="container">
    <h1>一覧画面</h1>
        @foreach ($photos as $photo)
            <img src="{{ Storage::url($photo->image) }}" width="25%">
        @endforeach
    </div>

@endsection