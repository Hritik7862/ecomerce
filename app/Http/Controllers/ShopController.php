<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;


use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()  
    {
        // dd('hello');
        // $items = Item::all();
        // return view('shop.shop', compact('items'));
            // Retrieve the items to be displayed on the shop page
            // $items = Item::all();

            // Pass the items to the shop view
            // return view('shop.shop', ['items' => $items]);
            // $items = Item::all(); // Fetch all the items from the database
            // // dd($items);    
           
            // return view('shop.shop', compact('items'));
            
            $items = Item::all();
            return view('shop.shop')->with('items', $items);
            
            
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
        if($request->register){
            //dd($request->all());
        }
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
