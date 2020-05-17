<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Details</div>

                <div class="card-body">
                    <div class="text-uppercase d-flex flex-column text-justify">
                        <div><b>Restaurant Name:</b> {{$current_order->orderedFrom->name}}</div>
                        <div><b>Restaurant Email:</b> {{$current_order->orderedFrom->email}}</div>
                        <div><b>Restaurant Phone:</b> {{$current_order->orderedFrom->phoe}}</div>
                        <div><b>Restaurant Address:</b> {{$current_order->orderedFrom->address}}</div>
                        <div><b>Order Date:</b> {{$current_order->created_at->format('m-d-Y')}}</div>
                        <div><b>Order Time:</b> {{$current_order->created_at->format('H:i')}} </div>
                        <div><b>Order Status:</b> {{$current_order->status}}</div>
                    </div>
                    <hr>
                    <div>Items Ordered</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><u>Name</u></th>
                            <th><u>Price</u></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_items as $item)
                            <tr>
                                <td>{{$item->items->item_name}}</td>
                                <td>{{$item->items->price}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{$current_order->total_amount}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
