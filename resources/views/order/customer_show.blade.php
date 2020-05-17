@extends('layouts.app')
@section('content')
   <div class="d-flex justify-content-around">
       <div class="col-md-2">
           <table class="table table-striped">
               <tbody>
               @foreach($orders as $order)
                   <tr>
                       <td class="restaurant-list" ><a href="/order/{{$order->id}}" >{{$order->orderedFrom()->first()->name}}</a></td>
                   </tr>
               @endforeach
               </tbody>
           </table>
       </div>
       <div class="col-md-10">
           @include('partials._item_list_customer')
       </div>
   </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
<style>
</style>
