@extends('layouts.app')
@section('content')
    @guest
        <div class="offset-4 col-md-4 alert alert-info" role="alert">
            Please Login/Register to Order something
        </div>
    @endguest
    @if (session('message') && session('message') != 'placed')
        <div class="alert alert-danger" role="alert">
            {{ session()->pull('message') }}
        </div>
    @endif
    <div class="d-flex justify-content-around col-md-12">
        <div class="col-md-2">
            <table class="table table-striped">
                <td class="restaurant-list-parent" ><span ><b>Restaurant List</b></span></td>
                @foreach($restaurants as $restaurant)
                        @if($restaurant->hasItems())
                            <tr>
                                <td class="restaurant-list" ><a href="/menu/{{$restaurant->id}}" >{{$restaurant->name}}</a></td>
                            </tr>
                        @endif
                @endforeach
            </table>
        </div>
        <div class="col-md-8 menu">
            @include('partials._menu')
        </div>
        @auth
            <div class="col-md-2 cart">
                @if(session()->pull('message') == 'placed')
                    @include('partials._order_done')
                @else
                    @include('partials._cart')
                @endif
            </div>
        @endauth
    </div>
@endsection
@section('script')
    <script>
        let cart = [];
        $('#choice').click(function () {
            if($(this).is(':checked')){
                $('.non-veg').each(function () {
                    $(this).parent().parent().hide();
                });
            }else{
                $('.non-veg').each(function () {
                    $(this).parent().parent().show();
                });
            }
        });
        $('.add-cart').each(function () {
            $(this).click(function () {
                if($(this).hasClass('btn-outline-primary')){
                    $(this)
                        .text('Added')
                        .removeClass('btn-outline-primary')
                        .addClass('btn-outline-success')
                }else{
                    $(this)
                        .text('Add')
                        .removeClass('btn-outline-success')
                        .addClass('btn-outline-primary')
                }
                let itemID = $(this).attr('data-content');
                axios.get('/order/cart/add/'+itemID)
                    .then(function (response) {
                        $('.cart').html(response.data);
                        cart_script();
                    })
                    .catch(function (error) {
                        console.log(error)
                    })

            })
        });
        function cart_script() {
            $('#order-item').click(function (e) {
                console.log('clicked');
                e.preventDefault();
                axios.post('/order')
                    .then(function (response) {
                        if(response.data === 'success'){
                            location.reload()
                        }
                    })
                    .catch(function (error) {
                        location.reload();
                    })
            })
        }
        cart_script();
    </script>
@endsection
<style>
    .cart,.menu{
        border: 1px solid black;
    }
    .restaurant-list,.restaurant-list-parent{
        border-right: 1px solid black;
    }
</style>
