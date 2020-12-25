@extends('layouts.app', [
        'seo' => true,
        'keywords' => $post->seo_keywords,
        'description' => $post->seo_description,
        'title' => $post->seo_title,
        'image' => $post->thumb->path .'/'. $post->thumb->name
]) 
@section('title', $post->post_title) 
@section('content') 
<div class="ogami-breadcrumb">
    <div class="container">
        <ul>
            <li>
                <a class="breadcrumb-link" href="{{ route('home') }}"> <i class="fas fa-home"></i>@lang('main.home')</a>
            </li>
            <li> <a class="breadcrumb-link" href="{{ route('blog') }}">@lang('main.post.blogs')</a></li>
            <li> <a class="breadcrumb-link active" href="{{ route('post.detail', $post->post_id) }}">{{ $post->post_title }}</a></li>
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
                    <form action="{{ route('blog') }}" method="get">
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
                        <h5>{{ $post->created_at }}</h5>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
              <div class="filter-sidebar--background" style="display: none"></div>
            </div>
            <div class="col-12 col-xl-9">
              <div class="blog-detail">
                <div id="show-filter-sidebar" style="display: none;">
                  <h5> <i class="fas fa-bars"></i>@lang('main.post.show_sidebar')</h5>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="blog-detail_block">
                      <h1 class="blog-title" href="{{ route('post.detail', $post->post_id) }}">{{ $post->post_title }}</h1>
                        <div class="blog-content">{!! $post->post_content !!}</div>
                    </div>
                    <div class="blog-detail_comment">
                    
                      <div class="customer-reviews_block">
                        <h2 class="comment-title">{{ count($comments) }} @lang('main.post.comment')</h2>
                        <div class="list_comments">
                        @foreach($comments as $comment)
                        <div class="customer-review">
                          <div class="row">
                            <div class="col-12 col-sm-3 col-lg-2">
                              <div class="customer-review_left">
                                <div class="customer-review_img text-center"><img class="img-fluid" src="/{{ $comment->user->avatar }}" alt="customer image"></div>
                              </div>
                            </div>
                            <div class="col-12 col-sm-9 col-lg-10">
                              <div class="customer-comment"> 
                                <h5 class="comment-date">{{ $comment->created_at }}</h5>
                                <h3 class="customer-name">{{ $comment->user->fullname }}</h3>
                                <p class="customer-commented">{{ $comment->message }}</p>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                        </div>

                      </div>
                    
                      @if(Auth::check())
                      <div class="leave-reviews_block">
                        <h2 class="comment-title">@lang('main.post.leave_a_comment')</h2>
                        <form action="" method="post" class="submitComment">
                          <textarea class="textarea-form" name="messages" id="messages" cols="30" rows="8" placeholder="@lang('main.post.messages')"></textarea>
                          <input type="hidden" name="postId" value="{{ $post->post_id }}">
                          <button class="normal-btn pink">@lang('main.post.send_messages')</button>
                          <div class="alert alert-danger mb-4 print-error-msg mt-4" style="display:none">
                            <ul></ul>
                          </div>
                        </form>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection
