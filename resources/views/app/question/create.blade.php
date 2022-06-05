@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">質問画面</h1>
    <div class="container mb-5">
        <form action="{{ route('question.store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <p class="col-sm-1 col-form-label">タイトル</p>
                <div class="col-sm-11">
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            
            <div class="form-group row">
                <p class="col-sm-1 col-form-label">本文</p>
                <div class="col-sm-11">
                    <textarea class="form-control" name="body" id="body" cols="100" rows="15"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-1 col-form-label">画像</p>
                <div class="col-sm-11">
                    <input type="file" name="image">
                </div>
            </div>

            <div class="text-center">
                <input type="submit" value="質問を投稿する">
            </div>
        </form>
    </div>
@endsection