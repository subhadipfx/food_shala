@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Customize Menu</div>

                    <div class="card-body">
                        @if (session('status') && session('status') == 'success')
                            <div class="alert alert-success" role="alert">
                                {{ session('status-msg') }}
                            </div>
                        @endif
                        @if (session('status') && session('status') == 'error')
                            <div class="alert alert-danger" role="alert">
                                {{ session('status-msg') }}
                            </div>
                        @endif
                        @if (session('status') && session('status') == 'update')
                            <div class="alert alert-warning" role="alert">
                                {{ session('status-msg') }}
                            </div>
                        @endif
                            @php(session()->forget(['status','status-msg']))
                        <div class="text-right">
                            <a class="btn btn-info"  data-toggle="modal" data-target="#modal-form">Add Item</a>
                        </div>
                        <div class="text-uppercase">List Items</div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><u>ID</u></th>
                                <th><u>Name</u></th>
                                <th><u>Category</u></th>
                                <th><u>Diet</u></th>
                                <th><u>Price</u></th>
                                <th><u>Action</u></th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($items->count() <= 0)
                                <tr>
                                    <td colspan="6" class="text-center">Nothing is added, add fast!!</td>
                                </tr>
                            @endif
                            @foreach($items as $item)
                                <tr>
                                    <td id="tab_id">{{$item->id}}</td>
                                    <td id="tab_name">{{$item->item_name}}</td>
                                    <td id="tab_category">{{$item->category}}</td>
                                    <td id="tab_diet">
                                        @if($item->vegetarian)
                                            <span class="veg"></span>
                                        @else
                                            <span class="on-veg"></span>
                                        @endif
                                    </td>
                                    <td id="tab_price">{{$item->price}}</td>
                                    <td>
                                        <a data-content="{{$item->id}}" class="edit btn btn-warning btn-sm" >Edit</a>
                                        <a data-content="{{$item->id}}"  class="delete btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Add an Item</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="/menu">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}" autocomplete="category" autofocus>

                                                        @error('category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="diet" class="col-md-4 col-form-label text-md-right">{{ __('Vegetarian') }}</label>

                                                    <div class="col-md-6">
                                                        <label for="vegetarian">Yes</label>
                                                        <input id="vegetarian" type="radio" class=" @error('vegetarian') is-invalid @enderror" name="vegetarian" value="1" required >
                                                        <label for="non-vegetarian">No</label>
                                                        <input id="non-vegetarian" type="radio" class=" @error('non-vegetarian') is-invalid @enderror" name="vegetarian" value="0" required>
                                                        @error('vegetarian')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus>

                                                        @error('price')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row text-center">
                                                    <div class="offset-5">
                                                        <button type="submit" class="btn btn-success">ADD</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
