@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Customer Type</h1>
        <div class="card-tools">
                <div class="input-group-append">
                <button type="submit" class="btn-default" data-toggle="modal" data-target="#addCustomerType" id="ct">
                Add customer type
                </button>
                </div>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Customer type name</th>
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

{{-- add Unit --}}
<div class="modal fade" id="addCustomerType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add customer type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id" name="id" value="" >
        <div class="form-group">
        Customer type name<input type="text" class="form-control" id="ct_name" name="ct_name" >
        </div>
        </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>
    </div>
</div>

{{-- edit Unit --}}
<div class="modal fade" id="editCustomerType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Edit customer type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        ID<input type="text" class="form-control" id="edit_unit" name="edit_unit" disabled>
        <div class="form-group">
        Unit name<input type="text" class="form-control" id="edit_ct_name" name="edit_ct_name" >
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
<div class="modal fade" id="deleteCustomerType"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-primary" id="deleteUnit">Yes</button>
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

        fetchCustomerType();
        function fetchCustomerType(){
            $.ajax({
                type: "GET",
                url: "fetchCustomerType",
                dataType: "json",
                success: function (response){
                    $('tbody').html("");
                    $.each(response.data, function(key,item){
                        $('tbody').append('<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.customer_type_name+'</td>\
                            <td><button type="button" id="edit" value="'+item.id+'" class="btn btn-sm btn-info ml-1">Edit</button>  <button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#deleteCatagory">Delete</button></td>\
                        </tr>');
                    });
                }
            });
        }

        // $(document).on('click','#submit', function () {
        //     var data = {'unit_name': $('#unit_name').val()}
        //     $.ajax({
        //         type: "POST",
        //         url: "unit",
        //         data: data,
        //         dataType: "json",
        //         success: function (response) {
        //             if(response.status==500){
        //             console.log(response.error);
        //         }
        //         fetchUnit();
        //         $("#unit_name").val('');
        //         $('#addUnit').modal('hide')
        //         }
        //     });
        // });
    });
</script>
@endsection
@endsection
@endsection