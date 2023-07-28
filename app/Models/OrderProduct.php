<?php
namespace App\Models;
    
use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = ['order_id','product_id', 'per_price', 'total_price','address_id'];

    public function order()
    {
        return $this->belongsTo(Orders::class,'order_id','id');
        // return $this->hasOne(Order::class,'order_id','id');
    }

    public function users() 
    {
        return $this->belongsTo(User::class,'user_id','id');
        // return $this->hasOne(Order::class,'order_id','id');
    }
    public function item()
    {
        // return $this->belongsTo(Item::class,'product_id','id');
//return $this->hasOne(Item::class,'product_id','id');
      return $this-> belongsTo(Item::class, 'product_id', 'id');
    }


}
