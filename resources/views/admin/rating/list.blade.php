
@extends('layouts.admin')

@section('title', trans('admin.rating.view_rating'))

@section('content')

<h3 class="mb-4">@lang('admin.rating.view_rating')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.rating.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-4 col-xs-12 mb-2">
        <select class="form-control" name="rating" id="rating">
                    <option value="">---</option>
                    <option value="1" {{ isset($input['rating']) && $input['rating'] == '1' ? 'selected' : '' }}>★</option>
                    <option value="2" {{ isset($input['rating']) && $input['rating'] == '2' ? 'selected' : '' }}>★★</option>
                    <option value="3" {{ isset($input['rating']) && $input['rating'] == '3' ? 'selected' : '' }}>★★★</option>
                    <option value="4" {{ isset($input['rating']) && $input['rating'] == '4' ? 'selected' : '' }}>★★★★</option>
                    <option value="5" {{ isset($input['rating']) && $input['rating'] == '5' ? 'selected' : '' }}>★★★★★</option>
        </select>
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
                <th scope="col">@lang('admin.rating.star')</th>
                <th scope="col">@lang('admin.rating.date')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($ratings) > 0)
                @foreach ($ratings as $rating)
                <tr>
                    <td>{{ $rating->review_id }}</td>
                    <td class="text-center"><img src="{{asset($rating->user->avatar)}}" class="thumbnail" width="70px" height="70px"></td>
                    <td style="white-space: nowrap;">{{ $rating->user->fullname }}</td>
                    <td>{{ $rating->content }}</td>
                    <td>
                        <div class="star-ratings d-inline-block">
                                        <div class="fill-ratings" style="width: {{ $rating->rating * 20 }}%;">
                                            <span>★★★★★</span>
                                        </div>
                                        <div class="empty-ratings">
                                            <span>★★★★★</span>
                                        </div>
                        </div>
                    </td>
                    <td><span class="badge">{{ $rating->created_at }}</span></td>

                    <td>
                        <form action="{{ route('admin.rating.destroy', $rating->review_id) }}" method="POST"
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
                    <td colspan="9" class="text-center">@lang('admin.rating.not_found')</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
{{$ratings->appends($input)->links()}}

@endsection
