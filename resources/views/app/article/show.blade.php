@extends('layouts.app')

@section('content')
    <div class="article-show container">  
        @if($article->image)
            <div class="article-show-image">
                <a href="{{ $article['image'] }}">
                    <img src="{{ $article['image'] }}">
                </a>
            </div>
        @endif

        <div class="article-show-title">
            <h1>{{ $article->title }}</h1>
            <p>{{ $article->associate->name }}</p>
        </div>
            
        <div class="article-show-body">
            <p>{!! nl2br(e($article->body)) !!}</p>
        </div>

        @if(\Auth::guard('associate')->check())
            <div class="article-show-delete text-center">
                <form action="/article/delete/{{$article->id}}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                </form>
            </div>
        @endif

        @if(\Auth::guard('user')->check())
        <!-- Review.phpに作ったisLikedByメソッドをここで使用 -->
            @if (!$article->isLikedBy(Auth::user()))
                <span class="likes">
                    <i class="fas fa-heart like-toggle" data-article-id="{{ $article->id }}"></i>
                    <span class="like-counter">{{$article->likes_count}}</span>
                </span><!-- /.likes -->
            @else
                <span class="likes">
                    <i class="fas fa-heart heart like-toggle liked" data-article-id="{{ $article->id }}"></i>
                    <span class="like-counter">{{$article->likes_count}}</span>
                </span><!-- /.likes -->
            @endif
        @else
            <span class="likes">
                <i class="fas fa-heart heart"></i>
                <span class="like-counter">{{$article->likes_count}}</span>
            </span><!-- /.likes -->
        @endif
    </div>

    <div class="article-show-comments">
        <div class="article-show-comments-index">
            <p><i class="fa-solid fa-comment-dots"></i>コメント（{{ $comments->count() }}）</p>
        </div>

        @if(\Auth::guard('user')->check())
            <div class="text-center article-show-comment-button">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commentModal" data-whatever={{ $article->title }}>コメントを投稿する</button>
            </div>
        @else
            <div class="text-center login-to-comment">
                <a  href="/user/login">ログインしてコメントを投稿</a>
            </div>
        @endif

        @foreach($comments as $comment)
            <div class="row article-show-comment">
                <p class="col-sm-2">{{ $comment->user->name }}</p>
                <p class="col-sm-10">{!! nl2br(e($comment->body)) !!}</p>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="control-label">コメント</label>
                            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" id="message-text" name="body"></textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">戻る</button>
                        <input type="submit" id="comment_submit" class="btn btn-primary" value='投稿' disabled>
                    </div>
                    <input type="hidden" value="{{ $article->id }}" name="article_id">
                </form>
            </div>
        </div>
    </div>
            
@endsection

<script>
    window.addEventListener('DOMContentLoaded', function(){
        $('#commentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
            var recipient = button.data('whatever') //data-whatever の値を取得

            //Ajaxの処理はここに
            var modal = $(this)  //モーダルを取得
            modal.find('.modal-title').text('associateid:' + recipient) //モーダルのタイトルに値を表示
            modal.find('.modal-body input#recipient-name').val(recipient) //inputタグにも表示
        });

        $(".btn-dell").click(function(){
            if(confirm("本当に削除しますか？")){
                //そのままsubmit（削除）
            }else{
                //cancel
                return false;
            }
        });
    })
</script>