<?php

namespace App\Models;
//use App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable =[
        'id',
        'itemName',
        'itemQuantity',
        'itemType',
        'PurchasingPrice',
        'SellingPrice',
        'itemImage',
        'description',
    ];
    protected $guarded='item_id';
    public function carts(){
        return $this->hasOne(Carts::class);
    }
}
