@extends('layouts.app')

@section('content')
    <div class="question-show">
        <div class="container mb-5">
            <div class="question-show-outer">
                <div class="question-show-inner">
                    <div class="container my-5">
                        <h1 class="text-center mb-5">質問投稿</h1>
                        <form action="{{ route('question.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label">タイトル</p>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label">本文</p>
                                <div class="col-sm-10">
                                    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" cols="100" rows="15">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('body') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label">画像</p>
                                <div class="col-sm-10">
                                    <input type="file" name="image">
                                </div>
                            </div>
                
                            <div class="text-center">
                                <button type="submit">記事を投稿する</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection