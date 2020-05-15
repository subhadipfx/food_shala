<?php

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
Route::prefix('/register')->group(function (){
    Route::get('/customer','Auth\RegisterController@createCustomer');
    Route::post('/customer','Auth\RegisterController@storeCustomer');

    Route::get('/restaurant','Auth\RegisterController@createRestaurant');
    Route::post('/restaurant','Auth\RegisterController@storeRestaurant');
});

Route::resource('customer','CustomerController')->middleware('customer');
Route::middleware('restaurant')->group(function (){

    Route::prefix('/restaurant')->group(function (){
        Route::get('/edit','RestaurantController@edit');
    });
    Route::resource('restaurant','RestaurantController',['except' => ['edit','destroy']]);
});
Route::prefix('/menu')->group(function (){
    Route::get('/','MenuItemController@index')->name('menu.index');
    Route::get('/{id}','MenuItemController@show')->name('menu.show');
});
Route::resource('menu','MenuItemController',['except' => ['index','show', 'create']])->middleware('restaurant');
Route::resource('order','OrdersController')->middleware('auth');

//Route::fallback(function () {
//    echo view('fallback');
//});
