<div class="text-center text-uppercase"><b><u>Cart</u></b></div>
<table class="table table-bordered">
    <tbody>
        @if(!isset($cart['items']))
            <tr>
                <td class="empty-cart">Your Cart is Empty!!</td>
            </tr>
        @else
            @foreach($cart['items'] as $cart_item)
                <tr>
                    <td class="text-center">{{$cart_item['item_name']}}</td>
                </tr>
            @endforeach
                <tr class="text-uppercase">
                    <td>Total: {{array_sum(array_column($cart['items'],'price'))}}</td>
                </tr>
                <tr>
                    <td class="text-center"><button id="order-item" class="btn btn-success">Order</button></td>
                </tr>
        @endif
    </tbody>
</table>

<style>
    .empty-cart{
        color: crimson;
    }
</style>
