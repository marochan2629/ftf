@extends('layouts.app')

@section('content')
    <div class="question-show">
        <div class="container mb-5">
            <div class="question-show-outer">
                <div class="question-show-inner">
                    <!-- <div class="form-group row"> -->
                        <div class="col-sm-12 question-show-title">
                            <p>{{ $question->title }}</p>
                        </div>
                    <!-- </div> -->
                        
                    <!-- <div class="form-group row">
                        <p class="col-sm-2 col-form-label">質問 ー 本文</p> -->
                        <div class="col-sm-12 question-show-body">
                            <p>{!! nl2br(e($question->body)) !!}</p>
                        </div>
                    <!-- </div> -->
                </div>
            </div>

            <div class="question-show-question-outer">
                <div class="question-show-answer-inner">
                    <div class="form-group row">
                       <p class="col-sm-2 col-form-label">回答</p>
                       <div class="col-sm-10">
                           <div>{!! nl2br(e($question->answer)) !!}</div>
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
            </div>
        </div>
    </div>
@endsection