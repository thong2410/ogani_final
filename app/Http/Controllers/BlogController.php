<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\BlogCategory;
use App\BlogComment;
use Illuminate\Support\Facades\Validator;
use Auth;

class BlogController extends Controller
{
    protected $data = [];

    public function index($cid = null, Request $request) {
        $this->data['title'] = trans('main.blog');
        $this->data['suggest'] = BlogPost::orderByRaw('RAND()')->limit(4)->get();

        $posts = BlogPost::orderBy('post_id','DESC');

        if($cid){
            $cate = BlogCategory::find($cid);
            if(!$cate) abort(404); // nếu không tồn tại thì trả về 404
            $this->data['title'] = $cate->name;
            $this->data['cid'] = $cate->cate_id;
            $posts = BlogCategory::find($cid)->posts()->orderBy('post_id','DESC');
        }

        if ($request->has('keyword') && !empty($request->keyword)) {
            $categories = $posts->Where('post_title', 'LIKE', '%'.$request->keyword.'%');
            $this->data['title'] = trans('main.post.search_for', ['name' => $request->keyword]);
        }       
        $posts = $posts->paginate(config('app.paginate'));
        $this->data['input'] = $request->all();
        $this->data['posts'] = $posts;
        $this->data['categories'] = BlogCategory::whereNull('parent_id')->get();

        return view('blog.index', $this->data);
    }

    public function show($id){
        $post = BlogPost::find($id);
        if(!$post) abort(404); // nếu không tồn tại thì trả về 404
        $this->data['post'] = $post;
        $this->data['suggest'] = BlogPost::orderByRaw('RAND()')->limit(4)->get();
        $this->data['categories'] = BlogCategory::whereNull('parent_id')->get();
        $this->data['comments'] = $post->comments;

        return view('blog.post', $this->data);
    }

    public function addComment(Request $request) {
    	$validator = Validator::make($request->all(), [
            'messages' => 'required|string:125',
            'postId' => 'required|numeric'
        ]);

        if ($validator->passes()) {
            if (!Auth::check()) {
                return response()->json(array('status' => 'warning', 'msg' => trans('main.post.please_login')));
            }else{
                BlogComment::create([
                    'user_id' => Auth::id(), 
                    'post_id' => $request->postId, 
                    'message' => $request->messages, 
                    ]);

                return response()->json(array(
                    'status' => 'success', 
                    'msg' => trans('main.post.comment_success'),
                    'comment' => array(
                        'avatar' => Auth::user()->avatar,
                        'name' => Auth::user()->fullname,
                        'message' => $request->messages,
                        'now' => trans('main.post.now')
                    ),
                ));
            }
        }

        return response()->json(['error'=>$validator->errors()->all()]);        
    }

}
