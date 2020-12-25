@extends('layouts.app')
@section('title', trans('main.profile'))
@section('content')
<div class="ogami-breadcrumb">
        <div class="container">
          <ul>
            <li> <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a></li>
            <li> <a class="breadcrumb-link active" href="#">@lang('main.profile')</a></li>
          </ul>
        </div>
</div>

<div class="account">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-8 mx-auto">
              <h1 class="title">@lang('main.profile')</h1>

                <form class="form-horizontal" method="POST" action="{{route('user.editAccount',Auth::id())}}" id="#form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="idAccount" id="idAccount" value="{{Auth::id()}}">
                    <div class="row grid">
                        <div class="col-sm-12">
                            <div class="input-view-flat input-gray-shadow form-group">
                                <img src="{{asset('public/'.Auth::user()->avatar)}}" alt="" style="max-height: 200px;margin-left: calc(50% - 100px);margin-bottom: 3rem">
                                <div class="input-view-flat input-gray-shadow form-group">
                                <div class="input-group"><input
                                        class="btn" id="avatar"
                                        name="avatar" type="file"
                                        style='margin: auto;margin-bottom: 2rem;'>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.username')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                        name="username" type="text" value="{{Auth::user()->username}}"
                                        readonly >
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
                                    class="required">@lang('main.fullname')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('fullname') ? ' is-invalid' : '' }}"
                                        name="fullname" type="text" id="fullname"
                                        value="{{Auth::user()->fullname}}" required="required">
                                    @if ($errors->has('fullname'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('fullname') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="input-view-flat input-gray-shadow form-group"><label
                                    class="required">@lang('main.email')</label>
                                <div class="input-group"><input
                                        class="no-round-input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                        name="email" type="email" value="{{Auth::user()->email}}"
                                        required="required" id="email">
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
                                    class="required">@lang('main.gender.gender')</label>
                                <div class="input-group">
                                    <select class="no-round-input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="gender" required="required" id="gender">
                                        @if(Auth::user()->gender=='male')
                                        <option value="male" selected="">@lang('main.gender.male')</option>
                                        <option value="female">@lang('main.gender.female')</option>
                                        @elseif(Auth::user()->gender=='female')
                                        <option value="female" selected="">@lang('main.gender.female')</option>
                                        <option value="male">@lang('main.gender.male')</option>
                                        @endif  
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
                                        name="phone" type="tel" id="phone"
                                        value="{{Auth::user()->phone}}" required="required" pattern="0[123][0-9]{8}">
                                    @if ($errors->has('phone'))
                                    <div class="invalid-feedback d-block pb-4">
                                        {{ $errors->first('phone') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center"><button class="pink no-round-btn" type="submit" id="updateAccount">@lang('main.updateAccount')</button></div>
                        <div class="col-12 text-center mt-4 account-function">@lang('main.sign_up_text_2')&nbsp;<a href="{{ route('login') }}" class="create-account">@lang('main.sign_in')</a></div>
                    </div>
                </form>

                </div>
          </div>
        </div>
      </div>
@endsection