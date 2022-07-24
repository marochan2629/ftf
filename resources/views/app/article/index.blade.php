@extends('layouts.app')

<?php

$tag_names = ['キリスト教','イスラム教','仏教','イエス','ブッダ','ムハンマド']

?>

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
                    <a href="/article/show/{{ $article->id }}">
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
                    </a>
                </div>
            @endforeach
            <div class="article-pagination">{{ $articles->links() }}</div>
        </div>

        <div class="article-tag-search">
            <div class="article-tag-search-title">
                <h3>タグで検索</h3>
            </div>
            <div class="article-tag-search-form">
                @for($i = 0; $i < 6; $i++)
                    <form method="GET" name="keyword" action="{{ route('article.tag-search') }}">
                        <input type="hidden" name="keyword" value="{{ $tag_names[$i] }}">
                        <a href="javascript:keyword[{{ $i }}].submit()">{{ $tag_names[$i] }}</a>
                    </form>
                @endfor
            </div>
        </div>
    </div>

@endsection