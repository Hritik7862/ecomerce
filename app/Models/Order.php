<?php
namespace App\Models;

use App\Models\Address;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'user_id', 'total_payment', 'date_of_order', 'total_items', 'address_id'];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

  
    protected static function RandomNumber()
    {
        $number = Str::random(8); 

        while (static::where('order_number', $number)->exists()) {
            $number = Str::random(); 
        }

        return $number;
    }

      
}
