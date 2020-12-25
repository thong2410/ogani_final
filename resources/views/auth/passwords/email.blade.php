@extends('layouts.app')
@section('title', trans('main.forgot'))
@section('content')
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
            <li> <a class="breadcrumb-link active" href="#">@lang('main.forgot')</a></li>
          </ul>
        </div>
      </div>
      <div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-6 mx-auto">
              <h1 class="title">@lang('main.forgot')</h1>
              @if (session('status'))
                        <div class="alert alert-success mt-2 mb-4">
                            {{ session('status') }}
                        </div>
              @endif
                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="row grid">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required">@lang('main.email')</label>
                                <div class="input-group">
                                    <input class="no-round-input{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" placeholder="@lang('main.email')" required="required"></div>
                            </div>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback d-block pb-4">
                                {{ $errors->first('email') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-12 text-center"><button class="pink no-round-btn" type="submit">@lang('main.forgot_send_link')</button></div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
@endsection
