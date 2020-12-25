
@extends('layouts.admin')

@section('title', trans('admin.user.users'))

@section('content')
<h3 class="mb-4">@lang('admin.user.users')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.user.index')}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.user.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-4 col-xs-12 mb-2">
        <select class="form-control" name="role" id="role">
                    <option value="">---</option>
                    <option value="superadmin" {{ isset($input['role']) && $input['role'] == 'superadmin' ? 'selected' : '' }}>@lang('admin.user.role.superadmin')</option>
                    <option value="admin" {{ isset($input['role']) && $input['role'] == 'admin' ? 'selected' : '' }}>@lang('admin.user.role.admin')</option>
                    <option value="editor" {{ isset($input['role']) && $input['role'] == 'editor' ? 'selected' : '' }}>@lang('admin.user.role.editor')</option>
                    <option value="member" {{ isset($input['role']) && $input['role'] == 'member' ? 'selected' : '' }}>@lang('admin.user.role.member')</option>
        </select>
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['role']) || isset($input['keyword']))<a href="{{route('admin.user.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>
<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('admin.user.avatar')</th>
                <th scope="col">@lang('admin.user.username')</th>
                <th scope="col">@lang('admin.user.fullname')</th>
                <th scope="col">@lang('admin.user.phone')</th>
                <th scope="col">@lang('admin.user.email')</th>
                <th scope="col">@lang('admin.user.gender.gender')</th>
                <th scope="col">@lang('admin.user.role.role')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($users) > 0)
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td class="text-center"><img src="{{asset($user->avatar)}}" class="thumbnail" width="70px" height="70px"></td>
                    <td><a href="{{ route('admin.order.user-order', $user->user_id) }}"><b>{{ $user->username }}</b></a></td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="">{{ trans('admin.user.gender.'.$user->gender) }}</span></td>
                    <td><span class="badge badge-danger">{{ trans('admin.user.role.'.$user->role) }}</span></td>
                    <td>
                        <form action="{{ route('admin.user.destroy', $user->user_id) }}" method="POST"
                            class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            <a href="{{ route('admin.user.edit', $user->user_id) }}">
                                <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-pen" aria-hidden="true"></i></button>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">@lang('admin.user.not_found')</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{{$users->appends($input)->links()}}


@endsection