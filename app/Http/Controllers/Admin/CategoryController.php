<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCategory;
use App\Http\Controllers\Controller;
use App\Category;

class CategoryController extends Controller
{
    protected $data = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $categories = Category::whereNull('parent_id');
        if ($request->has('keyword') && !empty($request->keyword)) {
            $categories = Category::Where('name', 'LIKE', '%'.$request->keyword.'%');
        }
        $categories = $categories->paginate(config('app.paginate'));
        $this->data['categories'] = $categories;
        $this->data['input'] = $request->all();

        return view('admin.category.index', $this->data);       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {   
        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.create_success'), 'status' => 'success']); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category) return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.not_found'), 'status' => 'danger']);
        $categories = Category::whereNull('parent_id')->get();


        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCategory $request, $id)
    {
        $category = Category::find($id);
        if(!$category) return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.not_found'), 'status' => 'danger']);

        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.edit_success'), 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::destroy($id);
        if(!$category) return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.not_found'), 'status' => 'danger']);

        return redirect()->route('admin.category.index')->with('message', ['msg' => trans('admin.category.del_success'), 'status' => 'success']);
    }
}
