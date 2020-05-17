@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>
                    <div class="card-body">
                        @include('partials._order_list_customer')
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
    @include('partials.scripts.order_status_change')
    <script>

    </script>
@endsection
<style>
</style>

