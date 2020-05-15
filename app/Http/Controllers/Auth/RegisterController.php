<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Restaurant;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        return view('auth.registration_choice');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function createCustomer()
    {
        return view('customer.create');
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'max:255', 'email'],
            'phone' => ['required', 'size:10'],
            'password' => ['required','min:8','max:16','confirmed'],
            'address' => ['required'],
            'city' => ['required'],
            'vegetarian' => ['required']
        ]);
        \DB::beginTransaction();
        try{
            $user = new User();
            $user->email = strtolower($request->email);
            $user->role = 'customer';
            $user->password = Hash::make($request->password);
            $user->save();
            Customer::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'vegetarian' => $request->vegetarian
            ]);
            $this->guard()->login($user);
        }catch (Exception $exception){
            \DB::rollback();
            Log::info($exception->getMessage());
        }
        \DB::commit();
        return redirect('/home');
    }

    public function createRestaurant()
    {
        return view('restaurant.create');
    }

    public function storeRestaurant(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'max:255', 'email'],
            'phone' => ['required' ],
            'password' => ['required','min:8','max:16','confirmed'],
            'address' => ['required'],
            'city' => ['required'],
            'owner_name' => ['required'],
            'owner_phone' => ['required'],
        ]);
        \DB::beginTransaction();
        try{
            $user = new User();
            $user->email = strtolower($request->email);
            $user->role = 'restaurant';
            $user->password = Hash::make($request->password);
            $user->save();
            Restaurant::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'owner_name' => $request->owner_name,
                'owner_phone' => $request->owner_phone
            ]);
            $this->guard()->login($user);
        }catch (Exception $exception){
            \DB::rollback();
            Log::info($exception->getMessage());
        }
        \DB::commit();
        return redirect('/home');
    }
}
