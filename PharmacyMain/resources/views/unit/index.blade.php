@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Unit of measurement</h1>
        <div class="card-tools">
                <div class="input-group-append">
                <button type="submit" class="btn-default" data-toggle="modal" data-target="#addUnit" id="add_unit">
                Add unit
                </button>
                </div>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Unit name</th>
                {{-- <th>loose sell</th> --}}
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
<div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id" name="id" value="" >
        <div class="form-group">
        unit name<input type="text" class="form-control" id="unit_name" name="unit_name" >
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
<div class="modal fade" id="editUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Edit unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        ID<input type="text" class="form-control" id="edit_unit" name="edit_unit" disabled>
        <div class="form-group">
        Unit name<input type="text" class="form-control" id="edit_name" name="cat_name" >
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="edit_loose_unit1" id="edit_loose_unit1">
            <label class="form-check-label" for="edit_loose_unit1">
            Can be sold loosely .
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="edit_loose_unit2" id="edit_loose_unit2" checked>
            <label class="form-check-label" for="edit_loose_unit2">
            Cannot be sold loosely .
            </label>
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
<div class="modal fade" id="deleteUnit"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

        fetchUnit();
        function fetchUnit(){
            $.ajax({
                type: "GET",
                url: "fetchUnit",
                dataType: "json",
                success: function (response){
                    $('tbody').html("");
                    $.each(response.units, function(key,item){
                        $('tbody').append('<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.unit_name+'</td>\
                            <td><button type="button" id="edit" value="'+item.id+'" class="btn btn-sm btn-info ml-1">Edit</button>  <button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#deleteCatagory">Delete</button></td>\
                        </tr>');
                    });
                }
            });
        }

        $(document).on('click','#submit', function () {
            var data = {'unit_name': $('#unit_name').val()}
            $.ajax({
                type: "POST",
                url: "unit",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status==500){
                    console.log(response.error);
                }
                fetchUnit();
                $("#unit_name").val('');
                $('#addUnit').modal('hide')
                }
            });
        });
    });
</script>
@endsection
@endsection