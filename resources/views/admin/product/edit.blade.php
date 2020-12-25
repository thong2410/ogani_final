@extends('layouts.admin')

@section('title', trans('admin.product.edit'))

@section('content')
<h3 class="mb-4">@lang('admin.product.edit')</h3>
@if ($errors->any())
<div class="alert alert-danger mb-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="alert alert-danger mb-4 print-error-msg" style="display:none">
    <ul></ul>
</div>
<form method="POST" action="{{ route('admin.product.update', $product->product_id) }}" id="editProduct">
    {{ csrf_field() }}
    <input type="hidden" name="pid" value="{{ $product->product_id }}">
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="prod_name">@lang('admin.product.name')</label>
                <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $product->prod_name }}" required>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="cate_id">@lang('admin.product.category')</label>
                <select class="form-control" id="cate_id" name="cate_id" required>
                    <option value="">---</option>
                    @foreach($getCategories as $category)
                    <option value="{{ $category->cate_id }}" @if($category->cate_id == $product->cate_id) selected @endif>{{ $category->name }}</option>
                        @foreach($category->children as $category)
                        <option value="{{ $category->cate_id }}" @if($category->cate_id == $product->cate_id) selected @endif>― {{ $category->name }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="unit_price">@lang('admin.product.unit_price')</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">₫</div>
                    </div>
                    <input type="number" class="form-control fix-rounded-right" id="unit_price" name="unit_price" min="0" value="{{ $product->unit_price }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="sale">@lang('admin.product.sale')</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">%</div>
                    </div>
                    <input type="number" class="form-control fix-rounded-right" id="sale" name="sale" min="0" max="100" value="{{ $product->sale }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="quantity">@lang('admin.product.quantity')</label>
                <input type="number" class="form-control fix-rounded-right" id="quantity" name="quantity" value="{{ $product->quantity }}" min="0" required>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="unit">@lang('admin.product.unit')</label>
                <input type="text" class="form-control fix-rounded-right" id="unit" name="unit" placeholder="Kg" value="{{ $product->unit }}" required>
            </div>
        </div>
    </div>
    <hr class="mb-4"/>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="home"
                aria-selected="true">@lang('admin.product.detail')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="profile"
                aria-selected="false">@lang('admin.product.seo')</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#picture" role="tab" aria-controls="contact"
                aria-selected="false">@lang('admin.product.picture')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="content">@lang('admin.product.content')</label>
                        <textarea class="form-control" id="content" name="content" rows="3" required>{{ $product->content }}</textarea>
                    </div>
                </div>  

            <div class="col-md-6 mb-3">
		    	<label for="ma_loai">@lang('admin.product.detail')</label>
			<table class="table table-bordered">
			<tbody id="product">
			<tr>
			<th></th>
			<th>Tên</th>
			<th>Giá trị</th>
            </tr>
            @foreach (json_decode($product->detail) as $detail)
			<tr class="product-item">
			<td valign="top"><input type="checkbox" name="item_index[]" /></td>
			<td valign="top"><input class="form-control" type="text" name="detail_name[]" placeholder="{{ $detail->info }}" value="{{ $detail->info }}" required/></td>
			<td valign="top"><input class="form-control" type="text" name="detail_value[]" placeholder="{{ $detail->value }}" value="{{ $detail->value }}" required/></td>
            </tr>
            @endforeach
            </tbody>
			</table>

			<div><input class="btn btn-outline-secondary btn-sm" type="button" name="add_item" value="@lang('admin.product.add_more_detail_field')" onClick="addMore();" />
			<input class="btn btn-outline-secondary btn-sm" type="button" name="del_item" value="@lang('admin.product.remove_detail_field')" onClick="deleteRow();" /></div>
		    </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="status">@lang('admin.product.status')</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="normal" @if($product->status == 'normal') selected @endif>@lang('admin.product.normal')</option>
                            <option value="feature" @if($product->status == 'feature') selected @endif>@lang('admin.product.feature')</option>
                        </select>
                    </div>
                </div>             
            </div>
        </div>
        <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_title">@lang('admin.product.seo_title')</label>
                        <input class="form-control" id="seo_title" name="seo_title" type="text" value="{{ $product->seo_title }}" required>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_description">@lang('admin.product.description')</label>
                        <textarea class="form-control" id="seo_description" name="seo_description" rows="3" required>{{ $product->seo_description }}</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="seo_keywords">@lang('admin.product.keywords')</label>
                        <input class="form-control" id="seo_keywords" name="seo_keywords" value="{{ $product->seo_keywords }}" type="text" required>
                    </div>
                </div>               
            </div>
        </div>
        <div class="tab-pane fade" id="picture" role="tabpanel" aria-labelledby="picture-tab">

            <div class="row mb-4">
                <div class="col-lg-12 mt-2 mb-2" id="selectedPic"> 
                    <img src="/{{ $product->thumb->path }}/{{ $product->thumb->name }}" class="img-thumbnail w-25">
                </div>
                <input type="hidden" value="{{ $product->thumb->id }}" id="mediaId">
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
<!-- .row -->

        </div>
    </div>
    <div class="form-group mb-0">
        <button class="btn btn-primary editProduct" id="save-btn">@lang('admin.product.edit')</button>
    </div>
</form>
@include('subviews.admin.media')
@endsection