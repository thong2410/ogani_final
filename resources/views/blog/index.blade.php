@extends('layouts.app') 
@section('title', $title) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            @if(isset($cid))
            <li> <a class="breadcrumb-link" href="{{ route('blog') }}">@lang('main.post.blogs')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('blog', $cid) }}">{{ $title }}</a></li>
            @elseif(isset($input['keyword']))
            <li> <a class="breadcrumb-link active" href="{{ route('blog') }}">{{ $title }}</a></li>
            @else
            <li> <a class="breadcrumb-link active" href="{{ route('blog') }}">@lang('main.post.blogs')</a></li>
            @endif
        </ul>
    </div>
</div>

<div class="blog-layout">
        <div class="container">
          <div class="row">
            <div class="col-xl-3">
              <div class="blog-sidebar">
                <button class="no-round-btn pink" id="filter-sidebar--closebtn" style="display: none;">@lang('main.post.close_sidebar')</button>
                <div class="blog-sidebar_search">
                  <div class="search_block">
                    <form action="" method="get">
                      <input class="no-round-input" name="keyword" type="text" placeholder="@lang('main.post.search_keywords')">
                    </form>
                  </div>
                </div>
                <div class="blog-sidebar_categories">
                  <div class="categories_top mini-tab-title underline pink">
                    <h2 class="title">@lang('main.post.categories')</h2>
                  </div>
                  <div class="categories_bottom">
                    <ul>
                        @foreach($categories as $cate)
                                <li> <a class="category-link @if(isset($cid) && $cate->cate_id == $cid) active @endif" href="{{ route('blog', $cate->cate_id) }}"><strong>{{ $cate->name }}</strong></a></li>
                            @foreach($cate->children as $child)
                                <li class="ml-4"> <a class="category-link @if(isset($cid) && $child->cate_id == $cid) active @endif" href="{{ route('blog', $child->cate_id) }}">{{ $child->name }}</a></li>
                            @endforeach 
                        @endforeach
                    </ul>
                  </div>
                </div>
                <div class="blog-sidebar_recent-post">
                  <div class="recent-post_top mini-tab-title underline pink">
                    <h2 class="title">@lang('main.post.suggest')</h2>
                  </div>
                  <div class="recent-post_bottom">
                      @foreach($suggest as $spost)
                    <div class="mini-post_block">
                      <div class="mini-post_img"><a href="{{ route('post.detail', $spost->post_id) }}"><img src="/{{ $spost->thumb->path }}/{{ $spost->thumb->name }}" alt="blog image"></a></div>
                      <div class="mini-post_text"><a href="{{ route('post.detail', $spost->post_id) }}">{{ $spost->post_title }}</a>
                        <h5>{{ $spost->created_at }}</h5>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-12 col-xl-9">
              <div class="blog-list">
                <div id="show-filter-sidebar" style="display: none;">
                  <h5> <i class="fas fa-bars"></i>@lang('main.post.show_sidebar')</h5>
                </div>
                @if(count($posts) > 0)
                @foreach($posts as $post)
                <div class="blog-block">
                  <div class="row">
                    <div class="col-5">
                      <div class="blog-img"><a href="{{ route('post.detail', $post->post_id) }}">
                          <img src="/{{ $post->thumb->path }}/{{ $post->thumb->name }}" alt="blog image"></a></div>
                    </div>
                    <div class="col-7">
                      <div class="blog-text">
                        <h5 class="blog-tag">{{ $post->category->name }}</h5>
                        <a class="blog-title" href="{{ route('post.detail', $post->post_id) }}">{{ $post->post_title }}</a>
                        <div class="blog-credit">
                          <p class="credit date">{{ $post->created_at }}</p>
                          <p class="credit comment">{{ count($post->comments) }} @lang('main.post.comment')</p>
                        </div>
                        <p class="blog-describe">{{ str_limit(strip_tags($post->post_content), 120) }}</p>
                        <a class="blog-readmore" href="{{ route('post.detail', $post->post_id) }}">@lang('main.post.read_more')<span> <i class="arrow_carrot-2right"></i></span></a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                <div class="alert alert-info">@lang('main.post.not_found')</div>
                @endif
              </div>
              {{ $posts->appends($input)->links('vendor.pagination.blog') }}
            </div>
          </div>
        </div>
      </div>

@endsection
