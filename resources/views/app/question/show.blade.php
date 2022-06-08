@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">Q&A詳細</h1>
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

         <div class="form-group row">
            <p class="col-sm-2 col-form-label">回答</p>
            <div class="col-sm-10">
                <div>{{ $question->answer }}</div>
            </div>
        </div>

        @if($question->sup_image)
            <div class="form-group row">
                <p class="col-sm-2 col-form-label">画像</p>
                <div class="col-sm-10">
                    <img src="{{ Storage::url($question->sup_image) }}" width="25%">
                </div>
            </div>
        @endif

    </div>
@endsection