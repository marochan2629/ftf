@extends('layouts.app')

@section('content')
    <div class="service-index">
        <div class="service-top">
            <img src="/images/beach-g9fd94e74e_1920.jpg" alt="photo-top-image" class="service-top-image">
            <h1>写真投稿 <span style="letter-spacing: -0.2em;">—</span> Post Photos<span style="letter-spacing: -0.2em;">—</span></h1>
        </div>

        <div class="photo-create">
            <div class="photo-create-form">
                <div class="photo-create-form-title">
                    <h3>写真投稿</h3>
                </div>
                <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <p class="col-sm-2 col-form-label photo-create-form-item">タイトル</p>
                        <div class="photo-create-form-input">
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" size=61>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <p class="col-sm-2 col-form-label photo-create-form-item">画像</p>
                        <div class="photo-create-form-input">
                            <input type="file" name="image" class="{{ $errors->has('image') ? 'is-invalid' : '' }}" value="{{ old('image') }}">
                            @if ($errors->has('image'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group row">
                        <p class="col-sm-2 col-form-label photo-create-form-item">詳細</p>
                        <div class="photo-create-form-input">
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" value="{{ old('description') }}" cols="60" rows="10"></textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>
                    </div>
        
                    <div class="text-center photo-create-button">
                        <button type="submit">アップロード</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection