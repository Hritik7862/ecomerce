<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Usercustmar;
class Usercustmar extends Model
{
    use HasFactory;
    protected $table='user_custmar';
    protected $fillable = [
        'name',
        'mobilenumber',
        'email',
        'password',
       ' confirm_password',
        'address',
    ];
}
