@extends('layouts.app')

@section('content')
    <h1 class="text-center mt-2 mb-5">画像アップロード - 投稿画面</h1>
    <div class="container mb-5">
        <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">タイトル</p>
                <div class="col-m-8">
                    <input type="text" name="name">
                </div>
            </div>
            
            <div class="form-group row">
                <p class="col-sm-4 col-form-label">画像</p>
                <input type="file" name="image">
            </div>

            <div class="text-center">
                <input type="submit" value="アップロード">
            </div>
        </form>
    </div>
@endsection