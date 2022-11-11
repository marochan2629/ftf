@extends('layouts.app')

@section('content')
    <div class="question-show">
        <div class="container mb-5">
            <div class="question-show-outer">
                <div class="question-show-inner">
                    <div class="question-show-question-wrapper question-create-question-wrapper py-4">
                        <h1 class="text-center">質問投稿</h1>
                        <form action="{{ route('question.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <p class="col-lg-2">タイトル</p>
                                <div class="col-lg-10">
                                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}">
                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <p class="col-lg-2">本文</p>
                                <div class="col-lg-10">
                                    <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" cols="100" rows="15">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('body') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                
                            <div class="form-group row question-create-image">
                                <p1 class="col-lg-2">画像</p1>
                                <label>
                                    <input type="file" name="image" class="col-lg-10">ファイルを選択
                                </label>
                                <p2>選択されていません</p2>
                            </div>
                
                            <div class="text-center">
                                <input type="submit" value="投稿する" class="question-create-submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.addEventListener('DOMContentLoaded', function(){
        $('input').on('change', function () {
            var file = $(this).prop('files')[0];
            $('p2').text(file.name);
        });
    });
</script>