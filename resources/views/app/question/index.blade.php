@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">質問一覧</h1>
    <div class="container">
    <h1>一覧画面</h1>
        @foreach ($questions as $question)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{ $question->title }}</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <p class="card-text">{{ $question->body }}</p>
                    <!-- <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                </div>
            </div>
        @endforeach
    </div>

@endsection