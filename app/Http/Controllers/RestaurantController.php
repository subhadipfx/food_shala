<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        if($id != Auth::user()->details()->id){
            return view('unauthorized');
        }

        return view('restaurant.index')->with('user',Auth::user()->details());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Restaurant $restaurant
     * @return Factory|View
     */
    public function edit()
    {
        $restaurant = Auth::user()->details();
        return view('restaurant.edit',compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return string
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'phone' => ['required' ],
            'password' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'owner_name' => ['required'],
            'owner_phone' => ['required'],
        ]);
        if($request->has('password')){
            $user = User::find(Auth::id());
            if($user->password != Hash::make($request->password)){
                $validator->getMessageBag()->add('password','Please enter the correct password');
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $restaurant = Restaurant::find($id);
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->address = $request->address;
        $restaurant->city = $request->city;
        $restaurant->owner_name = $request->owner_name;
        $restaurant->owner_phone = $request->owner_phone;
        $restaurant->save();
        return  route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Restaurant $restaurant
     * @return Response
     */
}
