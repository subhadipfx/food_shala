<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use mysql_xdevapi\Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
//     * @param Request $request
//     * @return RedirectResponse|Redirector
     */
//    public function store(Request $request)
//    {
//        $request->validate([
//            'name' => ['required'],
//            'email' => ['required', 'unique:users', 'max:255', 'email'],
//            'phone' => ['required', 'size:10'],
//            'password' => ['required','min:8','max:16','confirmed'],
//            'address' => ['required'],
//            'city' => ['required'],
//            'vegetarian' => ['required']
//        ]);
////        $user = User::create([
////            'email' => strtolower($request->email),
////            'role' => 'customer',
////            'password' => Hash::make($request->password),
////        ]);
//        \DB::beginTransaction();
//        try{
//            $user = new User();
//            $user->email = strtolower($request->email);
//            $user->role = 'customer';
//            $user->password = Hash::make($request->password);
//            $user->save();
//            Customer::create([
//                'name' => $request->name,
//                'email' => strtolower($request->email),
//                'phone' => $request->phone,
//                'address' => $request->address,
//                'city' => $request->city,
//                'vegetarian' => $request->vegetarian
//            ]);
//            $this->guard()->login($user);
//        }catch (Exception $exception){
//            \DB::rollback();
//        }
//        \DB::commit();
//        return redirect('/home');
//    }

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
        return view('customer.index')->with('user',Auth::user()->details());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer)
    {
        return response('create');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    public function update(Request $request, Customer $customer)
    {
        return response('create');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        return response('create');

    }
}
