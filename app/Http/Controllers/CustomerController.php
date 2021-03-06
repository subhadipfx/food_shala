<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CustomerController extends Controller
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
        $orders = Orders::where('customer_id',Auth::user()->details()->id)
            ->whereIn('status',['PLACED','PREPARING','WAY'])->with('orderedFrom')->latest()->get();
        return view('customer.index',compact('orders'))->with('user',Auth::user()->details());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Factory|View
     */
    public function edit()
    {
        return view('customer.edit')->with('user',Auth::user()->details());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'phone' => ['required' ],
            'password' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'vegetarian' => ['required']
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
        if($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $customer = Auth::user()->details();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->vegetarian = $request->vegetarian;
        $customer->save();
        return redirect()->home();
    }
}
