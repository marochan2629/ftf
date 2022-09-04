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
                        <div class="col-sm-12 question-show-answer">
                            <div>{!! nl2br(e($question->answer)) !!}</div>
                        </div>
               
                       @if($question->sup_image)
                            <div class="col-sm-12 question-show-sup_image">
                                <a href="{{ Storage::url($question->sup_image) }}" rel="lightbox">
                                    <img src="{{ Storage::url($question->sup_image) }}" width="25%">
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