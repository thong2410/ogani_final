@extends('layouts.app') 
@section('title', trans('main.user_profile.my_profile')) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link active" href="{{ route('user.index') }}">@lang('main.my_account')</a></li>
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
            <div class="text-center mb-4">
                <img src="/{{ Auth::user()->avatar }}" class="img-thumbnail" width="120px">
            </div>
            <hr/>
            <table class="table table-bordered">
            <tbody>
            <tr>
                <th scope="row">@lang('main.user_profile.username')</th>
                <td>{{ Auth::user()->username }}</td>
                </tr>
                <tr>
                <th scope="row">@lang('main.user_profile.email')</th>
                <td>{{ Auth::user()->email }}</td>
                </tr>
                <tr>
                <th scope="row">@lang('main.user_profile.phone')</th>
                <td>{{ Auth::user()->phone }}</td>
                </tr>
                <tr>
                <th scope="row">@lang('main.user_profile.role.role')</th>
                <td>{!! trans('main.user_profile.role.'.Auth::user()->role) !!}</td>
                </tr>
                <th scope="row">@lang('main.user_profile.gender.gender')</th>
                <td>{{ trans('main.user_profile.gender.'.Auth::user()->gender) }}</td>
                </tr>
                <th scope="row">@lang('main.user_profile.created')</th>
                <td>{{ Auth::user()->created_at }}</td>
                </tr>
            </tbody>
            </table>
            <a href="{{ route('user.edit') }}"><button class="no-round-btn pink">@lang('main.user_profile.edit')</button></a>
        </div>
    </div>
</div>
@endsection
