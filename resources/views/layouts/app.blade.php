<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title') - {{ config('app.app_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($seo))
    <meta name="keywords" content="{{ $keywords }}">
    <meta name="description" content="{{ $description }}">
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:image" content="{{ asset($image) }}" />
    <meta property="og:description" content="{{ $description }}" />
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom_bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/elegant.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/scroll.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/shortcut_logo.png') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body id="main">
    <div id="quickview" style="display:none"></div>
    <header class="pink">
        <div class="header-block d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="header-left d-flex flex-column flex-md-row align-items-center">
                            <p class="d-flex align-items-center"><i class="fas fa-envelope"></i>{{ config('app.infomation.email') }}</p>
                            <p class="d-flex align-items-center"><i class="fas fa-phone"></i>{{ config('app.infomation.hotline') }}</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="header-right d-flex flex-column flex-md-row justify-content-md-end justify-content-center align-items-center">
                            <div class="social-link d-none"><a href="#"><i class="fab fa-facebook-f"> </i></a><a href="#"><i class="fab fa-twitter"></i></a><a href="#"><i class="fab fa-invision"> </i></a><a href="#"><i class="fab fa-pinterest-p"> </i></a></div>
                            <div class="language">
                                <div class="selected-language">
                                    <img src="{{ asset('assets/images/homepage01/'.app()->getLocale().'.jpg') }}" alt=""> @if(app()->getLocale() == 'vi') @lang('main.lang.vietnamese') @else @lang('main.lang.english') @endif
                                    <i class="arrow_carrot-down"></i>
                                    <ul class="list-language">
                                        <li>
                                            <a href="{{ route('locale', 'vi') }}"><img src="{{ asset('assets/images/homepage01/vi.jpg') }}" alt="">@lang('main.lang.vietnamese')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('locale', 'en') }}"><img src="{{ asset('assets/images/homepage01/usa.jpg') }}" alt="">@lang('main.lang.english')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @if(!Auth::check())
                            <div class="login d-flex"><a href="{{ route('login') }}"><i class="fas fa-user"></i>@lang('main.sign_in')</a></div>
                            @else
                            <div class="user">
                                <div class="d-flex">
                                    <i class="fas fa-user"></i>&nbsp;&nbsp;@lang('main.hello')&nbsp;<b>{{ Auth::user()->fullname }}</b><i class="arrow_carrot-down"></i>
                                    <ul class="list-menu">
                                        @if(Auth::user()->role != config('app.member_role'))
                                        <li>
                                            <a href="{{ route('admin.index') }}" class="text-danger">@lang('main.dashboard')</a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('user.index') }}">@lang('main.my_account')</a>
                                        </li>
                                        <li>
                                            <a href="#" id="logout">@lang('main.logout')</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="fixed-nav">
        <nav class="navigation d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <a class="logo" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
                    </div>
                    <div class="col-8">
                        <div class="navgition-menu d-flex align-items-center justify-content-center">
                            <ul class="mb-0">
                                <li class="item"><a class="menu-item @if(Route::currentRouteName() == 'home') active @endif" href="{{ route('home') }}">@lang('main.home')</a></li>
                                <li class="toggleable"><a class="menu-item @if(Route::currentRouteName() == 'shop') active @endif" href="{{ route('shop') }}">@lang('main.shop')</a>
                                    <ul class="sub-menu shop d-flex">
                                        <div class="row">
                                            @foreach($getCategories as $cate)
                                            <div class="nav-column col-md-3 mb-4">
                                            <h2><a href="{{ route('shop', $cate->cate_id) }}">{{ $cate->name }}</a></h2>
                                                @foreach($cate->children as $child)
                                                <li><a href="{{ route('shop', $child->cate_id) }}">{{ $child->name }}</a></li>
                                                @endforeach
                                            </div>
                                            @endforeach
                                        </div>
                                    </ul>
                                </li>
                                <li class="item"><a class="menu-item @if(Route::currentRouteName() == 'blog') active @endif" href="{{ route('blog') }}">@lang('main.blog')</a></li>
                                <li class="item"><a class="menu-item @if(Route::currentRouteName() == 'contact') active @endif" href="{{ route('contact') }}">@lang('main.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="product-function d-flex align-items-center justify-content-end">
                            <div id="wishlist">
                                <a class="function-icon icon_heart_alt" href="{{ route('user.wishlist') }}"></a>
                                @if(Auth::check())
                                <span class="count @if(count(Auth::user()->wished) < 1) d-none @endif ">{{ count(Auth::user()->wished) }}</span>
                                @endif
                            </div>
                            <div id="cart">
                                <a class="function-icon icon_bag_alt" href="{{ route('cart') }}"></a>
                                <span class="count @if(count((array)session()->get('cart')) < 1) d-none @endif ">{{ count((array)session()->get('cart')) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div id="mobile-menu">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="mobile-menu_block d-flex align-items-center"><a class="mobile-menu--control" href="#"><i class="fas fa-bars"></i></a>
                            <div id="ogami-mobile-menu">
                                <button class="pink no-round-btn" id="mobile-menu--closebtn">@lang('main.close_menu')</button>
                                <div class="mobile-menu_items">
                                    <ul class="mb-0 d-flex flex-column">
                                        <li class="item"><a class="menu-item" href="{{ route('home') }}">@lang('main.home')</a></li>
                                        <li class="toggleable"><a class="menu-item" href="{{ route('shop') }}">@lang('main.shop')</a> <span class="sub-menu--expander"><i class="icon_plus"></i></span>
                                            <ul class="sub-menu">
                                                @foreach($getCategories as $cate)
                                                <div class="nav-column pb-2">
                                                    <li><a href="{{ route('shop', $cate->cate_id) }}">{{ $cate->name }}</a></li>
                                                </div>
                                                    @foreach($cate->children as $child)
                                                    <div class="nav-column pb-2 ml-4">
                                                        <li><a href="{{ route('shop', $child->cate_id) }}">{{ $child->name }}</a></li>
                                                    </div>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="item"><a class="menu-item" href="{{ route('blog') }}">@lang('main.blog')</a></li>
                                        <li class="item"><a class="menu-item" href="{{ route('contact') }}">@lang('main.contact')</a></li>
                                    </ul>
                                </div>
                                <div class="mobile-login">
                                    <h2>@lang('main.my_account')</h2>
                                    @if(!Auth::check())
                                    <a href="{{ route('login') }}">@lang('main.sign_in')</a>
                                    <a href="{{ route('register') }}">@lang('main.sign_up')</a>
                                    @else
                                        @if(Auth::user()->role != config('app.member_role'))
                                            <a href="{{ route('admin.index') }}" class="text-danger">@lang('main.dashboard')</a>
                                        @endif
                                            <a href="{{ route('user.index') }}">@lang('main.my_account')</a>
                                            <a href="#" id="logout">@lang('main.logout')</a>
                                    @endif
                                </div>
                            </div>
                            <div class="ogamin-mobile-menu_bg"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mobile-menu_logo text-center d-flex justify-content-center align-items-center">
                            <a href="#"><img src="{{ asset('assets/images/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="mobile-product_function d-flex align-items-center justify-content-end">
                            <div id="wishlist">
                                <a class="function-icon icon_heart_alt" href="{{ route('user.wishlist') }}">
                                    @if(Auth::check())
                                        <span class="count @if(count(Auth::user()->wished) < 1) d-none @endif ">{{ count(Auth::user()->wished) }}</span>
                                    @endif                               
                                </a>
                            </div>
                            <div id="cart">
                                <a class="function-icon icon_bag_alt" href="{{ route('cart') }}">
                                <span class="count @if(count((array)session()->get('cart')) < 1) d-none @endif ">{{ count((array)session()->get('cart')) }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navigation-filter">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 order-2 order-md-1">
                        <div class="department-menu_block down">
                            <div class="department-menu d-flex justify-content-between align-items-center"><i class="fas fa-bars"></i>@lang('main.all_departments')<span><i class="arrow_carrot-up"></i></span></div>
                            <div class="department-dropdown-menu @if(isset($show_department) && $show_department == true) down @endif" @if(isset($show_department) && $show_department !=true) style="display: none;" @endif>
                                <ul>
                                    @foreach($getCategories as $cate)
                                    <li>
                                        <a href="{{ route('shop', $cate->cate_id) }}"> {{ $cate->name }}</a>
                                        @if(count($cate->children) > 0)
                                        <!--<div class="department-submenu">
                                            @foreach($cate->children as $child)
                                                <a href="{{ route('shop', $child->cate_id) }}"> {{ $child->name }}</a>
                                            @endforeach
                                        </div>--->
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 col-lg-8 col-xl-9 order-1 order-md-2">
                        <div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="website-search">
                                   <!--  <div class="row no-gutters"> -->
                                        <form action="{{ route('product.search') }}" class="row no-gutters" method="GET">
                                        <div class="col-10 col-md-10 col-lg-10 col-xl-11">
                                            <div class="search-input">
                                                <input class="no-round-input no-border" type="text" placeholder="@lang('main.search_txt')" id="search-prod" name="keyword">
                                                
                                            </div>
                                        </div>
                                        <div class="col-2 col-md-2 col-lg-2 col-xl-1">
                                            <button class="no-round-btn pink" id="search"><i class="icon_search"></i></button>
                                        </div>
                                        </form>
                                        <div id="show-prod-search">
                                            <div class="seach-content">

                                            </div>
                                            <div class="search-footer">
                                                <button class="no-round-btn pink p-2" id="close-search">@lang('main.close')</button>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-0 col-xl-4 d-none">
                                <div class="phone-number">
                                    <div class="phone-number_icon"><i class="icon_phone"></i></div>
                                    <h2>+65 11.188.888</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End header-->

    @yield('content')
    <footer class="pink">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 text-sm-center text-md-left">
                    <div class="footer-logo"><img src="{{ asset('assets/images/logo.png') }}" alt=""></div>
                    <div class="footer-contact">
                        <p>@lang('main.footer.address'): {{ config('app.infomation.address_'.app()->getLocale()) }}</p>
                        <p>@lang('main.footer.phone'): {{ config('app.infomation.hotline') }}</p>
                        <p>@lang('main.footer.email'): {{ config('app.infomation.email') }}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12 col-sm-4 text-sm-center text-md-left">
                            <div class="footer-quicklink">
                                <h5>@lang('main.footer.infomation')</h5>
                                <a href="about_us.html">@lang('main.about_us')</a>
                                <a href="{{ route('contact') }}">@lang('main.contact')</a>
                                <a href="{{ route('blog') }}">@lang('main.blog')</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 text-sm-center text-md-left">
                            <div class="footer-quicklink">
                                <h5>@lang('main.footer.my_account')</h5>
                                <a href="{{ route('user.index') }}">@lang('main.my_account')</a>
                                <a href="{{ route('user.orders') }}">@lang('main.user_profile.my_orders')</a>
                                <a href="{{ route('user.wishlist') }}">@lang('main.user_profile.my_wishlist')</a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 text-sm-center text-md-left">
                            <div class="footer-quicklink">
                                <h5>@lang('main.footer.quick_shop')</h5>
                                <a href="{{ route('shop') }}">@lang('main.shop')</a>
                                <a href="{{ route('cart') }}">@lang('main.cart.list')</a>
                                <a href="#">Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newletter">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-12 col-md-7">
                        <div class="newletter_text text-center text-md-left">
                            <h5>@lang('main.subcribe.join_our_newsletter_now')</h5>
                            <p>@lang('main.subcribe.get_update')</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-5">
                        <div class="newletter_input">
                            <form action="https://site.us7.list-manage.com/subscribe/post" method="POST">
                                <input type="hidden" name="u" value="412efe8099d533a1f0694925b">
                                <input type="hidden" name="id" value="bad3409cc7">
                                <input class="round-input" type="email" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" placeholder="@lang('main.subcribe.input_text')">
                                <button type="submit">@lang('main.subcribe.btn_subcribe')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-credit">
            <div class="container">
                <div class="footer-creadit_block d-flex flex-column flex-md-row justify-content-start justify-content-md-between align-items-baseline align-items-md-center">
                    <p class="author">Copyright © 2020 {{ config('app.app_name') }} - All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="loader" style="text-align: center"><img src="/images/loader.gif" style="width: 50px;height: 50px;display: none"></div>
    <div class="modal-content">
    </div>
    </div>
    </div>
    <!-- End footer-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/numscroller-1.0.js') }}"></script>
    <script src="{{ asset('assets/js/vanilla-tilt.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/star-rating.min.js') }}"></script> 
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @php
        if(!isset($min_price) || !isset($max_price)){
        $min_price = 0;
        $max_price = 1000000;
    }
    @endphp
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/412efe8099d533a1f0694925b/015aa002c632c5d5cf042302c.js");</script>
    <script>
        $(document).ready(function () {
            $('.load-modal').each(function (index, elem) {
                $(elem).unbind().click(function (e) {
                    e.preventDefault();
                    e.preventDefault();
                    var curModal = $('#LoadModal');
                    curModal.find('.modal-content').html("<div class=\"loader\" style=\"text-align: center\"><img src=\"/images/loader.gif\" style=\"width: 50px;height: 50px;\"></div>");
                    curModal.modal('show').find('.modal-content').load($(elem).attr('rel'));
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $( "#range_price" ).slider({
              orientation: "horizital",
              range: true,
              min: {{$min_price}},
              max: {{$max_price}},
              step: 5000,
              values: [ {{$min_price}}, {{$max_price}} ],
              slide: function( event, ui ) {
                $( "#range_amount" ).val( "VNĐ " + ui.values[ 0 ] + " - VNĐ " + ui.values[ 1 ] );
                $( "#start_price" ).val(ui.values[ 0 ]);
                $( "#end_price" ).val(ui.values[ 1 ]);
              }
            });
            $( "#range_amount" ).val( "VNĐ " + $( "#range_price" ).slider( "values", 0 ) +
              " - VNĐ " + $( "#range_price" ).slider( "values", 1 ) );
            $( "#start_price" ).val({{$min_price}});
            $( "#end_price" ).val({{$max_price}});
        });
    </script>
</body>

</html>
