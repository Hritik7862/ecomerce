<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Orders;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(Request $request, $id)
    {
        // dd($info);
        $data = Item::find($id);
        $carts_data = Item::find($id)->carts;

        $user_id = Auth::id();

        $condition = [
            ['item_id', '=', $id],
            ['user_id', '=', $user_id]
        ];

        $exists = Carts::where($condition)->exists();

        if($exists){    
            session()->flash('alert', 'This Item already exists');
            return redirect('/shop');
        }

        $carts =new Carts;                                                                      
        $carts->item_id = $data->id;
        $carts->carts_quantity = 1;
        $carts->carts_price = $data->SellingPrice;
        $carts->carts_image = $data->itemImage;
        $carts->user_id = Auth::id();
        $carts->save();
        return redirect('/shop')->with('success_message', 'Item Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function show(Carts $carts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function edit(Carts $carts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carts $carts)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carts  $carts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carts $carts,$id)
    {
        // echo $id;
        Carts::destroy($id);
        return redirect('/buy');
    }
    public function orderbilling(Request $request,$address_id){
        // dd($request->all());
        if(isset($request->radiobtn)){
            // $order=Order::fin
        }
        //dd($request->all());
        $user_id = Auth::id();
        $info = Carts::all()->where('user_id',$user_id);

          

       
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

    // public function ordersave(Request $request){
    //     //dd($request->all());
    //     $info = Carts::all();
    //      //dd($request->all());


    //     foreach($info as $value){
    //         $userId = Auth::id();
    //         // dd($userId);
    //         $add[]= [
    //             'user_id'=>$userId,
    //             'ordername'=>$value->items->itemName,
    //             'price'=>$value->items->SellingPrice,
    //             'quantity'=>$value->carts_quantity,
    //             // 'quantity'=>$value->carts_quantity,s
    //             //'totalprice'=>$value-> 	totalprice,
    //             'totalprice' => $totalPrice,
    //         ];
    //     }
    //     Orders::insert($add);
    // }
    public function ordersave(Request $request,$address)
    {
        $userId = Auth::id();
        $info = Carts::where('user_id', $userId)->get();
        $totalOrderPrice = 0;
        $add = [];
    
        foreach ($info as $value) {
            $datainfo = $value->items;
            $datainfo->itemQuantity = $datainfo->itemQuantity - $value->carts_quantity;
            $datainfo->save();
    
            $totalPrice = $value->items->SellingPrice * $value->carts_quantity;
    
            $add[] = [
                'user_id' => $userId,
                'ordername' => $value->items->itemName, 
                'price' => $value->items->SellingPrice,
                'quantity' => $value->carts_quantity,
                'totalprice' => $totalPrice,
            ];
            $totalOrderPrice += $totalPrice;
        }
    
        $orderData = [
            'order_number' => Order::randomNumber(),
            'user_id' => $userId,
            'total_payment' => $totalOrderPrice,
            'total_items' => count($add),
            'address_id'=>$address 
        ];
        // Orders::insert($add);
        $insertedOrderData = Order::create($orderData);
    
        $orderProductData = [];
        foreach ($info as $key => $value) {
            $orderProductData[] = [
                'order_id' => $insertedOrderData->id,
                'product_id' => $value->item_id,
                'per_price' => $value->carts_price,
                'total_price' => $value->carts_price * $value->carts_quantity,
                'number_of_products' => $value->carts_quantity,
                'user_id'=>Auth::id()
            ];
        }
    
        OrderProduct::insert($orderProductData);
    
        $cards = Carts::where('user_id', $userId);
        $cards->delete();
        return redirect('/thankyou');
    }
    
    public function updateQuantity(Request $request)
    {
        $id = $_GET['id'];
        $quantity = $_GET['quantity'];
        
        $cards=Carts::find($id);
        $cards->carts_quantity=$quantity;
        $cards->save();
       

}

function thankyou(){
    return view('shop.order');
}
}





