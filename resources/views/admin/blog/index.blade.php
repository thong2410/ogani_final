@extends('layouts.admin')

@section('title', trans('main.dashboard'))

@section('content')
<h3 class="mb-4">@lang('admin.blog.articles')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.blog.index')}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.blog.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['keyword']))<a href="{{route('admin.blog.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('admin.blog.title')</th>
                <th scope="col">@lang('admin.blog.category')</th>
                <th scope="col">@lang('admin.blog.content')</th>
                <th ></th>
            </tr>
        </thead>
        <tbody>
            @if(count($posts) > 0)
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->post_id }}</td>
                <td><a href="{{route('post.detail', $post->post_id) }}"><b>{{ $post->post_title }}</b></a></td>
                <td><a href="{{route('blog', $post->category->cate_id) }}"><b>{{ $post->category->name }}</b></a></td>
                <td>{{ str_limit(strip_tags($post->post_content), 100) }}</td>
                <td>
                    <form action="{{route('admin.blog.destroy', $post->post_id) }}" method="POST"
                        class="form-inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1 mb-1"><i class="fa fa-trash"
                                aria-hidden="true"></i></button>
                                <a href="{{ route('admin.blog.edit', $post->post_id) }}">
                            <button type="button" class="btn btn-sm btn-outline-success mr-1 mb-1"><i class="fa fa-pen"
                                    aria-hidden="true"></i></button>
                        </a>
                        <a href="{{ route('admin.comment.show', $post->post_id) }}">
                            <button type="button" class="btn btn-sm btn-outline-warning mr-1 mb-1"><i class="fa fa-comment"
                                    aria-hidden="true"></i></button>
                        </a>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-center">@lang('admin.blog.not_found')</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $posts->appends($input)->links() }}

@endsection