<div class="modal-header">
        <h5 class="modal-title">@lang('admin.order.order_id', ['id' => $order->order_id]) - {!! trans('admin.order.status_label.'.$order->order_status) !!}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
<h4>@lang('admin.order.order_items')</h4>
<hr/>
<table class="table table-bordered">
  <thead>
    <tr>
    <th scope="col">@lang('admin.order.product')</th>
      <th scope="col">@lang('admin.order.quantity')</th>
      <th scope="col">@lang('admin.order.unit_price')</th>
      <th scope="col">@lang('admin.order.total_price')</th>
    </tr>
  </thead>
  <tbody>
    @php
        $total = 0;
    @endphp
    @foreach($order->items as $item)
    <tr>
    <td>
        <img src="/{{ $item->product->thumb->path }}/{{ $item->product->thumb->name }}" class="img-thumbnail mr-2" width="40px"> {{ $item->product->prod_name}}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ number_format($item->unit_price) }}₫ @if(!empty($item->product->unit))<sub>/ {{ $item->product->unit }}</sub>@endif</td>
        <td>{{ number_format($item->unit_price * $item->quantity) }}₫</td>
    </tr>
        @php
            $total = $total + ($item->unit_price * $item->quantity);
        @endphp
    @endforeach
    <tr>
      <th colspan="3" style="border-top: 4px solid #dee2e6;">@lang('admin.order.shipping.method')</th>
      <td style="border-top: 4px solid #dee2e6;"><span class="text-success">@lang('admin.order.shipping.free_ship')</span></td>
    </tr>
    <tr>
      <th colspan="3">@lang('admin.order.payment.method')</th>
      <td><span class="text-primary">@lang('admin.order.payment.cod')</span></td>
    </tr>
    <tr>
      <th colspan="3">@lang('admin.order.total')</th>
      <td>{{ number_format($total) }}₫</td>
    </tr>
  </tbody>
</table>
<h4 class="mt-4">@lang('admin.order.order_notes')</h4>
<hr/>
<div class="alert alert-info">
    <p>{{ $order->order_Note }}</p>
</div>
<div class="row">
    <div class="col-6">
    <h4 class="mt-4">@lang('admin.order.customer_detail')</h4>
    <hr/>
    <p class="mt-3 mb-2"><b>@lang('admin.order.customer.fullname'):</b> {{ $order->full_name }}</p>
    <p class="mt-3 mb-2"><b>@lang('admin.order.customer.email'):</b> {{ $order->order_email }}</p>
    <p class="mt-3 mb-2"><b>@lang('admin.order.customer.phone'):</b> {{ $order->phone_number }}</p>
    </div>
    <div class="col-6">
    <h4 class="mt-4">@lang('admin.order.shipping_address')</h4>
    <hr/>
    <p class="mt-3 mb-2">{{ $order->order_address2 }}</p>
    <p class="mt-3 mb-2">{{ $order->order_address }}</p>
    </div>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('admin.order.close')</button>
</div>