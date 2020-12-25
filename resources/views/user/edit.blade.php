@extends('layouts.app') 
@section('title', trans('main.user_profile.edit')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('user.index') }}">@lang('main.my_account')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.edit') }}">@lang('main.user_profile.edit')</a></li>
        </ul>
    </div>
</div>

<div class="container user-profile mt-5" style="margin-bottom: 180px;">
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
        <form method="POST" action="{{ route('user.update') }}" id="edituser" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">@lang('admin.user.email')</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="fullname">@lang('admin.user.fullname')</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}" required="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">@lang('admin.user.phone')</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" required="" pattern="0[123][0-9]{8}">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="gender">@lang('admin.user.gender.gender')</label>
                <select class="form-control" name="gender" required="">
                  <option value="male" @if(Auth::user()->gender == 'male') selected @endif>@lang('main.gender.male')</option>
                  <option value="female" @if(Auth::user()->gender == 'female') selected @endif>@lang('main.gender.female')</option>
                </select>
            </div>
        </div>
    </div>
      
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><img src="/{{ Auth::user()->avatar }}" alt="" width="80px" height="80px"></span>
            </div>
            <input name="avatar" type="file" id="avatar" class="form-control" style="height: 100px;">
            </div>
          </div>
    </div>
    
    <div class="form-group mb-0">
        <button class="no-round-btn pink" id="save-btn">@lang('main.user_profile.edit')</button>
    </div>
</form>

        </div>
    </div>
</div>
@endsection
