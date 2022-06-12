@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">記事一覧</h1>
    <div class="container">
    <h1>一覧画面</h1>
        @foreach ($articles as $article)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <p class="card-text">{{ $article->body }}</p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                </div>
            </div>
        @endforeach
    </div>

@endsection