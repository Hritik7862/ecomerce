<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function addressSave(Request $request){
    
    
    
    // dd($request->all());
    // $address=new Address;
    // $address->user_id=Auth::id();
    // $address->street=$request->street;
    // $address->state=$request->state;
    // $address->city=$request->city;
    // $address->pincode=$request->pincode;
    // $savedaddress = $address->save();

    
    if(!($request->radiobtn)){

    $info = [
        'user_id'=>Auth::id(),
        'street'=>$request->street,
        'state'=>$request->state,
        'city'=>$request->city,
        'pincode'=>$request->pincode,
    ];
    $address_id = Address::create($info);
    $address_id = $address_id['id'];
}
else{
    $address_id = $request->radiobtn;
}

    $user_id = Auth::id();
    $info = Carts::all()->where('user_id',$user_id);
    
          
        // $address = Address::where('user_id', Auth::id())->first();
           
       
        foreach($info as $value){
            $userId = Auth::id();
            
            $add[]= [
                'user_id'=>$userId,
                'ordername'=>$value->items->itemName,
                'price'=>$value->items->SellingPrice,
                'quantity'=>$value->carts_quantity,
            ];
            //dd($add);
        }

        return view('shop.billing',compact('add','address_id'));

}


     public function index()
    {
        //
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
    {
        
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
}



