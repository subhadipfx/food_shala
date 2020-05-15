@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Order Details</div>

                    <div class="card-body">
                        <div class="text-uppercase d-flex flex-column">
                            <span>Customer Name: Test</span>
                            <span>Customer Email:</span>
                            <span>Customer Phone:</span>
                            <span>Customer Address:</span>
                            <span>Order Date:</span>
                            <span>Order Time:</span>
                            <span>Order Status:</span>
                        </div>
                        <div>Items Ordered</div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><u>Name</u></th>
                                <th><u>Price</u></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Price</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>Price</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>0.0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
<style>
</style>
