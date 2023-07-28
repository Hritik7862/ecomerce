<?php

use App\Http\Middleware\Shopmid;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\UserIsAdmin;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\CheckUserIsNotAdmin;
use App\Http\Controllers\AddressesController;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Controllers\UserCustmarController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\Auth\RegisterController;

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




Route::get('/', function () {
    return view('home');
});



        // routes/web.php

        // Route::middleware(['auth', 'admin'])->group(function () {
            
        //     Route::resource('/items', ItemController::class);
        //     Route::get('/admin', 'AdminController@index')->middleware(UserIsAdmin::class);
        //     route::get('/item', function(){ return view('items');});   
        
            

        Auth::routes();




        
        Route::middleware(['notadmin' ,'auth'])->group(function ()   {
// ...

        Route::resource('/shop', ShopController::class)->middleware('notadmin');
        Route::resource('/carts', CartsController::class)->middleware('notadmin');                                                                      
        Route::get('/shop/store/{id}',[CartsController::class,'store'])->middleware('notadmin');
        Route::get('/buy',[BuyController::class,'index'])->middleware('notadmin');
        
        
        Route::post('/add-to-cart', 'CartController@addToCart');
        Route::get('/cart-details', 'CartController@cartDetails');
        Route::get('/carts/{id}',[CartsController::class,'destroy']);
        Route::get('/order/{address}',[CartsController::class,'ordersave']);
        Route::get('/thankyou',[CartsController::class,'thankyou'])->middleware('notadmin');

        Route::post('/billing',[CartsController::class,'orderbilling'])->middleware('notadmin');


        Route::get('/updatequantity', [CartsController::class,'updateQuantity']);

        Route::post('/address/{address}', [CartsController::class, 'orderbilling'])->Middleware('notadmin');
        Route::get('/orderproduct/{id}/{addressid}/', [OrderProductController::class, 'getProduct'])->middleware('notadmin');
        Route::get('/orderview',[OrderController::class,'orderpage']);


        Route::post('/address/{id}', [BuyController::class, 'address']);
        Route::post('/address-save',[AddressesController::class,'addressSave']);



        Route::get('/update-profile', [UserController::class, 'showUpdateForm'])->name('user.update.form');
        Route::put('/update-profile', [UserController::class, 'update'])->name('user.update');

        
       Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
       Route::post('/user_custmer', [App\http\Controllers\userCustmarController::class , 'store'])->name('userCustmar.store');
       Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');





});
       Route::middleware(['admin' ,'auth'])->group(function () {
           Route::resource('/items', ItemController::class)->middleware('admin');
           Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('admin');
           Route::post('/update-admin-status', [UserController::class, 'updateAdminStatus'])->name('update.admin.status');
           Route::get('/update-profile', [UserController::class, 'showUpdateForm'])->name('user.update.form')->middleware(['admin' ,'auth']);
        Route::put('/update-profile', [UserController::class, 'update'])->name('user.update')->middleware(['admin' ,'auth']);

           
       

       });









