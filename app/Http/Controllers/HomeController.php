<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse|Redirector
     */
    public function index()
    {
        if(Auth::user()->isRestaurant()){
            return redirect('/restaurant');
        }else{
            return  redirect('/customer');
        }
    }
}
