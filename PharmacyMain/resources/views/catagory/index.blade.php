@extends('layouts.app')

@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Medicine Catagory</h1>
        <div class="card-tools">
                <div class="input-group-append">
                <button type="submit" class="btn-default" data-toggle="modal" data-target="#addCatagory" id="add_catagory">
                Add catagory
                </button>
                </div>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Catagory name</th>
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

{{-- add catagory --}}
<div class="modal fade" id="addCatagory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id" name="id" value="" >
        <div class="form-group">
        Catagory name<input type="text" class="form-control" id="cat_name" name="cat_name" >
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

{{-- edit catagory --}}
<div class="modal fade" id="editCatagory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Edit catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        ID<input type="text" class="form-control" id="edit_id" name="edit_id" disabled>
        <div class="form-group">
        Catagory name<input type="text" class="form-control" id="edit_name" name="cat_name" >
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
<div class="modal fade" id="deleteCatagory"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
        <button type="button" class="btn btn-primary" id="deleteCatagory">Yes</button>
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

    fetchCatagory();
    function fetchCatagory(){
        $.ajax({
            type: "GET",
            url: "fetch",
            dataType: "json",
            success: function (response) {
                $('tbody').html("");
                $.each(response.catagory , function(key,item){
                    $('tbody').append('<tr>\
                    <td>'+item.id+'</td>\
                    <td>'+item.cat_name+'</td>\
                    <td><button type="button" id="edit" value="'+item.id+'" class="btn btn-sm btn-info ml-1">Edit</button>  <button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#deleteCatagory">Delete</button></td>\
                    </tr>');
                });
                
            }
        });
    }

    // add catagory
    $(document).on('click','#submit', function (e) {
        e.preventDefault();
        var data = { 'cat_name': $('#cat_name').val() }
        $.ajax({
            type: "POST",
            url: "catagory",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response.status);
                if(response.status==500){
                    alert(response.error);
                }
                fetchCatagory();
                $("#cat_name").val('');
                $('#addCatagory').modal('hide');
            }
        });
    });

    // edit catagory
    $(document).on('click','#edit', function (e) {
        e.preventDefault();
        $('#editCatagory').modal('show');
        var id = $(this).val();
        $.ajax({
            type: "GET",
            url: "catagory/"+id+"/edit",
            dataType: "json",
            success: function (response) {
                $('#edit_id').val(response.message.id),
                $('#edit_name').val(response.message.cat_name);
            }
        });
    });
    // update
    $(document).on('click','#update', function (e) {
        e.preventDefault();
        var id = $('#edit_id').val();
        var data = {'cat_name':$('#edit_name').val()}
        $.ajax({
            type: "PUT",
            url: "catagory/"+id,
            data: data,
            dataType: "json",
            success: function (response) {
                $('#editCatagory').modal('hide');
                fetchCatagory();
            }
        });
    });

    // delete
    $(document).on('click','#deleteCatagory', function (e) {
        e.preventDefault();
        var id = $('#deleteData').val();
        $.ajax({
            type: "DELETE",
            url: "catagory/"+id,
            dataType: "json",
            success: function (response) {
                fetchCatagory();
                $('#deleteCatagory').modal('hide');
            }
        });
    });
});

</script>
@endsection
@endsection