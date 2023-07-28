<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    
    protected $table='addresses';
    protected $fillable = ['user_id', 'street', 'city', 'state', 'pincode','id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
//     public function address()
// {
//     return $this->belongsTo(Address::class);
// }
}









