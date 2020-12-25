<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;

class RatingController extends Controller
{
    public function show(Request $request, $id)
    {
        $ratings = Review::Where('product_id', $id)->orderBy('created_at','DESC');
        if(!$ratings) abort(404);

        if ($request->has('keyword') && !empty($request->keyword)) {
            $ratings = $ratings->Where('content', 'LIKE', '%'.$request->keyword.'%');
        }

        if ($request->has('rating') && !empty($request->rating)) {
            $ratings = $ratings->Where('rating', '=', ''.$request->rating.'');
        }

        $ratings = $ratings->paginate(config('app.paginate'));

        $this->data['ratings'] = $ratings;
        $this->data['input'] = $request->all();

        return view('admin.rating.list', $this->data);
    }

    public function destroy($id)
    {
        $review = Review::destroy($id);
        if(!$review) return redirect()->back()->with('message', ['msg' => trans('admin.rating.not_found'), 'status' => 'danger']);

        return redirect()->back()->with('message', ['msg' => trans('admin.rating.del_success'), 'status' => 'success']);
    }

}
