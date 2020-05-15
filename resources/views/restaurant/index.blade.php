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
                        <div class="text-center p-2">
                            <a  href="{{url("/order")}}" class="btn btn-primary" >Orders</a>
                            <a href="{{url("/menu")}}" class="btn btn-info">Customize MENU</a>
                            <a href="{{url('/restaurant/5/edit')}}" class="btn btn-warning">Edit Restaurant Details</a>
                        </div>
                        <strong>ACTIVE ORDERS</strong>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><u>Item Name</u></th>
                                <th><u>Ordered By</u></th>
                                <th><u>Price</u></th>
                                <th><u>STATUS</u></th>
                            </tr>
                            </thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Ordered By</th>
                                <th>Price</th>
                                <th><button class="btn btn-info btn-sm">Preparing</button></th>
                            </tr>
                            <tr>
                                <th>Item Name</th>
                                <th>Ordered By</th>
                                <th>Price</th>
                                <th><button class="btn btn-primary btn-sm">Delivering</button></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

