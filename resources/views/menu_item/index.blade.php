@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Customize Menu</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-{{session()->pull('status','info')}}" role="alert">
                                {{ session()->pull('status-msg') }}
                            </div>
                        @endif
                        <div class="text-uppercase"><b>List Restaurants</b></div>
                        <br>
                        <table class="table table-striped">
                            <tbody>
                            @if($restaurants->count() <= 0)
                                <tr>
                                    <td class="text-center">Sorry!! No Restaurant is found in Your area</td>
                                </tr>
                            @endif
                            @foreach($restaurants as $restaurant)
                                @if($restaurant->hasItems())
                                    <tr>
                                        <td class="text-center"><a href="/menu/{{$restaurant->id}}">{{$restaurant->name}}</a></td>
                                    </tr>
                                @endif
                            @endforeach
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
        $(document).ready(function () {
            const modal_form =  $('#modal-form');
            if($('.alert').hasClass('alert-danger')){
                modal_form.modal('show');
            }

            modal_form.on('hidden.bs.modal', function () {
                $(".method-put").remove()
            });

            $('.edit').each(function () {
                $(this).click(function () {
                    const id = $(this).attr('data-content');
                    axios.get(`/menu/${id}/edit`).then( function (response) {
                        data = response.data;
                        $('#name').val(data.item_name);
                        $('#category').val(data.category);
                        $('#price').val(data.price);
                        if(data.vegetarian){
                            $('#vegetarian').prop('checked',true)
                        }else{
                            $('#non-vegetarian').prop('checked',true)
                        }
                        $('#modal-form form')
                            .attr('action','/menu/'+id)
                            .append('<input name="_method" class="method-put" type="hidden" value="PUT">');
                        $("#modal-form button[type='submit']")
                            .text('Update')
                            .removeClass('btn-success')
                            .addClass('btn-warning');

                        $('#modal-form').modal('show')
                    })
                        .catch(function (error) {
                            console.log(error)
                        })
                })
            });
            $('.delete').each(function () {
                $(this).click(function () {
                    const id = $(this).attr('data-content');
                    axios.delete('/menu/'+id)
                        .then(function (response) {
                            if(response.data === 'deleted'){
                                location.reload();
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        })
                })
            });

        })
    </script>
@endsection
<style>
    .veg {
        height: 20px;
        width: 20px;
        background-color: green;
        border-radius: 50%;
        display: inline-block;
    }
    .on-veg {
        height: 20px;
        width: 20px;
        background-color: crimson;
        border-radius: 50%;
        display: inline-block;
    }
</style>
