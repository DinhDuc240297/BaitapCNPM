<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\PromotionPrice;
use App\Product;

class PromotionController extends Controller
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
        $promotions = DB::table('promotion_price')
        ->leftJoin('products', 'promotion_price.product_id', '=', 'products.id')
        ->select('products.name as product_name','promotion_price.*')
        ->paginate(5); 

        return view('system-mgmt/promotion/index', ['promotions' => $promotions]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
         return view('system-mgmt/promotion/create',['products' => $products]);
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
        PromotionPrice::create([
            'product_id' => $request['product_id'],
            'total_sales' => $request['total_sales'],
            'code_sales' => $request['code_sales'],
            'date_start' => $request['date_start'],
            'date_finish' => $request['date_finish'],
            'note' => $request['note']
        ]);

         return redirect()->intended('system-management/promotion');
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
        $promotions = PromotionPrice::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($promotions == null || count($promotions) == 0) {
            return redirect()->intended('/system-management/promotion');
        }

        return view('system-mgmt/promotion/edit', ['promotions' => $promotions]);
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
        $promotions = PromotionPrice::findOrFail($id);
        $input = [
            'product_id' => $request['product_id'],
            'total_sales' => $request['total_sales'],
            'code_sales' => $request['code_sales'],
            'date_start' => $request['date_start'],
            'date_finish' => $request['date_finish'],
            'note' => $request['note']
        ];
        $this->validate($request, [
            'product_id' => 'required',
            'total_sales' => 'required',
            'code_sales' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'note' => 'required'
        ]);
        PromotionPrice::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/promotion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PromotionPrice::where('id', $id)->delete();
        	return redirect()->intended('system-management/promotion');
    }
    public function load($stateId) {
        $promotions = PromotionPrice::where('id', '=', $catesid)->get(['id', 'name']);

        return response()->json($promotions);
    }

    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $promotions = $this->doSearchingQuery($constraints);
       return view('system-mgmt/promotion/index', ['promotions' => $promotions, 'searchingVals' => $constraints]);
    }
    
    private function doSearchingQuery($constraints) {
        $query = PromotionPrice::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(4);
    }

    private function validateInput($request){
        $this->validate($request,[
            'product_id' => 'required',
            'total_sales' => 'required',
            'code_sales' => 'required',
            'date_start' => 'required',
            'date_finish' => 'required',
            'note' => 'required'
        ]);
    }
}
