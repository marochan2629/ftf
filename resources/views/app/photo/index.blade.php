@extends('layouts.app')

@section('content')
    <div class="container photo-index">
        <h1>画像一覧画面</h1>
        <div class="card-columns" id="photo">
            @foreach ($photos as $photo)
                    <div class="card">
                        <a href="{{ Storage::url($photo->image) }}" rel="lightbox">
                            <img src="{{ Storage::url($photo->image) }}" width="100%">
                        </a>
                    </div>
            @endforeach
        </div>
    </div>

@endsection