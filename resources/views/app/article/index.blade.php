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

        <div class="articles-and-sidebar">
            <div class="articles">
                @foreach ($articles as $article)
                    <div class="article-wrapper">
                        <a href="/article/show/{{ $article->id }}">
                            <div class="article-image">
                                <img src="{{ $article['image'] }}" alt="Card image cap">
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
            </div>

            <div class="article-sidebar">
                <div class="article-tag-search">
                    <div class="article-tag-search-title">
                        <h3>タグで選ぶ</h3>
                        <p>Tags</p>
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
                <div class="latest-articles">
                        <div class="latest-articles-title">
                            <h3>最新記事</h3>
                            <p>New Topics</p>
                        </div>
                        @foreach ($latest_articles as $latest_article)
                            <a href="/article/show/{{ $latest_article->id }}">
                                <div class="latest-article">
                                    <img src="{{ $article['image'] }}" alt="Card image cap">
                                    <h5>{{ $latest_article->title }}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
            </div>
        </div>

        <div class="article-pagination">{{ $articles->links() }}</div>

    </div>

@endsection