@extends('layouts.app')

@section('content')
    <div class="question-show">
        <div class="container mb-5">
            <div class="question-show-outer">
                <div class="question-show-inner">
                    <div class="question-show-question-wrapper">
                        <div class="question-show-title">
                            <p>{{ $question->title }}</p>
                        </div>

                        <div class="question-show-body">
                            <p>{!! nl2br(e($question->body)) !!}</p>
                        </div>

                        <div class="question-show-images">
                            <a href="{{ $question['image'] }}" rel="lightbox">
                                <img src="{{ $question['image'] }}" width="100%">
                            </a>
                        </div>
                    </div>
                    
                    <div class="question-show-answer-wrapper">
                        <h2>Answer</h2>
                        <div class="question-show-answer">
                            <div>{!! nl2br(e($question->answer)) !!}</div>
                        </div>
               
                       @if($question->sup_image)
                            <div class="question-show-images">
                                <a href="{{ $question['sup_image'] }}" rel="lightbox">
                                    <img src="{{ $question['sup_image'] }}" width="100%">
                                </a>
                            </div>
                       @endif
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection