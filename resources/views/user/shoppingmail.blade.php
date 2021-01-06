<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
.table1{border:1px solid #e5e5e5;background-color:#fe5f5b;vertical-align:middle;width:50%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif}
.table2 {border:1px solid #e5e5e5;background-color:#ffffff;vertical-align:middle;width:50%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif}
th{border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left}
.td1{border:1px solid #e5e5e5;padding:12px;text-align:left;vertical-align:middle;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;}
.td2{color:red;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left}
.h2{color:#fe5f5b}
</style>    
  </head>
  <body>
<div class="container">
  <table cellspacing="0" cellpadding="6" border="1" class="table1" style="width: 100%;">             
    <tr>
      <h2 style="margin: 16px 0 16px;text-align: center;color: #fff;">@lang('main.mail.thanks')</h2>
    </tr>             
  </table>
<div style="margin-bottom:40px">
  <table cellspacing="0" cellpadding="6" border="1" class="table2" style="width: 100%;">              
    <thead>
      <tr>
        <th scope="col" >@lang('main.mail.product')</th>
        <th scope="col" >@lang('main.mail.quantity')</th>
        <th scope="col" >@lang('main.mail.unit_price')</th>
        <th scope="col" >@lang('main.mail.total_price')</th>
      </tr>
    </thead>
    <tbody>
      @php
        $total = 0;
      @endphp
      <?php $n=1 ?>
        @foreach($cart as  $item)
      <tr>
        <td class="td1">
          {{ $item['name'] }}		</td>
        <td class="td1">
          {{ $item['quantity'] }}	</td>
        <td class="td1">
          <span>{{ number_format($item['price']) }}₫ @if(!empty($item['unit']))<sub>/ {{ $item['unit'] }}</sub>@endif</span>
        </td>
        <td class="td1">
          <span>{{ number_format($item['price'] * $item['quantity']) }}₫</span>
        </td>
      </tr>
      @php
        $total = $total + ($item['price'] * $item['quantity']);
      @endphp
      <?php $n++ ?>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th scope="row" colspan="3" >@lang('main.mail.payment_method'):</th>
        <td class="td1">@lang('main.mail.cod')</td>
</tr>
<tr>
<th scope="row" colspan="2" >@lang('main.mail.total'):</th>
<td class="td2">(- @lang('admin.coupon.coupon')) <br>
  @php
      $coupons = explode(',',$couponList);
      foreach($coupons as $coupon){
          if($coupon < 100 && $coupon > 0 ){
              echo $coupon.'% <br>';
          }elseif($coupon != null){
             echo $coupon.'VNĐ <br>';
          }  
      }
  @endphp
</td>
<td class="td2"><span>{{ number_format($total_price) }}<span>₫</span></span></td>
</tr>
</tfoot>
</table>
</div>
   
    <h2 style="color:#fe5f5b;">@lang('main.mail.your_order_info')</h2>
    <h3>@lang('main.mail.fullname'): {{$full_name}}</h3>
    <h3>@lang('main.mail.address'): {{$order_address2}}, {{$order_address}}</h3>
    <h3>@lang('main.mail.phone_number'): {{$phone_number}}</h3>
    <h3>@lang('main.mail.email'): {{$order_email}}</h3>

</div>
  </body>
</html>

    



