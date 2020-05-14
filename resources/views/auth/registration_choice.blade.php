@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Select Your Choice') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between p-5">
                            <a href="{{url('/register/customer')}}">
                                <img src="{{ asset('images/customer.jpg') }}" alt="register to eat">
                            </a>
                            <a href="{{url('/register/restaurant')}}">
                                <img src="{{ asset('images/restaurant.jpg') }}" alt="register to serve">
                            </a>
                        </div>
                        <div class="d-flex justify-content-between">
                            <strong id="eat">You are here to Eat</strong>
                            <strong id="serve">You are here to Serve</strong>
                        </div>
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
    img{
        height: 200px;
        width: 200px;
    }
    .card-body{
        position: relative !important;
    }
    #eat{
        position: absolute;
        top: 265px;
        right: 482px;
    }
    #serve{
        bottom: 45px;
        right: 90px;
        position: absolute;
    }
</style>
