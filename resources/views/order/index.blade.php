@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>
                    <div class="card-body">
                        <div class="order-list">
                            @include('partials._order_list')
                        </div>
                        <div class="d-flex justify-content-end">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @if(Auth::user()->isCustomer())
        @include('partials.scripts.order_status_change_customer')
    @else
        @include('partials.scripts.order_status_change_restaurant')
    @endif
@endsection
<style>
</style>

