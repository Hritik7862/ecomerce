<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Carts;
use App\Models\Orders;
use Illuminate\Http\Request;
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
        $exists = Carts::where('item_id', $id)->exists();

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
        return redirect('/shop');
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

    public function orderbilling(Request $request){
        //dd($request->all());
        $info = Carts::all();


       
        foreach($info as $value){
            $userId = Auth::id();
            
            $add[]= [
                'user_id'=>$userId,
                'ordername'=>$value->items->itemName,
                'price'=>$value->items->SellingPrice,
                'quantity'=>$value->carts_quantity,
            ];
            // dd($add);
        }
        return view('shop.billing',compact('add'));
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
    public function ordersave(Request $request)
    {
        $info = Carts::all();
        
        foreach($info as $key => $val){
            
        $datainfo = Carts::find($val->id)->items;
        $datainfo->itemQuantity = $datainfo->itemQuantity - $val->carts_quantity;
        $datainfo->save();
        // $datainfo = carts::find($val->id)->items;
        // $datainfo-> itemQuantity = $datainfo ->itemQuantity - $val -> carts_quantity;
        // $datainfo ->save();
    }

        $userId = Auth::id();
        $add = [];
    // $order = $request-> all();
        foreach ($info as $value) {
            $totalPrice = $value->items->SellingPrice * $value->carts_quantity;
    
            $add[] = [
                'user_id' => $userId,
                'ordername' => $value->items->itemName,
                'price' => $value->items->SellingPrice,
                'quantity' => $value->carts_quantity,
                'totalprice' => $totalPrice,
                
            ];

        }
    
        Orders::insert($add);
        // Carts::d
        // $cardsss=Carts::where('user_id','=',$userId);
        // $cardsss->delete();
        // return view('shop.order',compact('add'));
        $cardss=Carts::where('user_id','=',$userId);
        $cardss->delete();
        return view('shop.order',compact('add'));


        // Clear the cart after placing the order
        Carts::truncate();  
    
        //return redirect('/buy');
    }
    
    public function updateQuantity(Request $request, $id)
    {
        // return response()->json($request->quantity);
        

        $cards=Carts::find($request->id);
        $cards->carts_quantity=$request->quantity;
        $cards->save();
       

}
}
