@extends('layouts.admin')

@section('title', trans('admin.blog.create'))

@section('content')
<h3 class="mb-4">@lang('admin.blog.create')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.blog.store') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">@lang('admin.blog.title')</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="form-group">
                <label for="cate_id">@lang('admin.product.category')</label>
                <select class="form-control" id="cate_id" name="cate_id" required>
                    <option value="">---</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->cate_id }}">{{ $category->name }}</option>
                    @foreach($category->children as $category)
                    <option value="{{ $category->cate_id }}">― {{ $category->name }}</option>
                    @endforeach
                    @endforeach
                </select>
            </div>
    <div class="form-group">
        <label for="parent">@lang('admin.blog.thumb')</label>
        <div class="row mb-4">
                <div class="col-lg-12 mt-2 mb-2" id="selectedPic"> </div>
                <input type="hidden" name="thumb_id" id="mediaId">
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
        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
    </div>
    <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_title">@lang('admin.product.seo_title')</label>
                        <input class="form-control" id="seo_title" name="seo_title" type="text" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_description">@lang('admin.product.description')</label>
                        <textarea class="form-control" id="seo_description" name="seo_description" rows="3" required></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_keywords">@lang('admin.product.keywords')</label>
                        <input class="form-control" id="seo_keywords" name="seo_keywords" type="text" required>
                    </div>
                </div>               
            </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary" id="save-btn">@lang('admin.blog.create')</button>
    </div>
</form>
@include('subviews.admin.media')
@endsection