@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Orders</div>

                    <div class="card-body">
                        <div class="text-uppercase">List Orders</div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><u>Ordered By</u></th>
                                <th><u>Price</u></th>
                                <th><u>Status</u></th>
                                <th><u>Details</u></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Ordered By</td>
                                <td>Price</td>
                                <td><button class="btn btn-success btn-sm">Delivered</button></td>
                                <td><a href="{{url('/order/5')}}" >Details</a></td>
                            </tr>
                            <tr>
                                <td>Ordered By</td>
                                <td>Price</td>
                                <td><button class="btn btn-danger btn-sm">Canceled</button></td>
                                <td><a href="{{url('/order/5')}}" >Details</a></td>
                            </tr>
                            <tr>
                                <td>Ordered By</td>
                                <td>Price</td>
                                <td><button class="btn btn-warning btn-sm">Preparing</button></td>
                                <td><a href="{{url('/order/5')}}" >Details</a></td>
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

