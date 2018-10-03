<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Cate;

class ProductTypeController extends Controller
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
        $cates = Cate::paginate(4);

        return view('system-mgmt/product-type/index',['cates' => $cates]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('system-mgmt/product-type/create');
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
        Cate::create([
            'name' => $request['name'],
            'alias' => $request['name'],
            'order' => $request['order'],
            'keywords' => $request['keywords'],
            'description' => $request['description'],
            'status' => $request['status'],
        ]);

         return redirect()->intended('system-management/product-type');
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
        $cates = Cate::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($cates == null || count($cates) == 0) {
            return redirect()->intended('/system-management/product-type');
        }

        return view('system-mgmt/product-type/edit', ['cates' => $cates]);
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
        $cates = Cate::findOrFail($id);
        $input = [
            'name' => $request['name'],
            'alias' => $request['name'],
            'order' => $request['order'],
            'keywords' => $request['keywords'],
            'description' => $request['description'],
        ];
        $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        Cate::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/product-type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cate::where('id', $id)->delete();
        	return redirect()->intended('system-management/product-type');
    }
    public function load($stateId) {
        $cates = Cate::where('id', '=', $catesid)->get(['id', 'name']);

        return response()->json($cates);
    }

    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $cates = $this->doSearchingQuery($constraints);
       return view('system-mgmt/product-type/index', ['cates' => $cates, 'searchingVals' => $constraints]);
    }
    
    private function doSearchingQuery($constraints) {
        $query = Cate::query();
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
            'name' => 'required',
            'order' => 'required',
            'keywords' => 'required',
            'description' => 'required'

        ]);
    }
}
