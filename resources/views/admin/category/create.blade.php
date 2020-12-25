@extends('layouts.admin')

@section('title', trans('admin.category.create'))

@section('content')
<h3 class="mb-4">@lang('admin.category.create')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.category.store') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="cateName">@lang('admin.category.name')</label>
        <input type="text" class="form-control" id="cateName" name="name">
    </div>
    <div class="form-group">
        <label for="parent">@lang('admin.category.parent')</label>
        <select class="form-control" id="parent" name="parent_id">
            <option value="">---</option>
            @foreach($categories as $category)
            <option value="{{ $category->cate_id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <label for="description">@lang('admin.category.description')</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary" id="save-btn">@lang('admin.category.create')</button>
    </div>
</form>

<div class="media-library-modal modal fade" id="mediaLibrary" data-backdrop="static" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 pb-0">
                <h4 class="modal-title">@lang('admin.media.media_library')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="media-upload-tab" data-toggle="tab" href="#media-upload"
                            role="tab" aria-controls="media-upload" aria-selected="true">@lang('admin.media.upload')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="media-library-tab" data-toggle="tab" href="#media-library" role="tab"
                            aria-controls="media-library" aria-selected="false">@lang('admin.media.library')</a>
                    </li>
                </ul>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="media-upload" role="tabpanel">
                        <form action="/admin/media/upload/product" class="dropzone dropzone-area h-100"
                            id="media-library-dropzone" enctype="multipart/form-data">
                            <div class="fallback">
                                @csrf
                                <input name="file[]" type="file" multiple />
                            </div>
                        </form>
                    </div>
                    <!-- .tab-pane -->
                    <div class="tab-pane fade" id="media-library" role="tabpanel">
                        <form>
                            <div class="row" id="listMedia">
                                <div class="alert alert-warning text-center">@lang('admin.media.not_found')</div>
                            </div>
                        </form>
                        <!-- .row -->
                    </div>
                    <!-- .tab-pane -->
                </div>
                <!-- .tab-content -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">@lang('admin.close')</button>
            </div>
        </div>
    </div>
</div>
@endsection