@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">記事詳細</h1>
    <div class="container mb-5">
        <div class="form-group row">
            <p class="col-sm-2 col-form-label">記事 ー タイトル</p>
            <div class="col-sm-10">
                <p>{{ $article->title }}</p>
            </div>
        </div>
            
        <div class="form-group row">
            <p class="col-sm-2 col-form-label">記事 ー 本文</p>
            <div class="col-sm-10">
                <div>{{ $article->body }}</div>
            </div>
        </div>

        @if($article->image)
            <div class="form-group row">
                <p class="col-sm-2 col-form-label">画像</p>
                <div class="col-sm-10">
                    <img src="{{ Storage::url($article->image) }}" width="25%">
                </div>
            </div>
        @endif
        
    </div>
@endsection