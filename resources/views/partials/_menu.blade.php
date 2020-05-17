<div class="p-2 d-flex justify-content-around">
    <div class="col-md-4">

    </div>
    <div class="text-center text-uppercase col-md-4">
        <b>Today's Menu</b>
    </div>
    <div class="text-right col-md-4">
        <label for="choice">Veg Only?</label>
        <input id="choice" name="choice" type="checkbox" >
    </div>
</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th><u>Name</u></th>
        <th><u>Category</u></th>
        <th><u>Diet</u></th>
        <th><u>Price</u></th>
        @auth<th><u>Action</u></th>@endauth
    </tr>
    </thead>
    <tbody>
    @if($items->count() <= 0)
        <tr>
            <td colspan="5" class="text-center">Nothing is added, add fast!!</td>
        </tr>
    @endif
    @foreach($items as $item)
        <tr>
            <td id="tab_name">{{$item->item_name}}</td>
            <td id="tab_category">{{$item->category}}</td>
            <td id="tab_diet">
                @if($item->vegetarian)
                    <span class="veg"></span>
                @else
                    <span class="non-veg"></span>
                @endif
            </td>
            <td id="tab_price">{{$item->price}}</td>
            @auth
                <td>
                    @if(isset($cart['items']) && in_array($item->id,array_column($cart['items'],'id')))
                        <a data-content="{{$item->id}}" data-restaurant="{{$item->restaurant_id}}" class="add-cart btn btn-outline-success btn-sm" >Added</a>
                    @else
                        <a data-content="{{$item->id}}" data-restaurant="{{$item->restaurant_id}}" class="add-cart btn btn-outline-primary btn-sm" >Add</a>
                    @endif
                </td>
            @endauth
        </tr>
    @endforeach
    </tbody>
</table>

<style>
    .veg {
        height: 20px;
        width: 20px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
    }
    .non-veg {
        height: 20px;
        width: 20px;
        background-color: crimson;
        border-radius: 50%;
        display: inline-block;
    }
</style>
