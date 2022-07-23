@extends('layouts.app')

@section('content')
    <div class="service-index">

        <div class="service-top">
            <img src="/images/beach-g9fd94e74e_1920.jpg" alt="photo-top-image" class="service-top-image">
            <h1>見る <span style="letter-spacing: -0.2em;">—</span> Photo<span style="letter-spacing: -0.2em;">—</span></h1>
    
            <div class="service-search-form">
                <form class="d-flex" action="{{ route('photo.search') }}" method="GET">
                    <input type="text" class="service-input" name="keyword"  placeholder="Search" value="{{ $keyword }}">
                    <button type="submit" class="service-input"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>

        <div class="card-columns" id="photo">
            @foreach ($photos as $photo)
                    <div class="card">
                        <a href="{{ Storage::url($photo->image) }}" rel="lightbox">
                            <img src="{{ Storage::url($photo->image) }}" width="100%">
                        </a>
                    </div>
            @endforeach
        </div>
    </div>

@endsection