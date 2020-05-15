<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RestaurantController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('restaurant.index')->with('user',Auth::user()->details());
    }


    /**
     * Display the specified resource.
     *
     * @param Restaurant $restaurant
     * @return void
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Restaurant $restaurant
     * @return Factory|View
     */
    public function edit()
    {
        return view('restaurant.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Restaurant $restaurant
     * @return Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Restaurant $restaurant
     * @return Response
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
