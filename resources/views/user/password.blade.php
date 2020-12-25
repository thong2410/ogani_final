@extends('layouts.app') 
@section('title', trans('main.user_profile.change_password')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('user.index') }}">@lang('main.my_account')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.index') }}">@lang('main.user_profile.change_password')</a></li>
        </ul>
    </div>
</div>
<div class="container user-profile" style="margin-bottom: 60px;">
    <div class="row mb-4">
        <div class="col-4">
        <div class="card border-0">

        <ul class="list-group list-group-flush">
        <li class="list-group-item"><a href="{{ route('user.index') }}">@lang('main.user_profile.my_profile')</a></li>
        <li class="list-group-item"><a href="{{ route('user.orders') }}">@lang('main.user_profile.my_orders')</a></li>
        <li class="list-group-item"><a href="{{ route('user.wishlist') }}">@lang('main.user_profile.my_wishlist')</a></li>
        <li class="list-group-item"><a href="{{ route('user.password') }}">@lang('main.user_profile.change_password')</a></li>
        </ul>
        </div>

        </div>
        <div class="col-8">
        @if (session('message'))
        <div class="alert alert-{{ session('message.status') }} mb-4">
            {{ session('message.msg') }}
        </div>
        @endif  

        @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif        

            <form method="POST"> 
            {{ csrf_field() }}
            {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-6 col-sm-12">
                        <div class="form-group">
                        <label for="password">@lang('main.user_profile.old_password')</label>
                        <input type="password" id="password" name="old_password" class="form-control">
                    </div>
                    </div>
                    <div class="col-6 col-sm-12">
                        <div class="form-group">
                        <label for="password">@lang('main.user_profile.new_password')</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    </div>
                    <div class="col-6 col-sm-12">
                        <div class="form-group">
                            <label for="re_password">@lang('main.user_profile.re_password')</label>
                            <input type="password" id="re_password" name="password_confirmation" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group"><button class="no-round-btn pink">@lang('main.user_profile.change_password')</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
