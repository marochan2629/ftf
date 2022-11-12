@extends('layouts.app')

@section('content')
    <div class="service-index">
        <div class="service-top">
            <img src="/images/grandmother-g1fa961d0c_1920.jpg" alt="photo-top-image" class="service-top-image">
            <h1>記事編集 <span style="letter-spacing: -0.2em;">—</span> Edit Articles<span style="letter-spacing: -0.2em;">—</span></h1>
        </div>

        <div class="article-create">
            <div class="article-create-title">
                <h3>記事編集</h1>
            </div>

            <div class="container pb-5">
                <form action="{{ route('article.update', ['id' => $article->id]) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <p class="col-sm-1 col-form-label">タイトル</p>
                        <div class="col-sm-11">
                            <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ $article->title }}">
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                    </div>           
        
                    <div class="form-group row">
                        <p class="col-sm-1 col-form-label">本文</p>
                        <div class="col-sm-11">
                            <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" cols="100" rows="30">{{ $article->body }}</textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <p class="col-sm-1 col-form-label">画像</p>
                        <div class="col-sm-11">
                            <input type="file" name="image">
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <p class="col-sm-1 col-form-label">タグ</p>
                        <div class="col-sm-11">
                            <input type="text" name="tags" id="tags" class="form-control" value="{{ $tag_name }}">
                        </div>
                    </div>
        
                    <div class="text-center">
                        <input type="submit" value="記事を投稿する">
                    </div>
                </form>
            </div>
        </div>

    </div>

    
@endsection