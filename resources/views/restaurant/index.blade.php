@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-uppercase text-primary"><u>{{$user->name}}</u></div>
                    <div class="card-body">
{{--                        @if (session('status'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                {{ session('status') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <div class="text-right p-2">
                            <a  href="{{url("/order")}}" class="btn btn-primary" >ALL Orders</a>
                            <a href="{{url("/menu/".Auth::user()->details()->id)}}" class="btn btn-info">Customize MENU</a>
                        </div>
                        <strong>ACTIVE ORDERS</strong>
                        <div id="active-orders">
                            @include('partials._order_list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('partials.scripts.order_status_change_restaurant')
@endsection

