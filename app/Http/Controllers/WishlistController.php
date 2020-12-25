<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\WishList;
use Auth;

class WishlistController extends Controller
{
    public function addToWishList(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!Auth::check()) {
            return response()->json([
                'msg' => trans('main.wishlist.login_msg'),
                'status' => 'warning',
            ]);
        } elseif ($product) { // exist
            $checked = WishList::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

            if (!$checked) { // add
                return $this->add($request->product_id);
            } else { // remove
                return $this->remove($checked->wish_id);
            }
        } else {
            return response()->json([
                'msg' => trans('main.wishlist.product_does_not_exist'),
                'status' => 'error',
            ]);
        }
    }

    public function add($pid)
    {
        WishList::create([
                'product_id' => $pid,
                'quantity' => 1,
                'user_id' => Auth::id()
                ]);

        return response()->json([
                    'msg' => trans('main.wishlist.add_success'),
                    'status' => 'success',
                    'action' => 'add',
                    'count' => count(Auth::user()->wished)
                ]);
    }
    
    public function remove($wish_id)
    {
        WishList::find($wish_id)->delete();

        return response()->json([
                    'msg' => trans('main.wishlist.remove_success'),
                    'status' => 'success',
                    'action' => 'remove',
                    'count' => count(Auth::user()->wished)
                ]);
    }
}
