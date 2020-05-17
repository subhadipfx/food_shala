<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-justify"><u>Order No</u></th>
        <th class="text-left"><u>{{Auth::user()->isRestaurant() ? "Ordered By" : "Ordered From"}}</u></th>
        <th class="text-center"><u>Bill Amount</u></th>
        <th class="text-center"><u>Status</u></th>
        <th class="text-center"><u>Details</u></th>
    </tr>
    </thead>
    <tbody>
    @if($orders->count() <= 0)
        <tr>
            <td colspan="5" class="text-center">Order list is empty</td>
        </tr>
    @endif

    @foreach($orders as $order)
        <tr>
            <td class="text-justify">{{$order->id}}</td>
            <td class="text-left">
                <a href="{{Auth::user()->isCustomer() ? "/menu/".$order->orderedFrom()->first()->id : ""}}">
                    {{Auth::user()->isRestaurant() ? $order->orderedBy()->first()->name : $order->orderedFrom()->first()->name}}
                </a>
            </td>
            <td class="text-center">{{$order->total_amount}}</td>
            <td class="text-center">
                @switch($order->status)
                    @case('PLACED')
                    <span data-id="{{$order->id}}" data-status="PLACED" class="status btn-info btn-sm">Placed</span>
                    @break
                    @case('PREPARING')
                    <span data-id="{{$order->id}}" data-status="PREPARING" class="status btn-warning btn-sm">PREPARING</span>
                    @break
                    @case('WAY')
                    <span data-id="{{$order->id}}" data-status="WAY" class="status btn-primary btn-sm">On Way</span>
                    @break
                    @case('DELIVERED')
                    <span data-id="{{$order->id}}" data-status="DELIVERED" class="status btn-success btn-sm">Delivered</span>
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
