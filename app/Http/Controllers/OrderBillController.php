<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Customer;
use App\Product;

class OrderBillController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('order_bill')
        ->Join('customer', 'order_bill.customer_id', '=', 'customer.id')
        ->Join('products', 'order_bill.product_id', '=', 'products.id')
        ->select('order_bill.id','order_bill.order_name','customer.name as customer_name','products.name as products_name',
    		'order_bill.date_added','order_bill.message')
        ->paginate(5); 

        return view('bill_order/index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('order-bill/create', ['customers' => $customers,'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this-> validateInput($request);
        Order::create([
            'order_name' => $request['order_name'],
            'customer_id' => $request['customer_id'],
            'product_id' => $request['product_id'],
            'date_added' => $request['date_added'],
            'message' => $request['message'],
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $products = Product::findOrFail($id);
        $this->validateInput($request);
        // Upload image
        $keys = ['name','alias','price','unit_product','intro','color','size','keywords','description','user_id','cate_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        Product::where('id', $id)
            ->update($input);

        return redirect()->intended('system-management/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Product::where('id', $id)->delete();
         return redirect()->intended('/system-management/product');
    }

    public function loadCate($cateId) {
        $cates = Cate::where('cate_id', '=', $cateId)->get(['id', 'name']);
        return response()->json($cates);
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name'],
            'price' => $request['price']
            ];
        $products = $this->doSearchingQuery($constraints);
        $constraints['price'] = $request['price'];
        return view('system-mgmt/product/index', ['products' => $products, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('products')
        ->leftJoin('users', 'products.user_id', '=', 'users.id')
        ->leftJoin('cates', 'products.cate_id', '=', 'cates.id')
        ->select('products.*','cates.name as cate_name','users.username as user_name');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(11);
    }

     /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
        $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required',
            'alias' => 'required',
            'price' => 'required|max:60',
            'unit_product' => 'required',
            'intro' => 'required',
            'color' => 'required|max:10',
            'size' => 'required',
            'keywords' => 'required',
            'description' => 'required',
            'picture' => 'required',
            'user_id' => 'required',
            'cate_id' => 'required'
        ]);
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
