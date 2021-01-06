function autoScrollTo(el) {
    var top = $("#" + el).offset().top;
    $("html, body").animate({ scrollTop: top }, 1000);
}
$("#logout").click(function() {
    $.ajax({
        type: 'POST',
        url: '/logout',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function() {
            $(location).attr('href', '/');
        }
    });
});

$('.add-to-wishlist').click(function() {
    var id = $(this).data("id");
    var btn = $(this);
    var wCount = $('#wishlist .count');
    $.ajax({
        type: 'POST',
        url: '/product/add_to_wishlist',
        dataType: 'json',
        data: { product_id: id },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {

            swal({
                text: data.msg,
                icon: data.status,
                button: false
            });
            wCount.html(data.count);
            if (data.count == 0) {
                wCount.addClass('d-none');
            } else {
                wCount.removeClass('d-none');
            }
            if (data.action == 'add') {
                btn.addClass('active');
            } else {
                btn.removeClass('active');
            }

        }
    });
});

$('.remove-wish-product').click(function() {
    var id = $(this).data("id");
    var btn = $(this);
    var wCount = $('#wishlist .count');
    $.ajax({
        type: 'POST',
        url: '/product/add_to_wishlist',
        dataType: 'json',
        data: { product_id: id },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {

            swal({
                text: data.msg,
                icon: data.status,
                button: false
            }).then((result) => {
                // Reload the Page
                location.reload();
            });
            wCount.html(data.count);
            if (data.count == 0) {
                wCount.addClass('d-none');
            } else {
                wCount.removeClass('d-none');
            }
            if (data.action != 'add') {
                btn.parent().parent().remove();
            }

        }
    });
});


$('.add-to-cart').click(function() {
    var id = $(this).data("id");
    var btn = $(this);
    var cCount = $('#cart .count');
    var quantity = $("input[name='product-quantity']").val();
    $.ajax({
        type: 'POST',
        url: '/product/add_to_cart',
        dataType: 'json',
        data: { pid: id, quantity: quantity },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            console.log(quantity);
            swal({
                text: data.msg,
                icon: data.status,
                button: false
            });
            cCount.html(data.count);
            if (data.count == 0) {
                cCount.addClass('d-none');
            } else {
                cCount.removeClass('d-none');
            }

        }
    });
});

$('.cart-remove-item').click(function() {
    var id = $(this).data("id");
    var btn = $(this);
    var cCount = $('#cart .count');
    $.ajax({
        type: 'POST',
        url: '/cart/remove',
        dataType: 'json',
        data: { cart_id: id },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {

            swal({
                text: data.msg,
                icon: data.status,
            }).then((result) => {
                // Reload the Page
                location.reload();
            });
            cCount.html(data.count);
            if (data.count == 0) {
                cCount.addClass('d-none');
            } else {
                cCount.removeClass('d-none');
            }
            if (data.action != 'add') {
                btn.parent().parent().remove();
            }

        }
    });
});



$('.update-cart').click(function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var btn = $(this);
    $.ajax({
        type: 'POST',
        url: '/cart/update',
        dataType: 'json',
        data: $("#cartForm").serialize(),
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {

            swal({
                text: data.msg,
                icon: data.status,
            }).then((result) => {
                // Reload the Page
                location.reload();
            });

        }
    });
});

$('.place-order').click(function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var btn = $(this);
    $('button[type="submit"]').attr('disabled', 'disabled');
    $('.shopping-cart').addClass('input_loading');

    $.ajax({
        type: 'POST',
        url: '/user/cart/place-order',
        dataType: 'json',
        data: $("#cartForm").serialize(),
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            $('button[type="submit"]').removeAttr('disabled');
            $('.shopping-cart').removeClass('input_loading');
            if ($.isEmptyObject(data.error)) {
                swal({
                    text: data.success,
                    icon: "success",
                }).then((result) => {
                    // Reload the Page
                    window.location.href = data.url;
                });
            } else {
                printErrorMsg(data.error);
            }

        }
    });
});

$(window).scroll(function() {
    var sticky = $('#fixed-nav'),
        scroll = $(window).scrollTop(),
        height = $(document).height();
    if (scroll >= 40 && height > 1100) {
        sticky.addClass('fixed-nav');
        $('header .department-dropdown-menu.down').slideUp();
        $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-up').addClass('arrow_carrot-down');
    } else {
        sticky.removeClass('fixed-nav');
        $('header .department-dropdown-menu.down').slideDown();
        $('header .department-menu_block.down .department-menu span i').removeClass('arrow_carrot-down').addClass('arrow_carrot-up')
    }
});
// phần chọn địa chỉ
$("select[name='cities']").change(function() {
    var city_id = $(this).val();
    $("select[name='districts'").parent().addClass('input_loading'); // loading icon
    $("select[name='wards'").parent().addClass('input_loading'); // loading icon
    $.ajax({
        url: '/getDistricts',
        method: 'POST',
        data: {
            city_id: city_id,
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            $("select[name='districts'").html('');
            $("select[name='districts'").parent().removeClass('input_loading');
            $.each(data, function(key, value) {
                $("select[name='districts']").append(
                    '<option value=' + value.id + '>' + value.name_with_type + '</option>'
                );
            });
        }
    });
    $.ajax({
        url: '/getWards',
        method: 'POST',
        data: {
            city_id: city_id,
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            $("select[name='wards'").html('');
            $("select[name='wards'").parent().removeClass('input_loading');
            $.each(data, function(key, value) {
                $("select[name='wards']").append(
                    "<option value=" + value.id + ">" + value.name_with_type + "</option>"
                );
            });
        }
    });
});


$("select[name='districts']").change(function() {
    var district_id = $(this).val();
    $("select[name='wards'").parent().addClass('input_loading'); // loading icon
    $.ajax({
        url: '/getWardsInDistrict',
        method: 'POST',
        data: {
            district_id: district_id,
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            $("select[name='wards'").html('');
            $("select[name='wards'").parent().removeClass('input_loading');
            $.each(data, function(key, value) {
                $("select[name='wards']").append(
                    "<option value=" + value.id + ">" + value.name_with_type + "</option>"
                );
            });
        }
    });
});

$("select[name='saved_address']").change(function() {
    var address_id = $(this).val();
    $("#address1").addClass('input_loading'); // loading icon
    $("#address2").addClass('input_loading'); // loading icon
    if (address_id == 'default') {
        return location.reload();
    }
    $.ajax({
        url: '/user/getUserAddress',
        method: 'POST',
        data: {
            address_id: address_id,
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            $("#address1").removeClass('input_loading'); // loading icon
            $("#address2").removeClass('input_loading'); // loading icon
            $("select[name='cities'").html('');
            $("select[name='districts'").html('');
            $("select[name='wards'").html('');

            $("select[name='cities'").append(
                "<option value='" + data.success.city_id + "'>" + data.success.city + "</option>"
            );
            $("select[name='districts'").append(
                "<option value='" + data.success.district_id + "'>" + data.success.district + "</option>"
            );
            $("select[name='wards'").append(
                "<option value='" + data.success.ward_id + "'>" + data.success.ward + "</option>"
            );

            $("input[name='fullName'").val(data.success.full_name);
            $("input[name='phoneNumber'").val(data.success.phone_number);
            $("input[name='email'").val(data.success.order_email);
            $("input[name='address'").val(data.success.order_address2);
        }
    });
});

function printErrorMsg(msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display', 'block');
    $.each(msg, function(key, value) {
        $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
    });
}

$("input[name='product-quantity']").inputSpinner();

var starRatingControl = new StarRating('.star-rating', {
    showText: false,
    maxStars: 5,
    onClick: function(el) {
        console.log('Selected: ' + el[el.selectedIndex].text);
    },
});

$('.submitRating').submit(function(e) {
    e.preventDefault();
    var star = starRatingControl.widgets[0]['selected'];
    var productId = $("input[name='productId']").val();
    var message = $('textarea#review').val();

    $('.add-review').addClass('input_loading');
    $('.list_review').addClass('input_loading');
    $('.print-error-msg').hide();
    $.ajax({
        type: 'POST',
        url: '/product/submitRating',
        dataType: 'json',
        data: { star: star, productId, productId, message: message },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            if (data.status != 'success') {
                if (data.status == 'warning') {
                    swal({
                        text: data.msg,
                        icon: data.status,
                    });
                } else {
                    printErrorMsg(data.error);
                }
                $('.add-review').removeClass('input_loading');
                $('.list_review').removeClass('input_loading');
            } else {
                swal({
                    text: data.msg,
                    icon: data.status
                });
                $(".list_review").prepend('<div class="customer-review">' +
                    '<div class="row">' +
                    '<div class="col-12 col-sm-3 col-lg-2">' +
                    '<div class="customer-review_left"> ' +
                    '<div class="customer-review_img text-center"><img class="img-fluid" src="/' + data.review.avatar + '" alt="customer image"></div>' +
                    '<div class="customer-rate"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star-half"></i></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-sm-9 col-lg-10">' +
                    '<div class="customer-comment">' +
                    '<h5 class="comment-date float-right">' + data.review.now + '</h5>' +
                    '<h3 class="customer-name">' + data.review.name + '</h3>' +
                    '<p class="customer-commented">' + data.review.content + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $('.add-review').removeClass('input_loading');
                $('.list_review').removeClass('input_loading');
                console.log('ok');
            }
        }
    });
});


$('.submitComment').submit(function(e) {
    e.preventDefault();
    var postId = $("input[name='postId']").val();
    var messages = $('textarea#messages').val();

    $('.leave-reviews_block').addClass('input_loading');
    $('.list_comments').addClass('input_loading');
    $('.print-error-msg').hide();
    $.ajax({
        type: 'POST',
        url: '/post/submitComment',
        dataType: 'json',
        data: { postId, postId, messages: messages },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            if (data.status != 'success') {
                if (data.status == 'warning') {
                    swal({
                        text: data.msg,
                        icon: data.status,
                    });
                } else {
                    printErrorMsg(data.error);
                }
                $('.leave-reviews_block').removeClass('input_loading');
                $('.list_comments').removeClass('input_loading');
            } else {
                swal({
                    text: data.msg,
                    icon: data.status
                });
                $(".list_comments").prepend('<div class="customer-review">' +
                    '<div class="row">' +
                    '<div class="col-12 col-sm-3 col-lg-2">' +
                    '<div class="customer-review_left">' +
                    '<div class="customer-review_img text-center"><img class="img-fluid" src="/' + data.comment.avatar + '" alt="customer image"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 col-sm-9 col-lg-10">' +
                    '<div class="customer-comment">' +
                    '<h5 class="comment-date">' + data.comment.now + '</h5>' +
                    '<h3 class="customer-name">' + data.comment.name + '</h3>' +
                    '<p class="customer-commented">' + data.comment.message + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>');
                $('.add-review').removeClass('input_loading');
                $('.list_comments').removeClass('input_loading');
                console.log('ok');
            }
        }
    });
});


$('body').on('keyup', '#search-prod', function() {
    var keyword = $(this).val();
    $.ajax({
        type: 'POST',
        url: "/product/search_data",
        dataType: 'json',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {
            keyword: keyword
        },
        success: function(res) {
            if (res.code === 200) {
                $('.seach-content').empty();
                $('#show-prod-search').show();
                $('.seach-content').html(res.search_component);
            }
        }
    });
});

$("#close-search").click(function() {
    $('.seach-content').empty();
    $('#show-prod-search').hide();
    console.log('ok');
});

$('.submitContact').submit(function(e) {
    e.preventDefault();
    var fullname = $("input[name='fullname']").val();
    var email = $("input[name='email']").val();
    var messages = $('textarea#messages').val();

    $('.leave-message').addClass('input_loading');
    $('.print-error-msg').hide();
    $.ajax({
        type: 'POST',
        url: '/contact',
        dataType: 'json',
        data: { fullname, fullname, messages: messages, email: email },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            if (data.status == 'success') {
                swal({
                    text: data.msg,
                    icon: data.status,
                });
            } else {
                printErrorMsg(data.error);
            }
            $('.leave-message').removeClass('input_loading');

        }
    });
});


$('.submitSubscribe').submit(function(e) {
    e.preventDefault();
    var email_subscribe = $("input[name='email_subscribe']").val();

    $('.newletter_input').addClass('input_loading');
    $.ajax({
        type: 'POST',
        url: '/subscribe',
        dataType: 'json',
        data: { email: email_subscribe },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data) {
            swal({
                text: data.msg,
                icon: data.status,
            });
            $('.newletter_input').removeClass('input_loading');
        }
    });
});

$("#checkcoupon").click(function(e){
    e.preventDefault();
    var code = $('#code').val();
    $.ajax({
        type: 'POST',
        url: 'cart/coupon',
        dataType: 'json',
        data: {
            'code': code
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data){
            swal({
                text: data.msg,
                icon: data.status,
            }).then((result) => {
                // Reload the Page
                location.reload();
            });
        }
    });
}); 