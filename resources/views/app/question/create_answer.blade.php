@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">回答画面</h1>
    <div class="container mb-5">
        <div class="form-group row">
            <p class="col-sm-2 col-form-label">質問 ー タイトル</p>
            <div class="col-sm-10">
                <p>{{ $question->title }}</p>
            </div>
        </div>
            
        <div class="form-group row">
            <p class="col-sm-2 col-form-label">質問 ー 本文</p>
            <div class="col-sm-10">
                <div>{{ $question->body }}</div>
            </div>
        </div>

        <form action="{{ route('answer.store', ['id' => $question->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
             <div class="form-group row">
                <p class="col-sm-1 col-form-label">回答</p>
                <div class="col-sm-11">
                    <textarea class="form-control" name="answer" id="answer" cols="100" rows="15"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <p class="col-sm-1 col-form-label">画像</p>
                <div class="col-sm-11">
                    <input type="file" name="sup_image">
                </div>
            </div>

            <div class="text-center">
                <input type="submit" value="回答する">
            </div>
        </form>
    </div>
@endsection