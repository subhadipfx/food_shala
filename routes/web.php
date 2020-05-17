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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Registration Routes
Route::prefix('/register')->group(function (){
    Route::get('/customer','Auth\RegisterController@createCustomer');
    Route::post('/customer','Auth\RegisterController@storeCustomer');

    Route::get('/restaurant','Auth\RegisterController@createRestaurant');
    Route::post('/restaurant','Auth\RegisterController@storeRestaurant');
});

//Routes Only For Restaurants
Route::middleware('restaurant')->group(function (){
    Route::prefix('/restaurant')->group(function (){
        Route::get('/edit','RestaurantController@edit');
    });
    Route::resource('restaurant','RestaurantController',['except' => ['edit','destroy']]);
});

//Routes Only For Customers
Route::middleware('customer')->group(function (){
    Route::prefix('/order')->group(function (){
        Route::post('/','OrdersController@store');
        Route::get('/cart',function (){
            return view('partials._cart') -> with('cart',Cache::get('cart-'.Auth::id()));
        });
        Route::get('/cart/add/{item}','OrdersController@create');
    });
    Route::prefix('/customer')->group(function(){
        Route::get('/edit','CustomerController@edit');
    });
    Route::resource('customer','CustomerController',['except' => ['edit']]);
});

//Routes for Both

//Menu Routes
Route::prefix('/menu')->group(function (){
    Route::get('/','MenuItemController@index')->name('menu.index');
    Route::get('/{id}','MenuItemController@show')->name('menu.show');
});
Route::resource('menu','MenuItemController',['except' => ['index','show', 'create']])->middleware('restaurant');

//Order Routes
Route::resource('order','OrdersController',['except' => ['create','store']])->middleware('auth');

//Fallback Route
Route::fallback(function () {
    echo view('fallback');
});
