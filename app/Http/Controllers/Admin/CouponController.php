<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Coupon;
use App\CouponDetail;

class CouponController extends Controller
{
    protected $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coupons = Coupon::orderBy('coupon_id','DESC');

        if ($request->has('keyword') && !empty($request->keyword)) { // tìm theo keyword
            $coupons = $coupons->where('coupon_event', 'LIKE', '%'.$request->keyword.'%');
        }
        if ($request->has('type') && !empty($request->type)){
            $coupons = $coupons->where('type',''.$request->type.'');
        }

        $coupons = $coupons->paginate(config('app.paginate'));
        $this->data['coupons'] = $coupons;
        $this->data['input'] = $request->all();

        return view('admin.coupon.index', $this->data);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
        $checkDate =  strtotime($request->end_date) - strtotime($request->start_date);
        if($checkDate < 0){
            return redirect()->back()->with('message',['msg' => trans('admin.coupon.errorDate'),'status' => 'warning']);
        }
        
        Coupon::create([
                'coupon_event' => $request->coupon_event,
                'type' => $request->type,
                'coupon_value' => $request->coupon_value,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        $lastCouponId = Coupon::latest()->first()->coupon_id;

        $code = time();
        for ($i=0; $i < $request->quantity ; $i++) { 
            CouponDetail::create([
                'coupon_id' => $lastCouponId,
                'code' => crc32($code."".$i),
            ]);
        }

        return redirect()->route('admin.coupon.index')->with('message',['msg' => trans('admin.coupon.create_success'),'status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($coupon_id)
    {
        $coupon = Coupon::destroy($coupon_id);
        if(!$coupon) return redirect()->route('admin.coupon.index')->with('message', ['msg' => trans('admin.coupon.not_found'), 'status' => 'danger']);

        return redirect()->route('admin.coupon.index')->with('message', ['msg' => trans('admin.category.del_success'), 'status' => 'success']);
    }
}
