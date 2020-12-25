<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Media;
use App\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProduct;

class ProductController extends Controller
{
    protected $data = [];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('product_id','DESC');
        if ($request->has('keyword') && !empty($request->keyword)) {
            $products = $products->Where('prod_name', 'LIKE', '%'.$request->keyword.'%');
        }
        $products = $products->paginate(config('app.paginate'));

        $this->data['products'] = $products;
        $this->data['input'] = $request->all();

        return view('admin.product.index', $this->data);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] = Category::all();
        
        return view('admin.product.create', $this->data);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'prod_name' => 'required|string|max:150',
            'unit_price' => 'required|numeric',
            'sale' => 'required|numeric|min:0|max:100',
            'cate_id' => 'required|numeric',
            'status' => 'required|string',
            'content' => 'required|string',
            'detail' => 'required|string',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'thumb_id' => 'required|numeric',
        ]);


        if ($validator->passes()) {
            Product::create($request->all());

			return response()->json(['success'=> trans('admin.product.create_success')]);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Product::find($id)) abort(404);
        $this->data['categories'] = Category::all();
        $this->data['product'] = Product::find($id);
        
        return view('admin.product.edit', $this->data);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$validator = Validator::make($request->all(), [
            'prod_name' => 'required|string|max:150',
            'unit_price' => 'required|numeric',
            'sale' => 'required|numeric|min:0|max:100',
            'cate_id' => 'required|numeric',
            'status' => 'required|string',
            'content' => 'required|string',
            'detail' => 'required|string',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'seo_keywords' => 'required|string',
            'thumb_id' => 'required|numeric',
        ]);


        if ($validator->passes()) {
            Product::find($id)->update($request->all());
			return response()->json(['success'=> trans('admin.product.update_success')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);
        if(!$product) return redirect()->route('admin.product.index')->with('message', ['msg' => trans('admin.product.not_found'), 'status' => 'danger']);

        return redirect()->route('admin.product.index')->with('message', ['msg' => trans('admin.product.del_success'), 'status' => 'success']);
    }
}
