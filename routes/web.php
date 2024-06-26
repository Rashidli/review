<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanWarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\ThingServiceController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\TransportWarehouseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/optimize_clear',function (){
   Artisan::call('optimize:clear');
});

Route::get('/storage_link',function (){
   Artisan::call('storage:link');
});

Route::get('/migrate',function (){
   Artisan::call('migrate');
});

Route::get('/', [PageController::class,'login'])->name('login');
Route::get('/register', [PageController::class,'register'])->name('register');
Route::post('/login_submit',[AuthController::class,'login_submit'])->name('login_submit');
Route::post('/register_submit',[AuthController::class,'register_submit'])->name('register_submit');

Route::group(['middleware' =>'auth'], function (){

    Route::get('/home', [PageController::class,'home'])->name('home');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);
    Route::resource('permissions',PermissionController::class);

//  usta
    Route::resource('thing_services', ThingServiceController::class);
    Route::resource('things', ThingController::class);

//   products
    Route::resource('products', ProductController::class);

//  isci
    Route::resource('workers', WorkerController::class);

//  nəqliyyat
    Route::resource('directions', DirectionController::class);
    Route::resource('regions', RegionController::class);
    Route::resource('cars', CarController::class);

    Route::get('addresses/index/{id}', [AddressController::class, 'index'])->name('addresses.index');
    Route::get('addresses/create/{id}', [AddressController::class,'create'])->name('addresses.create');
    Route::get('addresses/{address}/edit', [AddressController::class,'edit'])->name('addresses.edit');
    Route::post('addresses', [AddressController::class,'store'])->name('addresses.store');
    Route::put('addresses/{address}', [AddressController::class,'update'])->name('addresses.update');
    Route::delete('addresses/{address}', [AddressController::class,'destroy'])->name('addresses.destroy');

//  Anbar
    Route::resource('transports', TransportController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('transport_warehouses', TransportWarehouseController::class);
    Route::resource('plan_warehouses', PlanWarehouseController::class);

//  sifariş
    Route::resource('orders', OrderController::class);
    Route::get('/getDirections', [OrderController::class,'getDirections']);
    Route::get('/getRegionPrice', [OrderController::class,'getRegionPrice']);
//    get store prices by transports
    Route::get('/getStorePrice', [OrderController::class,'getStorePrice']);
//    get store prices by kv
    Route::get('/getStorePrices', [OrderController::class,'getStorePrices']);
//    get master prices
    Route::get('/getThingPrice', [OrderController::class,'getThingPrice']);
//    change order status
    Route::put('/change_status/{id}', [OrderController::class, 'change_status'])->name('change_status');

    Route::get('/export', [OrderController::class, 'export'])->name('export');
    Route::delete('/order/images/delete', [OrderController::class,'delete'])->name('order.images.delete');

    Route::get('/sendMail/{id}', [OrderController::class,'sendMail'])->name('sendMail');

});

Route::get('sifaris/{id}', [OrderController::class,'get_order'])->name('get_order');
Route::get('operator_sifaris/{id}', [OrderController::class,'operator_sifaris'])->name('operator_sifaris');
Route::get('tam_siyahi/{id}', [OrderController::class,'full_list'])->name('full_list');
Route::get('customer_answer/{id}', [OrderController::class,'customer_answer'])->name('customer_answer');
Route::get('customer_full_answer/{id}', [OrderController::class,'customer_full_answer'])->name('customer_full_answer');
