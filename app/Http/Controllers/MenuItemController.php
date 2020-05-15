<?php

namespace App\Http\Controllers;

use App\MenuItem;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    private $validator;
    public function __construct()
    {
        $this->validator = $validator = Validator::make(\request()->all(), [
            'name' => 'required|max:255',
            'category' => 'required',
            'vegetarian' => 'required|boolean',
            'price' => 'required|numeric',
        ]);
    }


    public function index()
    {
        $items = MenuItem::where('restaurant_id',Auth::user()->details()->id)->get();
        return view('menu_item.index',compact('items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {

        if ($this->validator->fails()) {
            session(['status'=>'error']);
            session(['status-msg'=>'Error!! Item is not added, Please try again']);
            return back()
                ->withErrors($this->validator)
                ->withInput();
        }
        MenuItem::create([
            'restaurant_id' => Auth::user()->details()->id,
            'category' => $request->category,
            'item_name' => $request->name,
            'vegetarian' => $request->vegetarian,
            'price' => $request->price
        ]);
        session(['status'=>'success']);
        session(['status-msg'=>'Item is added successfully']);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function edit($id)
    {
        return MenuItem::find($id);
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
        if ($this->validator->fails()) {
            session(['status'=>'update']);
            session(['status-msg'=>'Warning!! Item is not updated, Please try again']);
            return back()
                ->withErrors($this->validator)
                ->withInput();
        }

        $menuItem = MenuItem::find($id);
        if($menuItem->restaurant_id != Auth::user()->details()->id){
            session(['status'=>'update']);
            session(['status-msg'=>'Unauthorized']);
            return back();
        }
        $menuItem->category = $request->category;
        $menuItem->item_name = $request->name;
        $menuItem->vegetarian = $request->vegetarian;
        $menuItem->price = $request->price;
        $menuItem->save();
        session(['status'=>'success']);
        session(['status-msg'=>'Item is updated successfully']);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return ResponseFactory|Response
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);
        $menuItem->delete();
        return response('deleted');
    }
}
