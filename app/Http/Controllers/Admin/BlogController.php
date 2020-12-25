<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePost;
use App\BlogPost;
use App\Http\Requests\EditPost;
use App\BlogCategory;
class BlogController extends Controller
{
    protected $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = BlogPost::orderBy('post_id','DESC');
        if ($request->has('keyword') && !empty($request->keyword)) {
            $categories = $posts->Where('post_title', 'LIKE', '%'.$request->keyword.'%');
        }       
        $posts = $posts->paginate(config('app.paginate'));
        $this->data['input'] = $request->all();
        $this->data['posts'] = $posts;

        return view('admin.blog.index', $this->data);  
    }

    public function create()
    {
        $this->data['categories'] = BlogCategory::whereNull('parent_id')->get();
        
        return view('admin.blog.create', $this->data); 
    }

    public function store(CreatePost $request)
    {   
        BlogPost::create([
            'cate_id' => $request->cate_id,
            'thumb_id' => $request->thumb_id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
        ]);

        return redirect()->route('admin.blog.index')->with('message', ['msg' => trans('admin.blog.success_msg'), 'status' => 'success']); 
    }

    public function edit($id)
    {
        if(!BlogPost::find($id)) abort(404);
        $this->data['post'] = BlogPost::find($id);
        $this->data['categories'] = BlogCategory::whereNull('parent_id')->get();;
        return view('admin.blog.edit', $this->data);
    }

    public function update(EditPost $request, $id)
    {
        $post = BlogPost::find($id);
        if(!$post) return redirect()->route('admin.post.index')->with('message', ['msg' => trans('admin.blog.not_found'), 'status' => 'danger']);

        $post->update([
            'cate_id' => $request->cate_id,
            'thumb_id' => $request->thumb_id,
            'post_title' => $request->title,
            'post_content' => $request->content,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'seo_keywords' => $request->seo_keywords,
        ]);
        
        return redirect()->route('admin.blog.index')->with('message', ['msg' => trans('admin.blog.edit_success'), 'status' => 'success']);
    }

    public function destroy($id)
    {
        $post = BlogPost::destroy($id);
        if(!$post) return redirect()->route('admin.blog.index')->with('message', ['msg' => trans('admin.blog.not_found'), 'status' => 'danger']);

        return redirect()->route('admin.blog.index')->with('message', ['msg' => trans('admin.blog.del_success'), 'status' => 'success']);
    }
}
