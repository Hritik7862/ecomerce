<?php




namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Carts;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;


class ShopController extends Controller
{
    public function index()  
    {
      
        $items = Item::all();
        $totalItems = Carts::all()->where('user_id', Auth::id());
        return view('shop.shop', compact('totalItems'))->with('items', $items);
            
            
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
    
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Perform the search query on your 'items' table using the 'itemName' field.
    //     $items = Item::where('itemName', 'LIKE', '%' . $query . '%')->get();

    //     return response()->json($items);
    // }
    }






