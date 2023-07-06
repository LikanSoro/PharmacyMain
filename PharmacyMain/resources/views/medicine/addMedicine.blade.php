@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
<link href="{{ asset('css/med.css')}}" rel="stylesheet" >
@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Medicine</h1>
        </div>
    </div>
    </div>
</div>
<div class="content">
    <form>
        <div class="form-group" id="med">
            Medicine name<input type="text" class="form-control" id="med_name" name="med_name" placeholder="Medicine" >
        </div>
        <div class="form-group" id="med">
        <select class="form-control" aria-label="Default select example" id="cat" name="cat">
            <option selected>Select medicine catagory</option>
            @foreach($catagory as $c)
            <option value="{{$c->id}}">{{$c->cat_name}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group" id="med">
        <select class="form-control" aria-label="Default select example" id="unit" name="unit">
            <option selected>Select Unit of measurement</option>
            @foreach($unit as $um)
            <option value="{{$um->id}}" >{{$um->unit_name}}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group" id="med">
        <select class="form-control" aria-label="Default select example" id="mf" name="mf">
            <option selected>Select supplier</option>
            @foreach($manufacturer as $m)
            <option value="{{$m->id}}">{{$m->m_name}}</option>
            @endforeach
        </select>
        </div>
        <div><a style="font-size: 14px; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:600; cursor:pointer; margin-bottom:10px; margin-top:2px;"  class="text-primary col-auto" id="btn-new-mf" data-toggle="modal" data-target="#modalCart">New supplier +</a></div>
        <div class="form-group" id="med">
            Generic name<input type="text" class="form-control" id="generic" name="generic" placeholder="eg. paracetamol">
        </div>
        <div class="form-group" id="med">
            Medicine strength<input type="text" class="form-control" id="strength" name="strength" placeholder="eg. 500mg">
        </div>
        <div class="form-group" id="med">
            Details<input type="text" class="form-control" id="detail" name="detail" placeholder="Medicine details">
        </div>
        <div class="card-tools">
            <button type="button" class="btn btn-primary" id="submit">Submit</button>
    </div>
    </form>
</div>

{{-- <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>Name</th>
                <th>Catagory</th>
                <th>Unit of measurement</th>
                <th>manufacturer</th>
                <th>Generic name</th>
                <th>strength</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div> --}}

{{-- new manufacturer modal --}}
<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add Manufacturer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id" name="id" value="" >
        <div class="form-floating mb-3 mt-3 ">
        <input type="text" class="form-control" id="name" name="name" placeholder="name">
        <label for="email">Name</label>
        </div>
        <div class="form-floating mb-3 mt-3 ">
        <input type="text" class="form-control" id="email" name="email" placeholder="Email id">
        <label for="email">Email id</label>
        </div>
        <div class="form-floating mb-3 mt-3 ">
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">
        <label for="email">Phone number</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="address" name="address" placeholder="Address"></textarea>
            <label for="comment">Address</label>
          </div>

        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="enter-mf">Submit</button>
        </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    $(document).on('click','#submit', function () {
        var data = {'medicine_name': $('#med_name').val(),
        'catagory': $('#cat').val(),
        'unit': $('#unit').val(),
        'manufacturer': $('#mf').val(),
        'generic': $('#generic').val(),
        'strength': $('#strength').val(),
        'detail': $('#detail').val(),
        }
        $.ajax({
            type: "POST",
            url: "medicine",
            data: data,
            dataType: "json",
            success: function (response) {
                if(response.status == 200){
                    // fetchMedicine();
                $('#med_name').val(''),
                $('#generic').val(''),
                $('#strength').val(''),
                $('#detail').val('')
                Command: toastr["success"]("Medicine added successfully")

            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "500",
            "timeOut": "1000",
            "extendedTimeOut": "500",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            }
            }
            else{
                let size = 0 ;
            var firstkey;
            msg(response.error);
            err(response.error);
            Command: toastr["warning"](firstkey);

            toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-center",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "1000",
                        "hideDuration": "1000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
            }
            function msg(msg){
            $.each(msg , function(key , value){
                return size++;
            });
            }
            function err(msg){
            $.each(msg,function(key , value){
                firstkey = value;
                return false;
            });
            return firstkey;
            }
            }
            }
        });
    });


    $('#enter-mf').on('click', function () {
        var data = {
            'name':$('#name').val(),
            'email':$('#email').val(),
            'phone':$('#phone').val(),
            'address':$('#address').val()
        }
        $.ajax({
            type: "post",
            url: "manufacturer",
            data: data,
            dataType: "json",
            success: function (response) {
                $('#modalCart').modal('hide');
                alert('saved');
                $('#name').val(''),
 
                $('#email').val(''),

                $('#phone').val(''),

                $('#address').val('')

            }
        });
    });
    });
</script>
@endsection