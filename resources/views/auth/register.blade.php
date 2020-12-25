@extends('layouts.app')
@section('title', trans('main.sign_up'))
@section('content')
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
            <li> <a class="breadcrumb-link active" href="#">@lang('main.sign_up')</a></li>
          </ul>
        </div>
</div>

<div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-8 mx-auto">
              <h1 class="title">@lang('main.sign_up')</h1>

                <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="#form">
                    {{ csrf_field() }}
                    <div class="row grid">
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.username')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username" type="text" placeholder="@lang('main.username')"
                                        required="required">
                                    @if ($errors->has('username'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('username') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.email')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" type="email" placeholder="@lang('main.email_text')"
                                        required="required">
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.password')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        name="password" type="password" placeholder="@lang('main.password_text')"
                                        required="required">
                                    @if ($errors->has('password'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('password') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.confirm_password')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        name="password_confirmation" type="password"
                                        placeholder="@lang('main.confirm_password_text')" required="required">
                                    @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.fullname')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                        name="fullname" type="text"
                                        placeholder="@lang('main.fullname_text')" required="required">
                                    @if ($errors->has('fullname'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('fullname') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.gender.gender')</label>
                                <div class="input-group">
                                    <select class="no-round-input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="gender" required="required">
                                        <option value="male">@lang('main.gender.male')</option>
                                        <option value="female">@lang('main.gender.female')</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('gender') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.phone_number')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                        name="phone" type="tel"
                                        placeholder="@lang('main.phone_number_text')" required="required">
                                    @if ($errors->has('phone'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('phone') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center"><button class="pink no-round-btn" type="submit">@lang('main.sign_up')</button></div>
                        <div class="col-12 text-center mt-4 account-function">@lang('main.sign_up_text_2')&nbsp;<a href="{{ route('login') }}" class="create-account">@lang('main.sign_in')</a></div>
                    </div>
                </form>

                </div>
          </div>
        </div>
      </div>
@endsection