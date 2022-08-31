@extends('layouts.app')

@section('content')
    <div class="question-show">
        <div class="container mb-5">
            <div class="question-show-outer">
                <div class="question-show-inner">
                    <div class="question-show-question-wrapper">
                        <div class="col-sm-12 question-show-title">
                            <p>{{ $question->title }}</p>
                        </div>

                        <div class="col-sm-12 question-show-body">
                            <p>{!! nl2br(e($question->body)) !!}</p>
                        </div>
                    </div>
                    
                    <div class="question-show-answer-wrapper">
                        <h2>Answer</h2>
                        <form action="{{ route('answer.store', ['id' => $question->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" id="answer" cols="100" rows="15">{{ old('answer') }}</textarea>
                                    @if ($errors->has('answer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <p class="col-sm-2 col-form-label">画像</p>
                                <div class="col-sm-10">
                                    <input type="file" name="sup_image">
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="回答する">
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <div class="question-show-question-outer">
                <div class="question-show-answer-inner">
                    
            </div>
        </div>
    </div>
@endsection