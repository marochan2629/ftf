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

                    @if(\Auth::id() == $user->id)
                        <div class="mypage-profile-update">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profileUpdate">
                                プロフィール更新
                            </button>
                        </div>
                    @endif

                    <div class="content-wrap-default mypage-profile-liked-articles">
                        <h4>いいね！した記事</h4>
                        <div class="content-txt mypage-profile-cards">
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
                        @if(count($liked_articles) >= 4)
                            <div class="more-btn more-liked">
                                <p class="opener">もっと見る</p>
                            </div>
                        @elseif(count($liked_articles) == 0)
                            <p>いいね！した記事がありません</p>
                        @endif
                    </div>

                    <div class="content-wrap-default mypage-profile-questions">
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
                        @if(count($user->questions) >= 4)
                            <div class="more-btn more-questions">
                                <p class="opener">もっと見る</p>
                            </div>
                        @elseif(count($user->questions) == 0)
                            <p>まだ質問していません</p>
                        @endif
                    </div>

                    <div class="content-wrap-default mypage-profile-photos">
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
                        @if($user->photos->count() >= 4)
                            <div class="more-btn more-photos">
                                <p class="opener">もっと見る</p>
                            </div>
                        @elseif($user->photos->count() == 0)
                            <p>まだ写真を投稿していません</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="profileUpdate" tabindex="-1" role="dialog" aria-labelledby="profileUpdateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModal3Label">プロフィール更新</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.mypage.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus value="{{ $user->name }}">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autocomplete="email" value="{{ $user->email }}">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('年齢') }}</label>
                            <div class="col-md-6">
                                <input id="age" type="age" class="form-control" name="age" required autocomplete="age" value="{{ $user->age }}">
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="religion" class="col-md-4 col-form-label text-md-right">{{ __('宗教') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="religion" name="religion">
                                    @foreach (config('religion.religions') as $key => $value)
                                        @if($value == $user->religion)
                                            <option value="{{ $value }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('国籍') }}</label>
                            <div class="col-md-6">
                                <select class="form-control" id="country" name="country">
                                    @foreach (config('country.countries') as $key => $value)
                                        @if($value == $user->country)
                                            <option value="{{ $value }}" selected>{{ $value }}</option>
                                        @else
                                            <option value="{{ $value }}">{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">戻る</button>
                            <input type="submit" id="profile_submit" class="btn btn-primary" value='更新' disabled>
                        </div>
                    </form>
                </div>
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

            $(document).on('input', function() {
                var nameInput = $('input[name="name"]').val(); //名前入力欄に入力された文字を取得
                var emailInput = $('input[name="email"]').val(); //メールアドレス入力欄に入力された文字を取得
                var ageInput = $('input[name="age"]').val(); //年齢入力欄に入力された文字を取得
                if(nameInput && emailInput && ageInput){ //もしそれぞれの入力欄に文字が入っていれば
                    $("#profile_submit").prop('disabled', false); //disabled を無効にする＝ボタンが押せる
                }else{
                    $("#profile_submit").prop('disabled', true); //disabled を有効にする＝ボタンが押せない
                }
            });

            if (!$('.mypage-profile-liked-articles').find('.more-liked').length > 0) {
                $('.mypage-profile-liked-articles').removeClass('content-wrap-default').addClass('content-wrap-alternative');
            }
            
            if(!$('.mypage-profile-questions').find('.more-questions').length > 0) {
                $('.mypage-profile-questions').removeClass('content-wrap-default').addClass('content-wrap-alternative');
            }

            if(!$('.mypage-profile-photos').find('.more-photos').length > 0) {
                $('.mypage-profile-photos').removeClass('content-wrap-default').addClass('content-wrap-alternative');
            }
        });
    });
</script>