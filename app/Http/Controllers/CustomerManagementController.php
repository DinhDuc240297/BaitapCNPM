<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;
use App\Province;
use App\Customer;
use Auth;
use Validator;

class CustomerManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $guard;
    public function __construct()
    {
        $this->guard = Auth::guard('customer');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSignup(){
        return view('fontend.user.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request,[
            'username' => 'required|max:100',
            'email' => 'required',
            'password' => 'required'
        ]);
        Customer::create([
            'username' => $request['username'],
            'fullname' => $request['fullname'],
            'email' => $request['email'],
            'password' =>bcrypt($request['password']),
            'sex' => $request[''],
            'mobile' => $request[''],
            'address' => $request[''],
            'province_id' => 1,
            'avatar' => $request[''],
        ]);

        return redirect()->route('home.index');
    }
    public function getSignin(){
        return view('fontend/user/signin');
    }
     public function postSignin(Request $request){
        Customer::all();
        $rules = [
            'email' =>'required',
            'password' => 'required|min:8'
        ];
        $messages = [
            'email' => 'Username invalidate !',
            'password.required' => 'Enter your password',
            'password.min' => 'Password must be 8 characters long!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                return redirect()->route('user.profile');
            } else {
                $errors = new MessageBag(['errorlogin' => 'Login fail!!']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

    public function getProfile(){
        return view('fontend/user/profile');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home.index');
    }

    public function index()
    {
        $customers = DB::table('customer')
        ->leftJoin('province', 'customer.province_id', '=', 'province.id')
        ->select('customer.id','customer.username','customer.fullname','customer.email','customer.sex','customer.mobile','customer.address', 'province.province_name as province_name')
        ->paginate(8); 

        return view('customer-mgmt/index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('customer-mgmt/create', ['provinces' => $provinces]);
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
        $path = $request->file('picture')->store('avatars');
        $keys = ['username', 'fullname', 'email', 'password', 'sex', 'mobile', 'address', 'province_id'];
        $input = $this->createQueryInput($keys, $request);
        $input['avatar'] = $path;
        // Not implement yet
        // $input['company_id'] = 0;
        Customer::create($input);

        return redirect()->intended('/customer-management');
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
        $customers = Customer::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($customers == null || count($customers) == 0) {
            return redirect()->intended('/customer-management');
        }

        $provinces = Province::all();
        return view('customer-mgmt/edit', ['customers' => $customers, 'provinces' => $provinces]);
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
        $customers = Customer::findOrFail($id);
        $this->validateInput($request);
        // Upload image
       $keys = ['username', 'fullname', 'email', 'password', 'sex', 'mobile', 'address', 'province_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['avatar'] = $path;
        }

        Customer::where('id', $id)
            ->update($input);

        return redirect()->intended('/customer-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Customer::where('id', $id)->delete();
         return redirect()->intended('/customer-management');
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'username' => $request['username'],
            'email' => $request['email']
            ];
        $customers = $this->doSearchingQuery($constraints);
        $constraints['email'] = $request['email'];
        return view('customer-mgmt/index', ['customers' => $customers, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('customer')
        ->leftJoin('province', 'customer.province_id', '=', 'province.id')
        ->select('customer.username as user_name', 'customer.*');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(8);
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
            'username' => 'required',
            'fullname' => 'required|max:60',
            'email' => 'required',
            'sex' => 'required|max:20',
            'mobile' => 'required|max:60',
            'adress' => 'required',
            'province_id' => 'required',
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
