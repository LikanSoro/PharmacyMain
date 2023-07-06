@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<style>
  td[contenteditable="true"] {
  background-color: #f1f1f1;
  border: 1px solid #ddd;
  padding: 5px;
}
</style>
@section('content')

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Customer</h1>
        <div class="card-tools">
                <div class="input-group-append">
                <button type="button" class="btn-default" data-toggle="modal" data-target="#addCustomer" id="add_customer">
                Add customer
                </button>
                </div>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>Customer name</th>
                <th>Customer phone</th>
                <th>Customer email</th>
                <th>Customer address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

{{-- add Customer --}}
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id"  value="" >
        <div class="form-group">
        Name<input type="text" class="form-control" id="name" value="" >
        </div>
        <div class="form-group">
        Email id<input type="text" class="form-control" id="email" value="" >
        </div>
        <div class="form-group">
        Phone number<input type="text" class="form-control" id="phone" value="" >
        </div>
        <div class="form-group">
        Address<input type="text" class="form-control" id="address" value="" >
        </div>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>
    </div>
</div>

{{-- edit Customer --}}
<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form>
            <input type="hidden" class="form-control"   value="" >
            <div class="form-group">
            Name<input type="text" class="form-control" id="edit_name" value="" >
            </div>
            <div class="form-group">
            Email id<input type="text" class="form-control" id="edit_email" value="" >
            </div>
            <div class="form-group">
            Phone number<input type="text" class="form-control" id="edit_phone" value="" >
            </div>
            <div class="form-group">
            Address<input type="text" class="form-control" id="edit_address" value="" >
            </div>
            </form>
            </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update">update</button>
        </div>
    </div>
    </div>
</div>

{{-- delete warning --}}
<div class="modal fade" id="deleteCustomer"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        Are you sure you want to delete this data ?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" id="delete">Yes</button>
        </div>
    </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
    });

        fetchCustomer();
        function fetchCustomer(){
            $.ajax({
                type: "GET",
                url: "fetchCustomer",
                dataType: "json",
                success: function (response){
                    $('tbody').html("");
                    $.each(response.customer, function(key,item){
                        $('tbody').append('<tr>\
                            <td>'+item.name+'</td>\
                            <td>'+item.phone+'</td>\
                            <td>'+item.email+'</td>\
                            <td>'+item.address+'</td>\
                            <td> <button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" >Delete</button></td>\
                        </tr>');
                    });
                }
            });
        }

        $(document).on('click','#deleteData', function () {
            var id = $(this).val();
            // alert('hey');
            $.ajax({
                type: "delete",
                url: "customer/"+id,
                dataType: "json",
                success: function (response) {
                    fetchCustomer();
                }
            });
        });

        $('#submit').on('click', function (e) {
            e.preventDefault();
            var data = {'name': $('#name').val(),
                        'email':$('#email').val(),
                        'phone':$('#phone').val(),                
                        'address':$('#address').val()                             
                        }
            $.ajax({
                type: "POST",
                url: "customer",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status==500){
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
                else{
                    fetchCustomer();
                $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#address").val('');
                $('#addCustomer').modal('hide')
                Command: toastr["success"]("Customer added successfully")

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
                }
            });
        });

        
    });
</script>
@endsection
@endsection