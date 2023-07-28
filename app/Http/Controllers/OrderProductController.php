<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Orders;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = OrderProduct::all()->where('user_id','=',Auth::id());

        // $data = OrderProduct::with(['order','item'])->whereHas('users', function ($query) {
        //     $query->where('user_id', '=',Auth::id());
        // })->get();
        // $order_data = OrderProduct::with('order')->where('users_id',"=",Auth::id())->get();
        // $data = OrderProduct::find(Auth::id())->get();
        // dd($data);
        // $user_data=User::with('getorder')->get();

            // return response(['order_data'=>$data]);
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
        //
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

    // public function getOrders(){
    //     // return "hello";
    //     dd('hello');
    // }
//     public function orderPage(Request $request)
// {
//     $orderData = json_decode($request->input('orderData'));
//     return view('order', compact('orderData'));
// }
// public function orderPage()
// {
//     $orderData = OrderProduct::with('item', 'order')->get();

//     return view('shop.orderview', compact('orderData'));
// }

public function getProduct($id, $orderid){
    // return response()->json([$id,$orderid]);
    $orderId = $orderid;
    $data = OrderProduct::with('item')->where('order_id',$id)->get();
    return response()->json([$data,$orderid]);
    return view ('shop.products',compact('data','orderId',));
} 

}




