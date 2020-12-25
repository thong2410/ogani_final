<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Review;
use App\Order;
use App\Product;

class AdminController extends Controller
{
    protected $data = [];

    public function index(){
        $this->data['new_reviews'] = Review::orderBy('created_at', 'DESC')->limit(10)->get();
        $this->data['new_orders'] = Order::orderBy('created_at', 'DESC')->limit(10)->get();
        $this->data['orders_delivered'] = Order::where('order_status', '=', 'delivered')->get();
        $this->data['products_in_stock'] = Product::where('quantity', '>', 0)->get();
        $this->data['total_order_this_month'] = Order::select(
                                                    //DB::raw('count(*) as sums'), 
                                                    DB::raw("DATE_FORMAT(created_at,'%m') as months")
                                                )
                                                ->whereYear('created_at', '=', date("Y"))
                                                ->whereMonth('created_at', '=', date("m"))
                                                ->get();
        $this->data['total_revenue_this_month'] = DB::table('orders')
                    ->select('orders.order_id as order_id')
                    ->join('order_details', 'orders.order_id', '=', 'order_details.order_id')
                    ->where('orders.order_status', '=', 'delivered')
                    ->whereYear('created_at', '=', date("Y"))
                    ->whereMonth('created_at', '=', date("m"))
                    ->sum(DB::raw('order_details.unit_price * order_details.quantity'));

        return view('admin.index', $this->data);
    }

}
