@extends('layouts.app')

@section('content')
    <div class="service-index">
        <div class="service-top">
            <img src="/images/tea-time-ga541b7af7_1920.jpg" alt="photo-top-image" class="service-top-image">
            <h1>読む <span style="letter-spacing: -0.2em;">—</span> Learn<span style="letter-spacing: -0.2em;">—</span></h1>

            <div class="service-search-form">
                <form class="d-flex" action="{{ route('article.search') }}" method="GET">
                    <input type="text" class="service-input" name="keyword"  placeholder="Search" value="{{ $keyword }}">
                    <button type="submit" class="service-input"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="article">
            @foreach ($articles as $article)
                <div class="article-wrapper">
                    <div class="article-image">
                        <img src="{{ Storage::url($article->image) }}" alt="Card image cap">
                    </div>
                    <div class="article-contents">
                        <h3 class="article-title">{{ $article->title }}</h5>
                        <p class="article-body">{{ $article->associate->name }}</p>
                        <div class="article-tags">
                            @foreach($article->tags as $tag)
                                <p>#{{ $tag->name }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection