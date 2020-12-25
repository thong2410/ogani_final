
@extends('layouts.admin')

@section('title', trans('admin.comment.view_comment'))

@section('content')
<h3 class="mb-4">@lang('admin.comment.view_comment')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.comment.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
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
                <th scope="col">@lang('admin.user.fullname')</th>
                <th scope="col">@lang('admin.rating.content')</th>
                <th scope="col">@lang('admin.rating.date')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($comments) > 0)
                @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->comment_id }}</td>
                    <td class="text-center"><img src="{{asset($comment->user->avatar)}}" class="thumbnail" width="70px" height="70px"></td>
                    <td style="white-space: nowrap;">{{ $comment->user->fullname }}</td>
                    <td>{{ $comment->message }}</td>
                    <td><span class="badge">{{ $comment->created_at }}</span></td>

                    <td>
                        <form action="{{ route('admin.comment.destroy', $comment->comment_id) }}" method="POST"
                            class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9" class="text-center">@lang('admin.comment.not_found')</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $comments->appends($input)->links() }}

@endsection
