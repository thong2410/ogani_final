@extends('layouts.admin')

@section('title', trans('main.dashboard'))

@section('content')
<h3 class="mb-4">@lang('admin.category.edit')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.blog_category.update', $category->cate_id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="cateName">@lang('admin.category.name')</label>
        <input type="text" class="form-control" id="cateName" name="name" value="{{ $category->name }}">
    </div>
    <div class="form-group">
        <label for="parent">@lang('admin.category.parent')</label>
        <select class="form-control" id="parent" name="parent_id">
            <option value="">---</option>
            @foreach ($categories as $cat)
                @if($cat->cate_id != $category->cate_id) 
                    <option value="{{ $cat->cate_id }}" {{ $cat->cate_id == $category->parent_id ? "selected" : "" }}>{{ $cat->name }}</option> 
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="description">@lang('admin.category.description')</label>
        <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary" id="save-btn" type="submit">@lang('admin.category.edit')</button>
    </div>
</form>

@endsection