@extends('layouts.app')
@section('title', trans('main.sign_in'))
@section('content')
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
            <li> <a class="breadcrumb-link active" href="#">@lang('main.sign_in')</a></li>
          </ul>
        </div>
      </div>
      <div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 mx-auto">
              <h1 class="title">@lang('main.sign_in')</h1>
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label class="required">@lang('main.username')</label>
                        <div class="input-group">
                            <input class="no-round-input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" placeholder="@lang('main.username_text')" required="required">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback d-block pb-4">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                </div>
                <div class="form-group">
                    <label class="required">@lang('main.password')</label>
                        <div class="input-group">
                            <input class="no-round-input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" placeholder="@lang('main.password')" required="required">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback d-block pb-4">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                </div>
                <div class="account-method">
                  <div class="account-save">
                    <input type="checkbox" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">@lang('main.keep_login')</label>
                  </div>
                  <div class="account-forgot"><a href="{{ route('password.request') }}">@lang('main.forgot')?</a></div>
                </div>
                <div class="account-function">
                  <button class="pink no-round-btn" type="submit">@lang('main.sign_in')</button>
                  @lang('main.sign_up_text')<a class="create-account" href="{{ route('register') }}">@lang('main.sign_up')</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
