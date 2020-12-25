<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;

class OrderController extends Controller
{
    protected $data = [];

    public function index(Request $request)
    {
        $data = Order::orderBy('created_at','DESC');

        if ($request->has('keyword') && !empty($request->keyword)) {
            $data = $data->Where('order_id', 'LIKE', '%'.$request->keyword.'%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $data = $data->Where('order_status', ''.$request->status.'');
        }
        $data = $data->paginate(config('app.paginate'));
        
        $this->data['input'] = $request->all();
        $this->data['orders'] = $data;
        $this->data['title'] = trans('admin.order.orders');

        return view('admin.order.index',$this->data);
    }

    public function viewUserOrder(User $user, Request $request) {
        $data = Order::where('user_id', $user->user_id)
                    ->orderBy('created_at','DESC');

        if ($request->has('keyword') && !empty($request->keyword)) {
            $data = $data->Where('order_id', 'LIKE', '%'.$request->keyword.'%');
        }
        if ($request->has('status') && !empty($request->status)) {
            $data = $data->Where('order_status', ''.$request->status.'');
        }
        $data = $data->paginate(config('app.paginate'));
        
        $this->data['input'] = $request->all();
        $this->data['orders'] = $data;
        $this->data['title'] = trans('admin.order.orders_user', ['name' => $user->fullname]);

        return view('admin.order.index',$this->data);       
    }

    public function show($id)
    {
        if(!Order::find($id)) abort(404);
        $this->data['order'] = Order::find($id);

        return view('admin.order.details', $this->data);
    }

    public function update($id, Request $request)
    {
        $order = Order::find($id);

        if(!$order) return response()->json(['status' => 'error', 'msg' => trans('admin.order.not_found')]);
        else if($order->order_status == 'delivered') return response()->json(['status' => 'error', 'msg' =>  trans('admin.order.can_not_update')]);

        $order->update(['order_status' => $request->order_status]);

		return response()->json(['status' => 'success', 'msg' =>  trans('admin.order.update_success')]);
    }
    public function destroy($id)
    {
        $category = Order::destroy($id);
        if(!$category) return redirect()->route('admin.order.index')->with('message', ['msg' => trans('admin.order.not_found'), 'status' => 'danger']);

        return redirect()->route('admin.order.index')->with('message', ['msg' => trans('admin.order.del_success'), 'status' => 'success']);
    }
}
