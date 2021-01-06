<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\CouponDetail;
use App\Coupon;
use Carbon\Carbon;

class CouponDetailController extends Controller
{
	protected $data = [];

    public function show(Request $request, $id)
    {
        $CouponEvent = Coupon::where('coupon_id', $id)->first();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if($today > $CouponEvent->end_date){
            CouponDetail::where('coupon_id',$id)->where('status','like','new')->update(['status' => 'expired']);
        } 

        $CouponDetail = CouponDetail::where('coupon_id',$id)->orderBy('id','DESC');

        if($request->has('keyword') && $request->keyword != ""){
        	$CouponDetail = $CouponDetail->where('code', trim($request->keyword));
        }
        if($request->has('status') && $request->status != ""){
            $CouponDetail = $CouponDetail->where('status', ''.$request->status.'');
        }

        $CouponDetail = $CouponDetail->paginate(config('app.paginate'));
        $this->data['CouponDetail'] = $CouponDetail;
        $this->data['coupon_id'] = $id;
        $this->data['input'] = $request->all();

        return view('admin.coupon.detail', $this->data);
    }

    public function add_coupon($coupon_id){
    	$coupon = Coupon::find($coupon_id);
    	if(!$coupon) return redirect()->route('admin.coupon.index')->with('message', ['msg' => trans('admin.coupon.not_found'), 'status' => 'danger']);

    	$this->data['coupon'] = $coupon;
    	return view('admin.coupon.add', $this->data);
    }

    public function add(CouponRequest $request){
    	$code = time();
        for ($i=0; $i < $request->quantity ; $i++) { 
            CouponDetail::create([
                'coupon_id' => $request->coupon_id,
                'code' => crc32($code."".$i),
            ]);
        }

        return redirect()->route('admin.coupon.index')->with('message',['msg' => trans('admin.coupon.create_success'),'status' => 'success']);
    }

    public function destroy($id){
    	$coupon = CouponDetail::destroy($id);
    	if(!$coupon) return redirect()->back()->with('message', ['msg' => trans('admin.coupon.not_found'), 'status' => 'danger']);

    	return redirect()->back()->with('message', ['msg' => trans('admin.category.del_success'), 'status' => 'success']);
    }

    public function del_used($coupon_id){
    	$coupon = CouponDetail::where('coupon_id',$coupon_id)->where('status','LIKE','used')->delete();
    	if(!$coupon) return redirect()->back()->with('message', ['msg' => trans('admin.coupon.del_danger'), 'status' => 'danger']);

    	return redirect()->back()->with('message', ['msg' => trans('admin.category.del_success'), 'status' => 'success']);
    }
}
