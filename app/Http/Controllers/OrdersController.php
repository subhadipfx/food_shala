<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\OrderedItem;
use App\Orders;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Throwable;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        if(Auth::user()->isCustomer()){
            $orders = Orders::where('customer_id',Auth::user()->details()->id)->latest()->paginate(5);
        }else{
            $orders = Orders::where('restaurant_id',Auth::user()->details()->id)->latest()->paginate(5);
        }
        return view('order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $item
     * @return RedirectResponse|Redirector
     * @throws Exception
     * @throws Throwable
     */
    public function create($item)
    {
        $menuItem = MenuItem::find($item);
        if(!$menuItem){
            return redirect('/order/cart');
        }
        $cart = cache('cart-'.Auth::id(),[]);
        if(isset($cart['current_restaurant']) && $cart['current_restaurant'] != $menuItem->restaurant_id){
            $cart = [];
        }
        if(isset($cart['items'][$menuItem->id])){
            unset($cart['items'][$menuItem->id]);
        }else{
            $cart['items'][$menuItem->id] = $menuItem->toArray();
        }
        $cart['current_restaurant'] = $menuItem->restaurant_id;
        Cache::put('cart-'.Auth::id(),$cart,now()->addDay());
        return redirect('/order/cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ResponseFactory|Response
     */
    public function store()
    {
        $cart = Cache::pull('cart-'.Auth::id(),[]);
        if(empty($cart) || !isset($cart['items'])){
            session(['message' => 'Cart is Empty']);
            return response('error',400);
        }
        $restaurant_id = $cart['current_restaurant'];
        $customer = Auth::user()->details();
        \DB::beginTransaction();
        try{
            $order = Orders::create([
                'customer_id' => $customer->id,
                'restaurant_id' => $restaurant_id,
                'address' => $customer->address,
                'total_amount' => array_sum(array_column($cart['items'],'price')),
                'status' => 'PLACED'
            ]);
            foreach ($cart['items'] as $item){
                OrderedItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
//                    'price' => $item->price
                ]);
            }
        }catch (Exception $exception){
            \DB::rollback();
            session(['message' => 'Something went wrong']);
            return response('error',500);
        }
        \DB::commit();
        session(['message' => 'placed']);
        return response('success',200);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function show($id)
    {
        if(Auth::user()->isCustomer()){
            $orders = Orders::where('customer_id',Auth::user()->details()->id)->latest()->get();
        }else{
            $orders = Orders::where('restaurant_id',Auth::user()->details()->id)->latest()->get();
        }
        $current_order = $orders->where('id',$id)->first();
        $order_items = OrderedItem::where('order_id',$id)->with('items')->get();
        return view('order.show',compact('orders','current_order','order_items','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return ResponseFactory|Response
     */
    public function update(Request $request, $id)
    {
        if($request->has('status')){
            $order = Orders::find($id);
            if($order){
                $old_status = $order->status;
                switch ($request->status){
                    case 'PREPARING':
                        if($order->status == 'PLACED'){
                            $order->status = 'PREPARING';
                        }
                        break;
                    case 'WAY':
                        if($order->status == 'PREPARING'){
                            $order->status = 'WAY';
                        }
                        break;
                    case 'DELIVERED':
                        if($order->status == 'WAY'){
                            $order->status = 'DELIVERED';
                        }
                        break;
                    case 'CANCELED':
                        if($order->status == 'PLACED'){
                            $order->status = 'CANCELED';
                        }
                        break;
                    default:
                }
                if($order->status != $old_status){
                    $order->save();
                    return response('Updated',200);
                }
            }
        }
        return response('',204);
    }
}
