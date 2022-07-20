@extends('layouts.app')

@section('content')
    <div class="container article-top">
        <h1>読む</h1>

        <div class="article-search-form">
            <form class="d-flex" action="{{ route('article.search') }}" method="GET">
                <input type="text" class="article-input" name="keyword"  placeholder="Search" value="{{ $keyword }}">
                <button type="submit" class="article-input"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

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