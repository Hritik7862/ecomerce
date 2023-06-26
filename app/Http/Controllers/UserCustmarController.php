<?php

namespace App\Http\Controllers;
//use App\Models\Usercustmar;

use App\Models\Item;
use App\Models\Usercustmar;
//use App\Models\Usercustmar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCustmarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        // $items = UserCustmar::all();
        // return view('view.welcome', compact('user_custmar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // public function store(Request $request)
    {
        //dd($request->all());
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:user_custmar,email',
            'password' => 'required|min:6|confirmed',
            'address' => 'required',
        ], [
            'email.unique' => 'The email has already been taken.',
            'password.confirmed' => 'The password confirmation does not match.',

            ]);
            
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Create a new user_custmar record
        $userCustmar = new Usercustmar();
        $userCustmar->name = $request->name;
        $userCustmar->mobilenumber = $request->mobile;
        $userCustmar->email = $request->email;
        $userCustmar->password = Hash::make($request->password);
        $userCustmar->confirm_password = Hash::make($request->password_confirmation);
        $userCustmar->address = $request->address;
        $userCustmar->save();
         //dd($userCustmar);

        // Return a response or redirect as needed
        return redirect('/shop');

    }
    
        
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);
    // dd($request->input('email'));

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $email = $request->input('email');
    $password = $request->input('password');

    // Retrieve the user based on the email
    $user = Usercustmar::where('email', $email)->first();

    if (!$user) {
        // User not found
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    if (Hash::check($password, $user->password)) {
        // Password matches, user is authenticated
        // You can store user data in session or perform any other necessary actions
        // $items = Item::all(); 
        if($user->name && $user->password){
            $items =    Item::all();
            return view('shop.shop', compact('items'));
     }
        // return redirect('/shop');
    } else {
        // Password does not match
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}

}
