<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

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
//Welcome Page
Route::get('/', function () {
    return view('welcome');
});

//Auth Routes
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Registration Routes
Route::prefix('/register')->group(function (){
    Route::view('/customer','customer.create');
    Route::post('/customer','Auth\RegisterController@storeCustomer');

    Route::view('/restaurant','restaurant.create');
    Route::post('/restaurant','Auth\RegisterController@storeRestaurant');
});

//Routes Only For Restaurants
Route::middleware('restaurant')->group(function (){
    Route::prefix('/restaurant')->group(function (){
        Route::get('/edit','RestaurantController@edit');
    });
    Route::resource('restaurant','RestaurantController',['except' => ['edit','destroy','index']]);
});

//Routes Only For Customers
Route::middleware('customer')->group(function (){
    //Routes related to cart
    Route::prefix('/order')->group(function (){
        Route::post('/','OrdersController@store');
        Route::get('/cart',function (){
            return view('partials._cart') -> with('cart',Cache::get('cart-'.Auth::id()));
        });
        Route::get('/cart/add/{item}','OrdersController@create');
    });

    //Routes related to customer
    Route::prefix('/customer')->group(function(){
        Route::get('/edit','CustomerController@edit');
    });
    Route::resource('customer','CustomerController',['only' => ['show','update']]);
});

//Routes for ALL Customer,Restaurant,Guest(selective)

//Menu Routes
Route::prefix('/menu')->group(function (){
    Route::get('/','MenuItemController@index')->name('menu.index');
    Route::get('/{id}','MenuItemController@show')->name('menu.show');
});
Route::resource('menu','MenuItemController',['except' => ['index','show', 'create']])->middleware('restaurant');

//Order Routes
Route::resource('order','OrdersController',['except' => ['create','store','edit','destroy']])->middleware('auth');



//Fallback Route
Route::fallback(function () {
    echo view('fallback');
});
