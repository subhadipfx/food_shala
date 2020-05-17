<div class="text-uppercase">List Orders</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-justify"><u>Order No</u></th>
        <th class="text-left"><u>Ordered From</u></th>
        <th class="text-center"><u>Bill Amount</u></th>
        <th class="text-center"><u>Status</u></th>
        <th class="text-center"><u>Details</u></th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td class="text-justify">{{$order->id}}</td>
            <td class="text-left">{{$order->orderedFrom()->first()->name}}</td>
            <td class="text-center">{{$order->total_amount}}</td>
            <td class="text-center">
                @switch($order->status)
                    @case('PLACED')
                    <span data-id="{{$order->id}}" data-status="PLACED" class="status btn-info btn-sm">Placed</span>
                    @break
                    @case('PREPARING')
                    <span data-id="{{$order->id}}" data-status="PREPARING" class="status btn-warning btn-sm">On Way</span>
                    @break
                    @case('WAY')
                    <span data-id="{{$order->id}}" data-status="WAY" class="status btn-primary btn-sm">On Way</span>
                    @break
                    @case('DELIVERED')
                    <span data-id="{{$order->id}}" data-status="DELIVERED" class="status btn-info btn-sm">Delivered</span>
                    @break
                    @case('CANCELED')
                    <span data-id="{{$order->id}}" data-status="CANCELED" class="staus btn-danger btn-sm">Canceled</span>
                    @break
                @endswitch
            </td>
            <td class="text-center"><a href="{{url('/order/'.$order->id)}}" >Details</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
