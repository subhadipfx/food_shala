@extends('layouts.app')
@section('content')
    <div class="d-flex justify-content-around">
        <div class="col-md-2">
            <table class="table table-striped">
                <tbody>
                @foreach($orders as $order)
                    <tr class="{{$order->id == $id ? "active" : ""}}">
                        <td class="customer-list"><a href="/order/{{$order->id}}">{{ Auth::user()->isRestaurant() ? $order->orderedBy()->first()->name : $order->orderedFrom()->first()->name }}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-10">
            @include('partials._item_list')
        </div>
    </div>
@endsection
<style>
    .active td{
        background-color: skyblue;
    }
    .active td a{
        color: black;
    }
    td a{
        color: black;
    }
</style>
