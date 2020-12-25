@extends('layouts.app')
@section('title', trans('main.rest_password'))
@section('content')
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
            <li> <a class="breadcrumb-link active" href="#">@lang('main.rest_password')</a></li>
          </ul>
        </div>
      </div>
      <div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 mx-auto">
              <h1 class="title">@lang('main.rest_password')</h1>
              @if (session('status'))
                        <div class="alert alert-success mt-2 mb-4">
                            {{ session('status') }}
                        </div>
              @endif
                    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email" class="control-label">@lang('main.email')</label>
                                <input id="email" type="email" class="no-round-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <div class="help-block d-block pb-4 text-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label">@lang('main.password')</label>

                                <input id="password" type="password" class="no-round-input{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="help-block d-block pb-4 text-danger">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label">@lang('main.confirm_password')</label>
                                <input id="password-confirm" type="password" class="no-round-input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <div class="help-block d-block pb-4 text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                        </div>

                        <div class="form-group">
                                <button type="submit" class="pink no-round-btn">
                                    @lang('main.rest_password')
                                </button>
                        </div>
                    </form>

                    </div>
          </div>
        </div>
      </div>
@endsection
