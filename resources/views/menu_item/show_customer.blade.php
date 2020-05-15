@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-around col-md-12">
        <div class="col-md-2">
            <table class="table table-striped">
                @foreach($restaurants as $restaurant)
                    <tr>
                        <td style="border-right: 1px solid black" ><a href="/menu/{{$restaurant->id}}" >{{$restaurant->name}}</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><u>Name</u></th>
                    <th><u>Category</u></th>
                    <th><u>Diet</u></th>
                    <th><u>Price</u></th>
                    <th><u>Action</u></th>
                </tr>
                </thead>
                <tbody>
                @if($items->count() <= 0)
                    <tr>
                        <td colspan="5" class="text-center">Nothing is added, add fast!!</td>
                    </tr>
                @endif
                @foreach($items as $item)
                    <tr>
                        <td id="tab_name">{{$item->item_name}}</td>
                        <td id="tab_category">{{$item->category}}</td>
                        <td id="tab_diet">
                            @if($item->vegetarian)
                                <span class="veg"></span>
                            @else
                                <span class="on-veg"></span>
                            @endif
                        </td>
                        <td id="tab_price">{{$item->price}}</td>
                        <td>
                            <a data-content="{{$item->id}}" class="edit btn btn-warning btn-sm" >Add to Cart</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-2">
            <div class="text-center text-uppercase"><b><u>Cart</u></b></div>
            <table class="table table-bordered">
                <tbody>
                @if(!session('cart'))
                    <tr>
                        <td class="empty-cart">Your Cart is Empty!!</td>
                    </tr>
                @else
                    @foreach(session('cart',[]) as $cart_item)
                        <tr>
                            <td class="text-center">{{$cart_item}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="text-center">{{'$cart_item'}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">{{'$cart_item'}}</td>
                    </tr>
                    <tr class="text-uppercase">
                        <td>Total: {{session('cart_total',0)}}</td>
                    </tr>
                    <tr>
                        <td class="text-center"><button class="btn btn-success">Order</button></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
<style>
    .veg {
        height: 20px;
        width: 20px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
    }
    .on-veg {
        height: 20px;
        width: 20px;
        background-color: crimson;
        border-radius: 50%;
        display: inline-block;
    }
    .empty-cart{
        color: crimson;
    }
</style>
