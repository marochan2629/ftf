@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if(Auth::check())
                            <p>USER: {{ $user->name }}</p>
                        @else
                            <p>ログインしていません（<a class="nav-link" href="{{ route('user.auth.login') }}">{{ __('Login') }}</a> | <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>）</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection