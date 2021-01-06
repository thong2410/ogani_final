// $('#del_coupon_used').click(function(e){
//     if(confirm("Bạn muốn xóa mã đã dùng ?")){
//         var coupon_id = $(this).data('coupon');
//         $.ajax({
//             type: 'GET',
//             url: 'admin/coupondetail/del_used',
//             dataType: 'json',
//             data: {
//                 coupon_id: coupon_id
//             },
//             success: function(data){
//                 alert(data);
//             }
//         });  
//     }
// });

// $('.del_one').click(function(){
//     if(confirm('Bạn muốn xóa mã giảm giá này ?')){
//         var data = $(this).data('id');
//         $.ajax({
//             type: 'get',
//             url: 'admin/coupondetail/destroy/'+data,
//         });
//     }
// })