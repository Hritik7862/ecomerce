<?php

namespace App\Models;
// use App\Models\Item;
 use App\Models\Cart;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carts extends Model
{
    use HasFactory;

    // public function cart(){
    //     return $this->belongsTo(Item::class,'carts_id','id');
    // }

    public function items(){
        return $this->belongsTo(Item::class,'item_id');
    }

    // public function itemdata(){
    //     return $this->hasOne(Item::class,'item_id');
    // }
}



// $items = Item::join('carts', 'items.id', '=', 'carts.item_id')
//     ->select('items.itemName', 'carts.carts_quantity as itemQuantity', 'items.itemType', 'carts.carts_image as itemImage', 'items.SellingPrice', 'carts.carts_price')
//     ->get();
