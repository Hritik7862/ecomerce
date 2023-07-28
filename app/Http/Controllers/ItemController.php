<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;




class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('admin')->only('index');
    }
     public function index(Item $item)
    {   
        //
        // $data = Item::find(10)->carts;  
        // dd($data);
        $data = Item::all();
        // dd($data);
        return view('items.index', compact('data'));
        // dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
       
    //  $item= new Item;
    //  $item->itemname=$request->itemName;
    //  $item->itemQuantity=$request->itemQuantity;
    //  $item->itemType=$request->itemType;
    //  $item->description=$request->description;
    //  $item->itemImage=$request->itemImage;
    //  $item->PurchasingPrice=$request->PurchasingPrice;
    //  $item->SellingPrice=$request->SellingPrice;


   
    // if ($request->hasFile('itemImage')) {
    //     $image = $request->file('itemImage');
    //     $imageName = time() . '.' . $image->getClientOriginalExtension();
    //     $image->storeAs('public/images', $imageName);
    //     $item->itemImage = $imageName;
    // }
     
    //  $item->save();
     
    //  return redirect('items')->with('success', 'Item created successfully.');
 

       
       
    // }
    public function store(Request $request)
{
    $request->validate([
        'itemName' => 'required',
        'itemQuantity' => 'required|integer',
        'itemType' => 'required',
        'itemImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'PurchasingPrice' => 'required|numeric',
        'SellingPrice' => 'required|numeric|min:' . ($request->input('PurchasingPrice') + 0.01),
        'description' => 'required',
    ]);

    $item = new Item;
    $item->itemname = $request->itemName;
    $item->itemQuantity = $request->itemQuantity;
    $item->itemType = $request->itemType;
    $item->description = $request->description;
    $item->PurchasingPrice = $request->PurchasingPrice;
     $item->SellingPrice = $request->SellingPrice;

    if ($request->hasFile('itemImage')) {
        $image = $request->file('itemImage');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $item->itemImage = $imageName;
    }

    $item->save();

    return redirect('/items')->with('success','Item Added Successfully');
    ;
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
        // echo $id;
        $info = Item::find($id);
        // dd($info);
        return view('items.edit',compact('info'));
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
    $request->validate([
        'itemName' => 'required|string|max:255',
        'itemQuantity' => 'required|integer|min:1',
        'itemType' => 'required|string|max:255',
        'PurchasingPrice' => 'required|numeric|min:0',
        'SellingPrice' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:500',
        'itemImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $info = Item::find($id);
    if (!$info) {
        return redirect('/items')->with(['error' => 'Item not found']);
    }

    $info->itemName = $request->itemName;
    $info->itemQuantity = $request->itemQuantity;
    $info->itemType = $request->itemType;
    $info->PurchasingPrice = $request->PurchasingPrice;
    $info->SellingPrice = $request->SellingPrice;
    $info->description = $request->description;

    if ($request->hasFile('itemImage')) {
        if ($info->itemImage) {
            Storage::delete('public/images/' . $info->itemImage);
        }
        $image = $request->file('itemImage');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName);
        $info->itemImage = $imageName;
    }

    $info->save();
    Session::flash('success', 'Item updated successfully.');

    return redirect('/items');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        // dd($id);
            $item = Item::find($id);
            if ($item) {
                if ($item->itemImage) {
                    Storage::delete('public/images/' . $item->itemImage);
                }
                $item->delete();

                return redirect('items');
            } else {
                return redirect('items');
            }
        }
      
    }


