@extends('layouts.app')

@section('content')
    <div class="container photo-index">
        <h1>画像一覧画面</h1>

        <div class="">
            <form class="d-flex" action="{{ route('photo.search') }}" method="GET">
                <input type="search" class="form-control me-2" name="keyword"  placeholder="検索" value="{{ $keyword }}">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form>
        </div>

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