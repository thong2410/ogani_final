<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlogComment;

class CommentController extends Controller
{
    public function show(Request $request, $id)
    {
        $comments = BlogComment::Where('post_id', $id)->orderBy('created_at','DESC');

        if(!$comments) abort(404);

        if ($request->has('keyword') && !empty($request->keyword)) {
            $comments = $comments->Where('message', 'LIKE', '%'.$request->keyword.'%');
        }

        $comments = $comments->paginate(config('app.paginate'));

        $this->data['comments'] = $comments;
        $this->data['input'] = $request->all();

        return view('admin.blog.list-comment', $this->data);
    }

    public function destroy($id)
    {
        $review = BlogComment::destroy($id);
        if(!$review) return redirect()->back()->with('message', ['msg' => trans('admin.comment.not_found'), 'status' => 'danger']);

        return redirect()->back()->with('message', ['msg' => trans('admin.comment.del_success'), 'status' => 'success']);
    }
}
