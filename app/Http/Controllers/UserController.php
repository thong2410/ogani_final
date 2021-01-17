<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Address;
use App\Order;
use App\OrderDetail;
use App\Coupon;
use App\CouponDetail;
use Carbon\Carbon;
use Auth;
use Validator;
use App\Http\Requests\ChangePassword;
use App\Http\Requests\UpdateInfo;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $data = [];

    public function index(){
        return view('user.dashboard');
    }

    public function getUserAddress(Request $request){
        $getAddress = Auth::user()->address()->find($request->address_id);
        $arrRes = [];
        $arrRes['full_name'] = $getAddress->full_name;
        $arrRes['phone_number'] = $getAddress->phone_number;
        $arrRes['order_email'] = $getAddress->order_email;
        $arrRes['order_address2'] = $getAddress->order_address2;
        $address = explode(",", $getAddress->order_address);

        $city_id = Province::where('name_with_type', '=', trim($address[2]))->first();

        $district_id = District::where('name_with_type', '=', trim($address[1]))
                                ->where('parent_code', '=', $city_id->id)
                                ->first();

        $ward_id = Ward::where('name_with_type', '=', trim($address[0]))
                ->where('parent_code', '=', $district_id->id)
                ->first();

        $arrRes['city_id'] = $city_id->id;
        $arrRes['district_id'] = $district_id->id;
        $arrRes['ward_id'] = $ward_id->id;

        $arrRes['city'] = trim($address[2]);
        $arrRes['district'] = trim($address[1]);
        $arrRes['ward'] = trim($address[0]);
        
        return response()->json(['success' => $arrRes]);
    }

    public function wishlist(){
        $this->data['list'] = Auth::user()->wished()->paginate(config('app.paginate_shop'));

        return view('user.wishlist', $this->data);
    }

    public function coupon(Request $request){
        $check = CouponDetail::where('code', $request->code)->first();
        if(!$check) return response()->json(array('status' => 'warning', 'msg' => trans('main.coupon.notFoundCoupon')));
        if($check->status == 'used') return response()->json(array('status' => 'warning', 'msg' => trans('main.coupon.couponUsed')));

        $couponEvent = $check->coupon()->first();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        if($today > $couponEvent->end_date) return response()->json(array('status' => 'warning', 'msg' => trans('main.coupon.couponExpired')));

        $coupon = session()->has('checkCoupon') ? session()->get('checkCoupon') : array();
        $coupon[$check->id] = $couponEvent;
        session()->put('checkCoupon', $coupon);
        return response()->json(array('status' => 'success', 'msg' => trans('main.coupon.checkSuccess')));
    }

    public function cart(Request $request){
        $this->data['list'] = (array)session()->get('cart');

        $total_price = 0;
        foreach ($this->data['list'] as $key => $value) {
            $total_price = $total_price + ($value['price'] * $value['quantity']);
        }
        $total_price_copy = $total_price;

        if(session()->has('checkCoupon')){
            $data = session()->get('checkCoupon');
            foreach ($data as $key => $coupon) {
                if ($coupon->type == 'money') {
                    $total_price = $total_price - $coupon->coupon_value;
                }else{
                    $total_price = $total_price - $total_price_copy * ($coupon->coupon_value/100);
                }
            }
            if($total_price < 0) $total_price = 0;
        }

        $this->data['total_price'] = $total_price;
        session()->put('total_price', $total_price);

        return view('user.cart', $this->data);
    }

    public function checkout(){
        $this->data['list'] = (array)session()->get('cart');
        $this->data['cities'] = Province::orderBy('type')->get();
        $this->data['address'] = Auth::user()->address()->get();
        $this->data['total_price'] = session()->get('total_price');
        
        if(count((array)session()->get('cart')) < 1) abort(404);

        return view('user.checkout', $this->data);       
    }

    public function placeOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:30',
            'phoneNumber' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
            'cities' => 'required|numeric',
            'districts' => 'required|numeric',
            'wards' => 'required|numeric',
            'address' => 'required|string',
            'note' => 'sometimes|nullable|string'
        ], [
            'fullName.required' => trans('main.checkout.validation.fullName_required'),
            'phoneNumber.required' => trans('main.checkout.validation.phoneNumber_required'),
            'email.required' => trans('main.checkout.validation.email_required'),
            'cities.required' => trans('main.checkout.validation.cities_required'),
            'districts.required' => trans('main.checkout.validation.districts_required'),
            'wards.required' => trans('main.checkout.validation.wards_required'),
            'address.required' => trans('main.checkout.validation.address_required'),
        ]);

        if ($validator->passes()) {
            $cart = session()->get('cart');
            if (!$cart) {
                abort(404);
            }
            $address = Ward::find($request->wards);
            $user_id = Auth::id();
            $note = !empty($request->note) ? $request->note : '---';

            $total_price = session()->get('total_price');
            $getCouponList = session()->has('checkCoupon') ? session()->get('checkCoupon') : array();
            $couponList = "";
            if(count($getCouponList) > 0){
                foreach ($getCouponList as $key => $value) {
                    CouponDetail::where('id', $key)->update([
                        'status' => 'used',
                        'username' => Auth::user()->username,
                    ]);

                    $couponList .= $value->coupon_value.",";
                }
            }
 
            Order::create([
                'user_id' => $user_id, 
                'full_name' => $request->fullName, 
                'phone_number' => $request->phoneNumber, 
                'order_email' => $request->email, 
                'order_address' => $address->path_with_type, 
                'order_address2' => $request->address, 
                'order_Note' => $note, 
                'order_status' => 'processing',
                'order_type' => 'cod',
                'total_price' => $total_price,
                'coupon' => $couponList,
            ]);

            $lastOrderId = Order::latest()->first()->order_id;
            $data = [
                'full_name' => $request->fullName,
                'order_address' => $address->path_with_type,
                'order_address2' => $request->address, 
                'phone_number' => $request->phoneNumber,
                'order_email' => $request->email,   
                'order_Note' => $note, 
                'cart'=> session()->get('cart'),
                'total_price' => $total_price,
                'couponList' => $couponList
              
            ];

            Mail::send('user.shoppingmail', $data, function ($message) use ($data, $lastOrderId) {
                $message->to($data['order_email'], config('app.app_name'))->subject(trans('main.mail.order_title', ['app_name' => config('app.app_name'), 'id' => $lastOrderId]));
            });

            foreach ($cart as $product_id => $product) { // insert product detail
                OrderDetail::create([
                    'order_id' => $lastOrderId, 
                    'product_id' => $product_id, 
                    'unit_price' => $product['price'], 
                    'quantity' => $product['quantity']
                ]);
            }
            $request->session()->forget('cart'); // reset

            if ($request->saveAddress == 'yes') { // lưu lại địa chỉ
                Address::create([
                    'user_id' => $user_id, 
                    'full_name' => $request->fullName, 
                    'phone_number' => $request->phoneNumber, 
                    'order_email' => $request->email, 
                    'order_address' => $address->path_with_type, 
                    'order_address2' => $request->address
                ]);
              
            }
            if(session()->has('checkCoupon'))
            session()->forget('checkCoupon');
            
            return response()->json(['success'=> trans('main.checkout.place_order_success'), 'url' => route('user.cart.order-completed')]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function orderCompleted() { // thông báo đặt hàng thành công
       
        return view('user.order-completed');
    }

    public function orders(){
        $this->data['orders'] = Auth::user()->orders()->paginate(config('app.paginate_shop'));

        return view('user.orders', $this->data);
    }

    public function orderDetail($id){
        $order = Auth::user()->orders()->find($id);
        if(!Order::find($id)) abort(404);
        $this->data['order'] = $order;

        return view('user.oder-details', $this->data);
    }

    public function password(){
        return view('user.password');
    }

    public function SavePassword(ChangePassword $request){
        $user = Auth::user();
        if(!Hash::check($request->old_password, $user->password)) return redirect()->back()->with('message', ['msg' => trans('main.user_profile.old_password_wrong'), 'status' => 'danger']); 

        $user->password = bcrypt($request->password);
        $user->save();

    	return redirect()->back()->with('message', ['msg' => trans('main.user_profile.change_password_success'), 'status' => 'success']);
    }

    public function edit() {
        return view('user.edit');
    }

    public function update(UpdateInfo $request){
        $user = Auth::user();
        if($request->has('avatar')){ // nếu có avatar
            $file = $request->avatar;
            $img =  time() . $file->getClientOriginalName();
            $file->move('uploads/avatars',$img);
            $avatar = 'uploads/avatars/'.$img;
            $user->avatar = $avatar;
            $user->save();
        }
        $user->update([
            'email' => $request->email,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);       

        return redirect()->back()->with('message', ['msg' => trans('main.user_profile.change_info_success'), 'status' => 'success']);
    }   
}
