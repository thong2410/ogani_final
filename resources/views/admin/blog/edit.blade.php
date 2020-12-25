@extends('layouts.admin')

@section('title', trans('admin.blog.edit'))

@section('content')
<h3 class="mb-4">@lang('admin.blog.edit')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.blog.update', $post->post_id) }}">
{{ csrf_field() }}
    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="form-group">
        <label for="title">@lang('admin.blog.title')</label>
        <input type="text" class="form-control" id="title" value = "{{$post->post_title}}" name="title">
    </div>

    <div class="form-group">
                <label for="cate_id">@lang('admin.product.category')</label>
                <select class="form-control" id="cate_id" name="cate_id" required>
                    <option value="">---</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->cate_id }}" @if($category->cate_id == $post->cate_id) selected @endif>{{ $category->name }}</option>
                        @foreach($category->children as $category)
                        <option value="{{ $category->cate_id }}" @if($category->cate_id == $post->cate_id) selected @endif>― {{ $category->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
            
    <div class="form-group">
        <label for="parent">@lang('admin.blog.thumb')</label>
        
        <div class="row mb-4">
            <div class="col-lg-12 mt-2 mb-2" id="selectedPic"> 
                    <img src="/{{ $post->thumb->path }}/{{ $post->thumb->name }}" class="img-thumbnail w-25">
                </div>
                <input type="hidden" name="thumb_id" id="mediaId" value="{{ $post->thumb->id }}">
                <div class="col-lg-12">
                    <div class="mt-3">
                        <a href="#" class="btn btn-dark py-5 w-100" data-toggle="modal" data-target="#mediaLibrary" id="openMedia">
                            <i class="fad fa-lg fa-images mr-2"></i>
                            <strong>@lang('admin.media.open_media_library')</strong>
                        </a>
                    </div>
                </div>
<!-- .col -->
            </div>
    </div>
    <div class="form-group">
        <label for="content">@lang('admin.blog.content')</label>
        <textarea class="form-control" id="content" name="content" rows="3">{{ $post->post_content }}</textarea>
    </div>
    <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_title">@lang('admin.product.seo_title')</label>
                        <input class="form-control" id="seo_title" name="seo_title" type="text" value="{{ $post->seo_title }}" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_description">@lang('admin.product.description')</label>
                        <textarea class="form-control" id="seo_description" name="seo_description" rows="3" required>{{ $post->seo_description }}</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_keywords">@lang('admin.product.keywords')</label>
                        <input class="form-control" id="seo_keywords" name="seo_keywords" value="{{ $post->seo_keywords }}" type="text" required>
                    </div>
                </div>               
        </div>    
    <div class="form-group mb-0">
        <button class="btn btn-primary" type="submit">@lang('admin.blog.edit')</button>
    </div>
</form>
@include('subviews.admin.media')
@endsection