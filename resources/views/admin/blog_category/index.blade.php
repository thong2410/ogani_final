@extends('layouts.admin')

@section('title', trans('admin.blog_category.categories'))

@section('content')
<h3 class="mb-4">@lang('admin.blog_category.categories')</h3>
@if (session('message'))
<div class="alert alert-{{ session('message.status') }} mb-4">
    {{ session('message.msg') }}
</div>
@endif

<form action="{{route('admin.blog_category.index')}}" method="GET">
  <div class="row">
    <div class="col mb-2">
      <input type="text" name="keyword" class="form-control" placeholder="@lang('admin.category.search_placeholder')" value="{{ !empty($input['keyword']) ? $input['keyword'] : '' }}">
    </div>
    <div class="col-2 col-xs-12 mb-2">
        <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
        @if(isset($input['keyword']))<a href="{{route('admin.blog_category.index')}}"><button class="btn btn-info" type="button"><i class="fas fa-reply-all"></i></button></a>@endif
    </div>
  </div>
</form>
<hr/>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th scope="col">@lang('admin.category.name')</th>
                <th scope="col">@lang('admin.category.description')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($categories) > 0)
            @foreach ($categories as $category)
            <tr>
                <td><a href="#"><b>{{ $category->name }}</b></a></td>
                <td>{{ str_limit($category->description, 40) }}</td>
                <td>
                    <form action="{{ route('admin.blog_category.destroy', $category->cate_id) }}" method="POST"
                        class="form-inline">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1"><i class="fa fa-trash"
                                aria-hidden="true"></i></button>
                        <a href="{{ route('admin.blog_category.edit', $category->cate_id) }}">
                            <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-pen"
                                    aria-hidden="true"></i></button>
                        </a>
                    </form>
                </td>
            </tr>
                @foreach ($category->children as $subCategory)
                <tr>
                    <td><a href="#"><b>― {{ $subCategory->name }}</b></a></td>
                    <td>{{ str_limit($subCategory->description, 40) }}</td>
                    <td>
                        <form action="{{ route('admin.blog_category.destroy', $subCategory->cate_id) }}" method="POST"
                            class="form-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-outline-danger mr-1"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                            <a href="{{ route('admin.blog_category.edit', $subCategory->cate_id) }}">
                                <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-pen"
                                        aria-hidden="true"></i></button>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            @endforeach
            @else
            <tr>
                <td colspan="3" class="text-center">@lang('admin.category.not_found')</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
{{ $categories->appends($input)->links() }}

@endsection