<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\User;
use App\Product;
use App\Cate;


class ProductController extends Controller
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
        $products = DB::table('products')
        ->Join('users', 'products.user_id', '=', 'users.id')
        ->Join('cates', 'products.cate_id', '=', 'cates.id')
        ->select('products.id','products.picture','products.name','cates.name as cate_name','products.intro',
    		'products.color','products.size','products.quantity','products.description','products.status','users.username as user_name')
        ->paginate(11); 

        return view('system-mgmt/product/index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $cates = Cate::all();
        return view('system-mgmt/product/create', ['users' => $users,'cates' => $cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validateInput($request);
        // Upload image
        $file_name=$request->file('picture')->getClientOriginalName();
        $keys = ['name','alias_keyword','price','unit_product','intro','color','size','quantity','description','status','user_id','cate_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['picture'] = $file_name;

        Product::create($input);

        return redirect()->intended('system-management/product');

        
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
        $products = Product::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($products == null || count($products) == 0) {
            return redirect()->intended('system-management/product');
        }
        $users = User::all();
        $cates = Cate::all();
        return view('system-mgmt/product/edit', ['products' => $products, 'users' => $users, 'cates' => $cates]);
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
       $keys = ['name','alias_keyword','price','unit_product','intro','color','size','quantity','description','status','user_id','cate_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $file_name=$request->file('picture')->getClientOriginalName();
            $input['picture'] = $file_name;
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
            'alias_keyword' => 'required',
            'price' => 'required|max:60',
            'unit_product' => 'required',

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
