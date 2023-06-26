<?php
//use Illuminate\Support\Facades\DB;
// use App\Http\Middleware\Shopmid;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserCustmarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     // return view('login');
// });

Route::get('/', function(){

    return view('auth.login');
})->middleware('checkuser');

Route::resource( '/items', ItemController::class)->middleware('auth');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/user_custmer', [App\http\Controllers\userCustmarController::class , 'store'])->name('userCustmar.store');
Route::get('/register', function () {
    return view('register');
});
//  Route::get('/shop',function(){ return view('shop');
// });
// Route::get('/shop', function () {
//     return view('shop.shop');
// });
//Route::get('/shop', 'ShopController@index')->name('shop.index');
// Route::get('/shop', [App\Http\Controllers\shopController::class,'ShopController'])->name('shop.index');
//Route::post('/login', [UserCustmarController::class, 'login'])->name('shopmid');
// Route::get('/shop', function(){ return view('welcome');});
Route::resource('/shop', ShopController::class)->middleware('auth');
Route::resource('/carts', CartsController::class)->middleware('auth');                                                                      
Route::get('/shop/store/{id}',[CartsController::class,'store'])->middleware('auth');
 Route::get('/buy',[BuyController::class,'index'])->middleware('auth');

// route::post('/shop', function(){ return view('shop.shop');})->middleware('shopmid');
route::get('/item', function(){ return view('items');});    
Route::post('/add-to-cart', 'CartController@addToCart');
Route::get('/cart-details', 'CartController@cartDetails');
// Route::get('/billing',[BillingController::class,'index'])->middleware('auth');
Route::get('/carts/{id}',[CartsController::class,'destroy']);
Route::post('/order',[CartsController::class,'ordersave']);
Route::get('/billing',[CartsController::class,'orderbilling']);

//  Route::post('/update-quantity/{id}', [BuyController::class, 'updateQuantity'])->name('update.quantity');
// Route::put('/updatequantity/{id}', 'CartsController@updateQuantity');
Route::post('/updatequantity/{id}', [CartsController::class,'updateQuantity']);

// Route::post('/billing/{id}', 'CartsController@updateQuantity')->name('billing.updateQuantity');
