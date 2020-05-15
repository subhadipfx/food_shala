@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hi!! {{$user->name}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="text-center p-2">
                            <a  href="{{url("/order")}}" class="btn btn-primary" >My Orders</a>
                            <a href="{{url('/restaurant/edit')}}" class="btn btn-warning">Edit My Profile</a>
                        </div>
                            <strong>ACTIVE ORDERS</strong>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th><u>Order ID</u></th>
                                    <th><u>Ordered From</u></th>
                                    <th><u>Price</u></th>
                                    <th><u>STATUS</u></th>
                                </tr>
                                </thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Ordered By</td>
                                    <td>Price</td>
                                    <td><button class="btn btn-info btn-sm">Preparing</button></td>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Ordered By</th>
                                    <th>Price</th>
                                    <th><button class="btn btn-primary btn-sm">On Way</button></th>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Ordered By</th>
                                    <th>Price</th>
                                    <th><button class="btn btn-success btn-sm disabled">Delivered</button></th>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Ordered By</th>
                                    <th>Price</th>
                                    <th><button class="btn btn-danger btn-sm disabled">Canceled</button></th>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .btn.disabled{
        cursor: context-menu !important;
    }
</style>
