<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <title>@yield('title') - {{ config('app.app_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0038f2">
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
</head>

<style>
.star-ratings {
    color: #ccc;
    font-size: 13px;
    position: relative;
    margin: 2px 0;
    padding: 0;
    width: 65px;
    display: block;
}

.star-ratings .fill-ratings {
    color: #f0b11c;
    padding: 0;
    position: absolute;
    z-index: 1;
    display: block;
    top: 0;
    left: 0;
    overflow: hidden;
}

.star-ratings .fill-ratings span {
    display: inline-block;
}

.star-ratings .empty-ratings {
    padding: 0;
    display: block;
    z-index: 0;
}
</style>
<body class="st-body">
    <div class="st-wrapper">
        <aside class="st-sidebar" id="js-st-sidebar" data-backdrop="true">
            <div class="d-flex p-3 d-xl-none">
                <button class="toggle-btn btn btn-outline-light ml-auto d-xl-none" type="button" data-toggle="show"
                    data-target="#js-st-sidebar">
                    <i class="fad fa-arrow-left"></i>
                </button>
            </div>
            <div class="st-nav">
                <div class="scrollable">
                    <div class="scrollable__container">
                        <ul class="st-menu">
                            <li class="st-menu__item">
                                <a href="{{ route('admin.index') }}" class="st-menu__link">
                                    <i class="st-menu__icon fad fa-house-flood"></i>
                                    <span class="st-menu__text">@lang('main.dashboard')</span>
                                </a>
                            </li>
                            @if(Auth::user()->role('admin') || Auth::user()->role('superadmin'))
                            <li class="st-menu__item">
                                <a href="javascript:void" class="st-menu__link st-menu__toggle">
                                    <i class="st-menu__icon fad fa-layer-group"></i>
                                    <span class="st-menu__text">@lang('admin.category.category')</span>
                                    <i class="st-menu__caret fad fa-chevron-down"></i>
                                </a>
                                <div class="st-menu__submenu">
                                    <a href="{{ route('admin.category.index') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.category.categories')</span>
                                    </a>
                                    <a href="{{ route('admin.category.create') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.category.create')</span>
                                    </a>
                                </div>
                            </li>
                            <li class="st-menu__item">
                                <a href="javascript:void" class="st-menu__link st-menu__toggle">
                                    <i class="st-menu__icon fad fa-archive"></i>
                                    <span class="st-menu__text">@lang('admin.product.product')</span>
                                    <i class="st-menu__caret fad fa-chevron-down"></i>
                                </a>
                                <div class="st-menu__submenu">
                                    <a href="{{ route('admin.product.index') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.product.products')</span>
                                    </a>
                                    <a href="{{ route('admin.product.create') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.product.create')</span>
                                    </a>
                                </div>
                            </li>
                            <li class="st-menu__item">
                                <a href="{{route('admin.user.index')}}" class="st-menu__link">
                                    <i class="st-menu__icon fad fa-user"></i>
                                    <span class="st-menu__text">@lang('admin.user.users')</span>
                                </a>
                            </li>
                            <li class="st-menu__item">
                                <a href="{{route('admin.order.index')}}" class="st-menu__link">
                                    <i class="st-menu__icon fad fa-list"></i>
                                    <span class="st-menu__text">@lang('admin.order.orders')</span>
                                </a>
                            </li>
                            <li class="st-menu__item">
                                <a href="javascript:void" class="st-menu__link st-menu__toggle">
                                    <i class="st-menu__icon fad fa-percent"></i>
                             
                                    <span class="st-menu__text">@lang('admin.coupon.coupon')</span>
                                    <i class="st-menu__caret fad fa-chevron-down"></i>
                                </a>
                                <div class="st-menu__submenu">
                                    <a href="{{ route('admin.coupon.index') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.coupon.categories')</span>
                                    </a>
                                    <a href="{{ route('admin.coupon.create') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.coupon.create')</span>
                                    </a>
                                </div>
                            </li>
                            @endif
                            @if(Auth::user()->role('admin') || Auth::user()->role('superadmin') || Auth::user()->role('editor'))
                            <li class="st-menu__item">
                                <a href="javascript:void" class="st-menu__link st-menu__toggle">
                                    <i class="st-menu__icon fad fa-layer-group"></i>
                                    <span class="st-menu__text">@lang('admin.blog_category.category')</span>
                                    <i class="st-menu__caret fad fa-chevron-down"></i>
                                </a>
                                <div class="st-menu__submenu">
                                    <a href="{{ route('admin.blog_category.index') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.blog_category.categories')</span>
                                    </a>
                                    <a href="{{ route('admin.blog_category.create') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.blog_category.create')</span>
                                    </a>
                                </div>
                            </li>
                            <li class="st-menu__item">
                                <a href="javascript:void" class="st-menu__link st-menu__toggle">
                                    <i class="st-menu__icon fad fa-rss-square"></i>
                                    <span class="st-menu__text">@lang('admin.blog.article')</span>
                                    <i class="st-menu__caret fad fa-chevron-down"></i>
                                </a>
                                <div class="st-menu__submenu">
                                    <a href="{{ route('admin.blog.index') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.blog.articles')</span>
                                    </a>
                                    <a href="{{ route('admin.blog.create') }}" class="st-menu__link">
                                        <span class="st-menu__text">@lang('admin.blog.create')</span>
                                    </a>
                                </div>
                            </li>
                            <li class="st-menu__item">
                                <a href="{{route('admin.contact.index')}}" class="st-menu__link">
                                    <i class="st-menu__icon fad fa-envelope"></i>
                                 
                                    <span class="st-menu__text">@lang('admin.contact.contact')</span>
                                </a>
                            </li>
                            @endif

                        </ul>
                        <!-- menu -->
                    </div>
                    <!-- .scrollable__container -->
                </div>
                <!-- .scrollable -->
            </div>
            <!-- .st-nav -->
        </aside>
        <main class="st-main">
            <nav class="st-navbar">
                <div class="st-navbar__nav mr-auto">
                    <button class="navbar__nav-item btn btn-outline-light d-xl-none" type="button" data-toggle="show"
                        data-target="#js-st-sidebar">
                        <i class="fad fa-arrow-right"></i>
                    </button>
                    <div class="navbar__nav-item dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown">
                            <img src="{{ asset(Auth::user()->avatar) }}" alt="user" class="avatar avatar--xs rounded-circle">
                            <span>{{ Auth::user()->fullname }}</span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('home') }}" class="dropdown-item">
                                <i class="fad fa-sign-out-alt mr-3"></i>
                                <span>@lang('main.home')</span>
                            </a>
                        </div>
                    </div>
                    <div class="navbar__nav-item dropdown">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown">
                            <span><img src="{{ asset('assets/images/homepage01/'.app()->getLocale().'.jpg') }}" alt="" width="20px"></span>
                        </button>
                        <div class="dropdown-menu">
                            <a href="{{ route('locale', 'vi') }}" class="dropdown-item">
                                <img src="{{ asset('assets/images/homepage01/vi.jpg') }}" alt="" class="mr-3" width="20px">
                                <span>@lang('main.lang.vietnamese')</span>
                            </a>
                            <a href="{{ route('locale', 'en') }}" class="dropdown-item">
                            <img src="{{ asset('assets/images/homepage01/en.jpg') }}" alt="" class="mr-3" width="20px">
                                <span>@lang('main.lang.english')</span>
                            </a>
                        </div>
                    </div>
                    
                </div>
                @if(Auth::user()->role('admin') || Auth::user()->role('superadmin'))
                <div class="st-navbar__nav">
                    <div class="dropdown navbar__nav-item d-none d-md-block">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fad fa-plus mr-2"></i>
                            <span>@lang('admin.quick_action')</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                            style="position: absolute; transform: translate3d(-40px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="{{ route('admin.product.create') }}">
                                <i class="fad fa-plus mr-3"></i>
                                <span>@lang('admin.product.create')</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.category.create') }}">
                                <i class="fad fa-plus mr-3"></i>
                                <span>@lang('admin.category.create')</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.order.index') }}">
                                <i class="fad fa-plus mr-3"></i>
                                <span>@lang('admin.order.orders')</span>
                            </a>
                        </div>
                    </div>
                    <!-- .dropdown -->
                </div>
                @endif
            </nav>
            <div class="st-content">
            @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>
    <script src="{{ asset('js/admin/popper.min.js') }}"></script>
    <script src="{{ asset('js/admin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/admin/plugins.js') }}"></script>
    <script src="{{ asset('js/admin/app.js') }}"></script>
    <script src="{{ asset('js/admin/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/admin/charts.js?id='.time()) }}"></script>
    <script src="{{ asset('js/admin/product.js') }}"></script>
    <script src="{{ asset('js/admin/coupon.js') }}"></script>
    <script src="{{ asset('js/admin/file-upload.js') }}"></script>
    <div class="modal fade" id="LoadModal" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
    <div class="loader" style="text-align: center"><img src="/images/loader.gif" style="width: 50px;height: 50px;display: none"></div>
    <div class="modal-content">
    </div>
    </div>
    </div>
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
        CKEDITOR.replace( 'content' );
        });
    </script>
    
<script type="text/javascript">
    $("#parent").change(function(){
        var coupon_value = $(this).val();
        if(coupon_value == 'money'){
            $('#money').show();
            $('#percent').hide();
            $('#percent').empty();
            $('#money').html("<label for='coupon_value'>@lang('admin.coupon.coupon_value')</label><div class='input-group mb-3'><span class='input-group-text'>VNĐ</span><input type='number' class='form-control' id='coupon_value' name='coupon_value' min='1000' aria-label='Amount (to the nearest dollar)' placeholder='@lang('admin.coupon.placeholder.money')'' required=''><span class='input-group-text'>.00</span></div>");
        }else if(coupon_value == 'percent'){
            $('#percent').show();
            $('#money').hide();
            $('#money').empty();
            $('#percent').html("<label for='coupon_value'>@lang('admin.coupon.coupon_value')</label><div class='input-group mb-3'><span class='input-group-text'>Percent</span><input type='number' class='form-control' id='coupon_value' name='coupon_value' min='0' aria-label='Amount (to the nearest dollar)' placeholder='@lang('admin.coupon.placeholder.percent')' max='100' required=''><span class='input-group-text'>%</span></div>");
        }
    });
</script>
</body>

</html>