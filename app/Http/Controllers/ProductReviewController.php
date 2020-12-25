<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Review;

class ProductReviewController extends Controller
{
    public function addReview(Request $request){
    	$validator = Validator::make($request->all(), [
            'message' => 'required|string:125',
            'star' => 'required|numeric|min:1|max:5',
            'productId' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            if (!Auth::check()) {
                return response()->json(array('status' => 'warning', 'msg' => trans('main.rating.please_login')));
            }else{
                Review::create([
                    'user_id' => Auth::id(), 
                    'product_id' => $request->productId, 
                    'content' => $request->message, 
                    'rating' => $request->star
                    ]);
                return response()->json(array(
                    'status' => 'success', 
                    'msg' => trans('main.rating.review_success'),
                    'review' => array(
                        'avatar' => Auth::user()->avatar,
                        'name' => Auth::user()->fullname,
                        'content' => $request->message,
                        'rating' => $request->star,
                        'now' => trans('main.rating.now')
                    ),
                ));
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
