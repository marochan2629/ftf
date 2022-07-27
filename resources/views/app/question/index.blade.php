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

        <div class="questions-and-sidebarP">
            <div class="article-sidebar">
                @foreach ($questions as $question)
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $question->title }}</h5>
                            <p class="card-text">{{ $question->body }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection