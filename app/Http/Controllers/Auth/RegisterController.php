<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'required|image',
            'mobilenumber' => 'required|unique:users',
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string|digits:6',
        ]);
    }

    protected function create(array $data)
    {
        $profilePicture = $data['profile_picture'];
        $imageName = time() . '.' . $profilePicture->getClientOriginalExtension();
        $profilePicture->storeAs('public/image', $imageName);
        $isAdmin = isset($data['is_admin']) ? true : false;

        $userdata = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobilenumber' => $data['mobilenumber'],
            'profile_picture' => $imageName,

        ]);

        $address = Address::create([
            'user_id' => $userdata->id,
            'street' => $data['street'],
            'city' => $data['city'],
            'state' => $data['state'],
            'pincode' => $data['pincode'],
            'is_admin' => $isAdmin,
        ]);
                     
        $user_address = User::find($userdata['id']);
        $user_address->current_address=$address['id'];
        $user_address->save();

        return $userdata;
    }

   
}






