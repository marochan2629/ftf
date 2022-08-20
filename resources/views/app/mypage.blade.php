@extends('layouts.app')

@section('content')
    <div class="mypage">
        <div class="mypage-top-image">
            <h1>Your Profile</h1>
        </div>
        <div class="mypage-main">
            <div class="mypage-profile card">
                <div class="mypage-profile-main">
                    <div class="mypage-profile-information">
                        <div class="mypage-profile-icon">
                            <img src="/images/cat-g06fa9aedb_1920.jpg" alt="">
                        </div>
                        <div class="mypage-profile-detail">
                            <div class="mypage-profile-name">
                                <h2>{{ $user->name }}（{{ $user->age }}）</h2>
                            </div>
                            <div class="mypage-profile-country">
                                <h6>国籍　/　{{ $user->country }}</h6>
                            </div>
                            <div class="mypage-profile-religion">
                                <h6>信じている宗教　/　{{ $user->religion }}</h6>
                            </div>
                            <div class="mypage-profile-email">
                                <h6>メールアドレス　/　{{ $user->email }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mypage-profile-self-introduction">
                        <p>
                            usersテーブルに自己紹介をするカラムを追加してここに表示させる予定です。何文字に制限するかわかりませんが今は適当に入力しておきます。ああお腹すいた何食べようかな家に帰って作るのもめんどいけど買うとお金かかるしどうしようかなあああ塊魂したいな
                            コードが長くなるので改行したよ。ブラウザで見ると改行されないので見る人には関係ないけどね。
                        </p>
                    </div>
                    <div class="content-wrap mypage-profile-liked-articles">
                        <h4>いいね！した記事</h4>
                        <div class="content-txt mypage-profile-cards js-accordion">
                            @foreach($liked_articles as $liked_article)
                                <div class="card mypage-profile-card mypage-profile-liked-article">
                                    <a href="{{ route('article.show', $liked_article->id) }}">
                                        <img class="card-img-top" src="{{ Storage::url($liked_article->image) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h6>{{ $liked_article->title }}</h6>
                                            <p>{{ $liked_article->associate->name }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="more-btn">
                            <p class="opener">もっと見る</p>
                        </div>
                    </div>
                    <div class="content-wrap mypage-profile-questions">
                        <h4>送った質問</h4>
                        <div class="content-txt mypage-profile-cards">
                            @foreach($user->questions as $question)
                                <div class="card mypage-profile-card mypage-profile-question">
                                    <a href="{{ route('question.show', $question->id) }}">
                                        <div class="card-body mypage-profile-question-body">
                                            <h6>{{ $question->title }}</h6>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="more-btn">
                            <p class="opener">もっと見る</p>
                        </div>
                    </div>
                    <div class="content-wrap mypage-photos">
                        <h4>投稿した写真</h4>
                        <div class="content-txt mypage-profile-cards">
                            @foreach($user->photos as $photo)
                                <div class="mypage-profile-card">
                                    <a href="{{ Storage::url($photo->image) }}" rel="lightbox">
                                        <img src="{{ Storage::url($photo->image) }}" width="100%">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="more-btn">
                            <p class="opener">もっと見る</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mypage-likes">
    
            </div>
            <div class="mypage-comments">
    
            </div>
            <div class="mypage-questions">
    
            </div>
            <div class="mypage-photos">
    
            </div>
        </div>
    </div>
@endsection

<script>
    window.addEventListener('DOMContentLoaded', function(){
        $(function() {
            $('.more-btn').on('click', function() {
                if( $(this).children().is('.opener') ) {
                    $(this).html('<p class="closer">閉じる</p>').addClass('close-btn');
                    $(this).parent().removeClass('slide-up').addClass('slide-down');
                    } else {
                    $(this).html('<p class="opener">もっと見る</p>').removeClass('close-btn');
                    $(this).parent().removeClass('slide-down').addClass('slide-up');
                }
            });
        });
    });
</script>