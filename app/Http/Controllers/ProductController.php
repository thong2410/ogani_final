<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $data = [];

    public function show($id) { // hien thi thong tin san pham
        $prod = Product::find($id);
        if(!$prod) abort(404);

        
        $this->data['prod'] = $prod;
        $this->data['reviews'] = $prod->reviews;

        return view('product.detail', $this->data);
    }
    
    public function quickView(Request $request){
        $prod = Product::find($request->input('pid'));
        if(!$prod) abort(404);
        $this->data['prod'] = $prod;

        return view('product.quick-view', $this->data);
    }

    public function addToCart(Request $request){
        $id = $request->pid;
        $today= Carbon::now('Asia/Ho_Chi_Minh');
        $quantity = (int)$request->quantity;
        if($quantity < 1) $quantity = 1;

        $product = Product::find($id);
        if(!$product) {
            return response()->json(array('status' => 'error', 'msg' => trans('main.cart.product_does_not_exist'), 'count' => count((array)session('cart'))));
        }
        $cart = session()->get('cart');
        // neu het hang || so luong chon lon hon so luong san pham
        if($product->quantity < 1 || $product->quantity < $quantity) {
            return response()->json(array('status' => 'error', 'msg' => trans('main.cart.not_enough_quantity', ['name' => $product->prod_name]), 'count' => count((array)session('cart'))));
        }
        // neu chua co
        if(!$cart) {
            $cart = [
                    $id => [
                        "name" => $product->prod_name,
                        "unit" => $product->unit,
                        "quantity" => $quantity,
                        "price" => $product->unit_price - $product->unit_price * ($product->sale / 100),
                        "photo" => $product->thumb->path .'/'. $product->thumb->name
                    ]
            ];
            session()->put('cart', $cart);
            return response()->json(array('status' => 'success', 'msg' => trans('main.cart.add_success'), 'count' => count((array)session('cart'))));
        }
        // neu co thi cong them quantity
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
            session()->put('cart', $cart);
            return response()->json(array('status' => 'success', 'msg' => trans('main.cart.add_success'), 'count' => count((array)session('cart'))));
        }
        if ($product->hsd<$today){
            return response()->json(array('status' => 'error', 'msg' => trans('main.cart.hsd', ['name' => $product->hsd])));
        }
        // neu khong co thi add , default quantity = 1
        $cart[$id] = [
            "name" => $product->prod_name,
            "unit" => $product->unit,
            "quantity" => $quantity,
            "price" => $product->unit_price - $product->unit_price * ($product->sale / 100),
            "photo" => $product->thumb->path .'/'. $product->thumb->name
        ];
        session()->put('cart', $cart);
        return response()->json(array('status' => 'success', 'msg' => trans('main.cart.add_success'), 'count' => count((array)session('cart'))));

    }

    public function updateCart(Request $request)
    {
        if($request->c_id and $request->quantity)
        {
            $cart = session()->get('cart');
            foreach($request->c_id as $key => $id){
                $product = Product::find($id);
                if($product->quantity < 1 || $product->quantity < $request->quantity[$key]) { //check số lượng trong kho
                    return response()->json(array('status' => 'error', 'msg' => trans('main.cart.not_enough_quantity', ['name' => $product->prod_name]), 'count' => count((array)session('cart'))));
                }else{ // nếu đủ số lượng trong kho thì mới cập nhật
                    if ($request->quantity[$key] > 0) {
                        $cart[$id]["quantity"] = $request->quantity[$key];
                    }
                    $cart[$id]["price"] = $product->unit_price - $product->unit_price * ($product->sale / 100); // cập nhật lại giá tiền
                }
            }
            session()->put('cart', $cart);

            return response()->json(array('status' => 'success', 'msg' => trans('main.cart.update_success'), 'count' => count((array)session()->get('cart'))));
        }
    }
    public function removeCartItem(Request $request)
    {
        if($request->cart_id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->cart_id])) {
                unset($cart[$request->cart_id]);
                session()->put('cart', $cart);
            }
            return response()->json(array('status' => 'success', 'msg' => trans('main.cart.remove_success'), 'count' => count((array)session()->get('cart'))));
        }
    }

}
