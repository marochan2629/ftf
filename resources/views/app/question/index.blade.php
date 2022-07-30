@extends('layouts.app')

@section('content')
    <div class="service-index">
        <div class="service-top">
            <img src="/images/buddhism-g799a2cde1_1920.jpg" alt="photo-top-image" class="service-top-image">
            <h1>聞く <span style="letter-spacing: -0.2em;">—</span> Photo<span style="letter-spacing: -0.2em;">—</span></h1>
    
            <div class="service-search-form">
                <form class="d-flex" action="{{ route('question.search') }}" method="GET">
                    <input type="text" class="service-input" name="keyword"  placeholder="Search" value="{{ $keyword }}">
                    <button type="submit" class="service-input"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="questions">
            @foreach ($questions as $question)
                <div class="card question">
                    <div class="card-body question-body">
                        <div class="question-title">
                            <h5 class="card-title">{{ $question->title }}</h5>
                        </div>
                        <!-- <div class="question-body">
                            <p class="card-text question-body">{{ $question->body }}</p>
                        </div> -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection