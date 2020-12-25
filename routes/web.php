<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/shop/{cid?}', 'HomeController@shop')->name('shop');
Route::post('/shop/limit', 'HomeController@setLimit')->name('set-limit');
Route::post('/shop/sort', 'HomeController@setSort')->name('set-sort');
Route::get('/blog/{cid?}', 'BlogController@index')->name('blog');
Route::get('/post/{id}', 'BlogController@show')->where('id', '[0-9]+')->name('post.detail');
Route::post('/post/submitComment', 'BlogController@addComment')->name('post.comment');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@postcontact')->name('contact');
Route::get('/product/{id}', 'ProductController@show')->where('id', '[0-9]+')->name('product.detail');
Route::post('/product/quick_view', 'ProductController@quickView')->name('product.quick-view');
Route::post('/product/add_to_wishlist', 'WishlistController@addToWishList')->name('product.add-to-wishlist');
Route::post('/product/add_to_cart', 'ProductController@addToCart')->name('product.add-to-cart');
Route::post('/product/search_data', 'HomeController@searchData')->name('product.search');
Route::post('/product/submitRating', 'ProductReviewController@addReview')->name('product.review');
Route::get('/product/search', 'HomeController@search')->name('product.search');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'can:accessAdmin'])
    ->group(function () {
        Route::get('dashboard', 'AdminController@index')->name('index');
        Route::resource('category', 'Admin\CategoryController')->middleware('can:isAdmin,isSuperAdmin');
        Route::resource('product', 'Admin\ProductController')->middleware('can:isAdmin,isSuperAdmin');
        Route::resource('blog_category', 'Admin\BlogCategoryController')->middleware('can:isEditor,isAdmin,isSuperAdmin');
        Route::resource('blog', 'Admin\BlogController')->middleware('can:isEditor,isAdmin,isSuperAdmin');
        Route::resource('comment', 'Admin\CommentController')->middleware('can:isEditor,isAdmin,isSuperAdmin');
        Route::resource('order', 'Admin\OrderController')->middleware('can:isAdmin,isSuperAdmin');
        Route::resource('rating', 'Admin\RatingController')->middleware('can:isAdmin,isSuperAdmin');
        Route::resource('contact', 'Admin\ContactController')->middleware('can:isAdmin,isSuperAdmin');
        Route::get('contact/del/{id?}', 'Admin\ContactController@delcontact');
        Route::post('media/upload/product', 'MediaController@uploadProduct')->name('media.upload');
        Route::get('media/list', 'MediaController@index')->name('media.list');
        Route::resource('user','Admin\UserController')->middleware('can:isAdmin,isSuperAdmin');
        Route::get('user/order/{user}', 'Admin\OrderController@viewUserOrder')->where('user', '[0-9]+')->middleware('can:isAdmin,isSuperAdmin')->name('order.user-order');
        Route::get('chart/order_status', 'Admin\ChartController@orderStatus')->name('chart.status');
        Route::get('chart/order_by_month', 'Admin\ChartController@orderByMonth')->name('chart.status');

});

Route::name('user.')
    ->prefix('user')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('dashboard', 'UserController@index')->name('index');
        Route::post('getUserAddress', 'UserController@getUserAddress')->name('address');
        Route::get('wishlist', 'UserController@wishlist')->name('wishlist');
        Route::get('edit', 'UserController@edit')->name('edit');
        Route::put('update', 'UserController@update')->name('update');
        Route::get('password', 'UserController@password')->name('password');
        Route::put('password', 'UserController@SavePassword')->name('save.password');
        Route::get('orders', 'UserController@orders')->name('orders');
        Route::get('orders/detail/{id}', 'UserController@orderDetail')->name('order.detail');
        Route::get('cart/checkout', 'UserController@checkout')->name('cart.checkout');
        Route::post('edit_account/{id}', 'UserController@updateAccount')->name('editAccount');
        Route::post('cart/place-order', 'UserController@placeOrder')->name('cart.place-order');
        Route::get('cart/order-completed', 'UserController@orderCompleted')->name('cart.order-completed');
        
});

Route::get('cart', 'UserController@cart')->name('cart');
Route::post('cart/remove', 'ProductController@removeCartItem')->name('cart.remove.item');
Route::post('cart/update', 'ProductController@updateCart')->name('cart.update.item');
Route::post('getDistricts', 'AddressController@getDistricts');
Route::post('getWards', 'AddressController@getWards');
Route::post('getWardsInDistrict', 'AddressController@getWardsInDistrict');
