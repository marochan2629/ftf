@extends('layouts.app')

@section('content')



    <h1 class="text-center mt-2 mb-5">記事詳細</h1>
    <div class="container mb-5">
        <div class="row">
            <p class="col-sm-2">記事 ー タイトル</p>
            <p class="col-sm-10">{{ $article->title }}</p>
        </div>
            
        <div class="row">
            <p class="col-sm-2">記事 ー 本文</p>
            <p class="col-sm-10">{{ $article->body }}</p>
        </div>

        @if($article->image)
            <div class="form-group row">
                <p class="col-sm-2 col-form-label">画像</p>
                <div class="col-sm-10">
                    <img src="{{ Storage::url($article->image) }}" width="25%">
                </div>
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
        @endguest

        <div class="text-center">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#commentModal" data-whatever={{ $article->title }}>コメントを投稿する</button>
        </div>
        

        <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="commentModalLabel">New message</h4>
                    </div>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- <form action="{{ route('comment.store') }}" method="POST"> -->
                                <!-- <div class="form-group">
                                    <label for="recipient-name" class="control-label">Recipient:</label>
                                    <input type="text" class="form-control" id="recipient-name">
                                </div> -->
                                <div class="form-group">
                                    <label for="message-text" class="control-label">コメント</label>
                                    <textarea class="form-control" id="message-text" name="body"></textarea>
                                </div>
                            <!-- </form> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">戻る</button>
                            <button type="submit" class="btn btn-primary">投稿する</button>
                        </div>
                        <input type="hidden" value="{{ $article->id }}" name="article_id">
                    </form>
                </div>
            </div>
        </div>

    </div>

<script>
window.addEventListener('DOMContentLoaded', function(){
    $('#commentModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
        var recipient = button.data('whatever') //data-whatever の値を取得

        //Ajaxの処理はここに

        var modal = $(this)  //モーダルを取得
        modal.find('.modal-title').text('associateid:' + recipient) //モーダルのタイトルに値を表示
        modal.find('.modal-body input#recipient-name').val(recipient) //inputタグにも表示
    })
})
</script>
@endsection