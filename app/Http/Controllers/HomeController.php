<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Category;
use App\Review;
use App\contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendmail;

class HomeController extends Controller
{
    protected $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    
    public function index()
    {
        $this->data['featured'] = Product::where('status', '=', 'feature')
                                            ->orderBy('product_id', '', 'desc')
                                            ->limit(6)->get();
        $this->data['deals'] = Product::where('sale', '>=', 50)
                                            ->orderBy('sale', '', 'desc')
                                            ->limit(6)->get();          
        $this->data['sales'] = Product::where('sale', '>', 0)
                                            ->orderByRaw('RAND()')
                                            ->limit(4)->get();                                        
        $this->data['products'] = Product::orderBy('product_id', '', 'desc')->limit(6)->get();

        $this->data['best_seller'] = Product::withCount('orders')
                                            ->orderBy('orders_count', 'desc')
                                            ->limit(6)
                                            ->get();
        $this->data['reviews'] = Review::orderByRaw('RAND()')
                                        ->limit(5)->get();

        $this->data['show_department'] = true;

        return view('home', $this->data);
    }

    // shop page
    public function shop(Request $request, $cid = null){
        $this->data['title'] = trans('main.shop');
        /* phần danh mục */
        if($cid){
            $cate = Category::find($cid);
            if(!$cate) abort(404); // nếu không tồn tại thì trả về 404
            $this->data['title'] = $cate->name;
            $this->data['cid'] = $cate->cate_id;
        }

        /* Phần hiển thị theo session */
        if ($request->session()->has('shop_limit')) 
            $limit = $request->session()->get('shop_limit');
        else 
            $limit = config('app.paginate_shop'); // nếu không thì hiển thị theo mặc định
        
        /* Phần sắp xếp */
        $arrSort = [];
        switch ($request->session()->get('shop_sort')) {
            case 'default':
                $arrSort = ['sortBy' => 'product_id', 'direction' => 'DESC'];
                break;
            case 'a-z':
                $arrSort = ['sortBy' => 'prod_name', 'direction' => 'ASC'];
                break;  
            case 'z-a':
                $arrSort = ['sortBy' => 'prod_name', 'direction' => 'DESC'];
                break;   
            case 'high-to-low-price':
                $arrSort = ['sortBy' => 'unit_price', 'direction' => 'DESC'];
                break;   
            case 'low-to-height-price':
                $arrSort = ['sortBy' => 'unit_price', 'direction' => 'ASC'];
                break;          
            default:
                $arrSort = ['sortBy' => 'product_id', 'direction' => 'DESC'];
                break;
        }
        //$this->data['products'] = Product::orderBy('product_id', '', 'desc')->paginate($limit);

        if($cid && $cate) $qb = Category::find($cid)->products();
        else $qb = Product::query();

        if($cid && $cate) $qb->orWhereIn('cate_id', function ($query) use ($cid) {
            $query->select('cate_id')
                ->from('categories')
                ->where('cate_id', '=', $cid)
            ->orWhere('parent_id', '=', $cid);
        });

           // lọc theo giá
        $this->data['min_price'] = 0;
        $this->data['max_price'] = Product::max('unit_price') + 10000;
        if(isset($_GET['start_price']) && isset($_GET['end_price'])){
            $start_price = $_GET['start_price'];
            $end_price = $_GET['end_price'];

            $this->data['start_price'] = $start_price;
            $this->data['end_price'] = $end_price;
            // $qb->whereBetween('unit_price', [$start_price, $end_price]);
        }

        $qb->orderBy($arrSort['sortBy'], $arrSort['direction']);
        

        /* Truyền data cho view */
        $this->data['products'] = $qb->paginate($limit);
        
        return view('shop', $this->data);
    }

    public function setLimit(Request $request) {
        if(in_array($request->input('limit'), array('12','24')))
            $request->session()->put('shop_limit', $request->input('limit'));

        return redirect()->back();
    }

    public function setSort(Request $request) {
        if(in_array($request->input('sort'), array('default', 'a-z', 'z-a', 'high-to-low-price', 'low-to-height-price')))
            $request->session()->put('shop_sort', $request->input('sort'));

        return redirect()->back();
    }

    public function searchData(Request $request){
        if($request->keyword !="")
        $products = Product::where('prod_name','LIKE','%'.$request->keyword.'%')->orderBy('sale','desc')->paginate(config('app.paginate_shop'));
        $searchComponent = view('subviews.items.show-prod-search',['products' => $products])->render();
        return response()->json(['search_component' => $searchComponent, 'code' => 200]);
    }

    public function search(Request $request){
        if(!$request->keyword || empty($request->keyword)) abort(404);
        $this->data['title'] = trans('main.search_product', ['name' => $request->keyword]);
        $this->data['products'] = Product::where('prod_name', 'like', '%'.$request->keyword.'%')
                                ->orderBy('sale', 'desc')
                                ->paginate(config('app.paginate_shop'));
        $this->data['input'] = $request->all();

        return view('search', $this->data);
    }

    public function contact()
    {
        return view('contact');
    }
      
    public function postcontact(Request $request)
    {
        $db = new contact;
        $db->name =  $request->name;
        $db->email =  $request->email;
        $db->note =  $request->note;
        $db->save();
        return redirect()->back()->with('success', trans('admin.contact.send_success')); 
    }
   

}
