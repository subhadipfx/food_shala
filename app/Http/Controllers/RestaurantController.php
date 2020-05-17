<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Restaurant;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RestaurantController extends Controller
{

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
        $orders = Orders::where('restaurant_id',Auth::user()->details()->id)
            ->whereIn('status',['PLACED','PREPARING','WAY'])->with('orderedFrom')->latest()->get();
        return view('restaurant.index',compact('orders'))->with('user',Auth::user()->details());
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @param $id
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
            if(!Hash::check($request->password,$user->password)){
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
        $restaurant = Auth::user()->details();
        $restaurant->name = $request->name;
        $restaurant->phone = $request->phone;
        $restaurant->address = $request->address;
        $restaurant->city = $request->city;
        $restaurant->owner_name = $request->owner_name;
        $restaurant->owner_phone = $request->owner_phone;
        $restaurant->save();
        return  redirect()->home();
    }
}
