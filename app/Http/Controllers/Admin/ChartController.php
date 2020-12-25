<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class ChartController extends Controller
{

    public function getCountStatus($status){
        $data = Order::Where('order_status', $status)
                    ->groupBy('order_status')
                    ->count('order_id');
        
        return (int)$data;
    }

    public function getCountByMonth($month){
        $data = Order::Where('order_status', 'delivered')
                    ->whereYear('created_at', '=', date("Y"))
                    ->whereMonth('created_at', '=', $month)
                    ->count('order_id');
    
        return (int)$data;
    }

    public function orderStatus(){
        return response()->json([
            'data' => [
                $this->getCountStatus('processing'), 
                $this->getCountStatus('shipping'), 
                $this->getCountStatus('delivered'), 
                $this->getCountStatus('cancelled'), 
            ],
            'labels' => [
                trans('admin.order.status_str.processing'),
                trans('admin.order.status_str.shipping'),
                trans('admin.order.status_str.delivered'),
                trans('admin.order.status_str.cancelled')
            ]
        ]);
    }
    public function orderByMonth(){
        if (app()->getLocale() != 'vi') {
            $arrCategories = [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "May",
                "Jun",
                "Jul",
                "Aug",
                "Sep",
                "Oct",
                "Nov",
                "Dec"
            ];
        }else {
            $arrCategories = [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12",
            ];            
        }
        $arrData = array();
        for ($i=1; $i < 13; $i++) { 
            $arrData[$i] = $this->getCountByMonth($i);
        }
        
        return response()->json([
            'data' => array_values($arrData),
            'labels' => $arrCategories,
            'name' => trans('admin.home.order')
        ]);
    }
}
