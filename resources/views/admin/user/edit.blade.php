@extends('layouts.admin')

@section('title', trans('main.dashboard'))

@section('content')
<h3 class="mb-4">@lang('admin.user.edit')</h3>
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

<form method="POST" action="{{ route('admin.user.update', $user->user_id) }}" id="edituser" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $user->user_id }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="user_name">@lang('admin.user.username')</label>
                <input type="text" class="form-control" id="user_name" name="user_name" value="{{ $user->username }}" readonly="">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">@lang('admin.user.email')</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="fullname">@lang('admin.user.fullname')</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $user->fullname }}" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="phone">@lang('admin.user.phone')</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required pattern="0[123][0-9]{8}" >
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="gender">@lang('admin.user.gender.gender')</label>
                <select class="form-control" name="gender" required>
                  <option value="male" @if($user->gender == 'male') selected @endif>@lang('main.gender.male')</option>
                  <option value="female" @if($user->gender == 'female') selected @endif>@lang('main.gender.female')</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="role">@lang('admin.user.role.role')</label>
                <select class="form-control" name="role" id="role" required>
                    @if(Auth::user()->role=='superadmin')
                    <option value="superadmin"  @if($user->role == 'superadmin') selected @endif>@lang('admin.user.role.superadmin')</option>
                    <option value="admin" @if($user->role == 'admin') selected @endif>@lang('admin.user.role.admin')</option>
                    @endif
                    <option value="editor" @if($user->role == 'editor') selected @endif>@lang('admin.user.role.editor')</option>
                    <option value="member" @if($user->role == 'member') selected @endif>@lang('admin.user.role.member')</option>
                </select>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password">@lang('admin.user.password')</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="@lang('admin.user.password_placehoder')">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="password_confirmation">@lang('admin.user.comfirm_password')</label>
                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="@lang('admin.user.password_placehoder')" >
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><img src="{{asset($user->avatar)}}" alt="" width="80px" height="80px"></span>
            </div>
            <input name="avatar" type="file" id="avatar" class="form-control" style="height: 100px;">
            </div>
          </div>
    </div>
    
    <div class="form-group mb-0">
        <button class="btn btn-primary edituser" id="save-btn">@lang('admin.user.edit')</button>
    </div>
</form>


@endsection