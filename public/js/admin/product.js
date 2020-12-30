// post form
$(".addProduct").click(function(e) {
    e.preventDefault();


    var _token = $("input[name='_token']").val();
    var prod_name = $("input[name='prod_name']").val();
    var unit_price = $("input[name='unit_price']").val();
    var sale = $("input[name='sale']").val();
    var hsd=$("input[name='hsd']").val();
    var cate_id = $("select[name='cate_id'] option:selected").val();
    var status = $("select[name='status'] option:selected").val();
    var mediaId = $("input[id='mediaId']").val();
    var quantity = $("input[id='quantity']").val();
    var unit = $("input[id='unit']").val();
    //var content = $("textarea[name='content']").val();
    var content = CKEDITOR.instances.content.getData();
    var detail = $("textarea[name='detail']").val();
    var seo_title = $("input[name='seo_title']").val();
    var seo_description = $("textarea[name='seo_description']").val();
    var seo_keywords = $("input[name='seo_keywords']").val();
    var detail_name = $("input[name='detail_name[]']").map(function() { return $(this).val(); }).get();
    var detail_value = $("input[name='detail_value[]']").map(function() { return $(this).val(); }).get();
    var detail = '[';
    $.each(detail_name, function(key, value) {
        detail += '{"info":"' + $.trim(value) + '","value":"' + $.trim(detail_value[key]) + '"},';
    });
    detail = detail.slice(0, -1)
    detail += ']';

    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    $.ajax({
        url: "/admin/product",
        type: 'POST',
        data: { _token: _token, unit: unit, hsd: hsd, prod_name: prod_name, unit_price: unit_price, status: status, quantity: quantity, detail: detail, sale: sale, cate_id: cate_id, content: content, detail: detail, seo_title: seo_title, seo_description: seo_description, seo_keywords: seo_keywords, thumb_id: mediaId },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                swal({
                    text: data.success,
                    icon: "success",
                });
            } else {
                printErrorMsg(data.error);
            }
        }
    });


});

// edit form
$(".editProduct").click(function(e) {
    e.preventDefault();


    var pid = $("input[name='pid']").val();
    var _token = $("input[name='_token']").val();
    var _method = $("input[name='_method']").val();
    var prod_name = $("input[name='prod_name']").val();
    var unit_price = $("input[name='unit_price']").val();
    var sale = $("input[name='sale']").val();
    var hsd=$("input[name='hsd']").val();
    var cate_id = $("select[name='cate_id'] option:selected").val();
    var status = $("select[name='status'] option:selected").val();
    var mediaId = $("input[id='mediaId']").val();
    var quantity = $("input[id='quantity']").val();
    var unit = $("input[id='unit']").val();
    var content = CKEDITOR.instances.content.getData();
    var detail = $("textarea[name='detail']").val();
    var seo_title = $("input[name='seo_title']").val();
    var seo_description = $("textarea[name='seo_description']").val();
    var seo_keywords = $("input[name='seo_keywords']").val();
    var detail_name = $("input[name='detail_name[]']").map(function() { return $(this).val(); }).get();
    var detail_value = $("input[name='detail_value[]']").map(function() { return $(this).val(); }).get();
    var detail = '[';
    $.each(detail_name, function(key, value) {
        detail += '{"info":"' + $.trim(value) + '","value":"' + $.trim(detail_value[key]) + '"},';
    });
    detail = detail.slice(0, -1)
    detail += ']';

    console.log('----');
    console.log(detail);
    $.ajax({
        url: "/admin/product/" + pid,
        type: 'POST',
        data: { _token: _token, _method: _method, unit: unit, hsd: hsd, prod_name: prod_name, unit_price: unit_price, status: status, quantity: quantity, detail: detail, sale: sale, cate_id: cate_id, content: content, detail: detail, seo_title: seo_title, seo_description: seo_description, seo_keywords: seo_keywords, thumb_id: mediaId },
        success: function(data) {
            if ($.isEmptyObject(data.error)) {
                swal({
                    text: data.success,
                    icon: "success",
                });
            } else {
                printErrorMsg(data.error);
            }
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

function addMore() {
    $("#product").append('<tr class="product-item"><td valign="top"><input type="checkbox" name="item_index[]" /></td><td valign="top"><input class="form-control" type="text" name="detail_name[]" placeholder="" /></td><td valign="top"><input class="form-control" type="text" name="detail_value[]" placeholder="" /></td></tr>');
}

function deleteRow() {
    $('.product-item').each(function(index, item) {
        jQuery(':checkbox', this).each(function() {
            if ($(this).is(':checked')) {
                $(item).remove();
            }
        });
    });
}