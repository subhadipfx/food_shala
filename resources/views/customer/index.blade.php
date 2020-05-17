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
                            <a href="{{url('/customer/edit')}}" class="btn btn-warning">Edit My Profile</a>
                        </div>
                            <strong>ACTIVE ORDERS</strong>
                            <div id="active-orders">
                                @include('partials._order_list_customer')
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('partials.scripts.order_status_change')
@endsection
<style>
    .btn.disabled{
        cursor: context-menu !important;
    }
</style>
