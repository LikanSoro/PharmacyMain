@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
        <h1 class="card-title">Supplier</h1>
        <div class="card-tools">
                <div class="input-group-append">
                <button type="submit" class="btn-default" data-toggle="modal" data-target="#addManufacturer" id="add_manufacturer">
                Add Supplier
                </button>
                </div>
        </div>
        </div>
        <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
            <tr>
                <th>ID</th>
                <th>Supplier name</th>
                <th>Supplier phone</th>
                <th>Supplier email</th>
                <th>Supplier address</th>
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

{{-- add Manufacturer --}}
<div class="modal fade" id="addManufacturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Add Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form>
        <input type="hidden" class="form-control" id="id" name="id" value="" >
        <div class="form-group">
        Name<input type="text" class="form-control" id="name" name="name" >
        </div>
        <div class="form-group">
        Email id<input type="text" class="form-control" id="email" name="email" >
        </div>
        <div class="form-group">
        Phone number<input type="text" class="form-control" id="phone" name="phone" >
        </div>
        <div class="form-group">
        Address<input type="text" class="form-control" id="address" name="address" >
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

{{-- edit Manufacturer --}}
<div class="modal fade" id="editManufacturer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="">Edit Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form>
            <input type="hidden" class="form-control" id="id" name="id" value="" >
            <div class="form-group">
            Name<input type="text" class="form-control" id="edit_name" name="edit_name" >
            </div>
            <div class="form-group">
            Email id<input type="text" class="form-control" id="edit_email" name="edit_email" >
            </div>
            <div class="form-group">
            Phone number<input type="text" class="form-control" id="edit_phone" name="edit_phone" >
            </div>
            <div class="form-group">
            Address<input type="text" class="form-control" id="edit_address" name="edit_address" >
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
<div class="modal fade" id="deleteSupplier"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

        fetchManufacturer();
        function fetchManufacturer(){
            $.ajax({
                type: "GET",
                url: "fetchManufacturer",
                dataType: "json",
                success: function (response){
                    $('tbody').html("");
                    $.each(response.manufacturer, function(key,item){
                        $('tbody').append('<tr>\
                            <td>'+item.id+'</td>\
                            <td>'+item.m_name+'</td>\
                            <td>'+item.m_phone+'</td>\
                            <td>'+item.m_email+'</td>\
                            <td>'+item.m_address+'</td>\
                            <td><button type="button" id="edit" value="'+item.id+'" class="btn btn-sm btn-info ml-1">Edit</button>  <button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" >Delete</button></td>\
                        </tr>');
                    });
                }
            });
        }

        $(document).on('click','#submit', function () {
            var data = {'name': $('#name').val(),
                        'email':$('#email').val(),
                        'phone':$('#phone').val(),                
                        'address':$('#address').val()                             
        }
            $.ajax({
                type: "POST",
                url: "manufacturer",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status==500){
                    console.log(response.error);
                }
                fetchManufacturer();
                $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#address").val('');
                $('#addManufacturer').modal('hide')
                }
            });
        });




        function makeRowEditable(row) {
  row.find('td:not(:last-child)').attr('contenteditable', 'true'); // Make all <td> elements editable except the last one
  row.find('#edit').text('Save').addClass('btn-success').removeClass('btn-info'); // Change the Edit button to Save button
}

// Function to make a row non-editable
function makeRowNonEditable(row) {
  row.find('td:not(:last-child)').removeAttr('contenteditable'); // Make all <td> elements non-editable
  row.find('#edit').text('Edit').addClass('btn-info').removeClass('btn-success'); // Change the Save button to Edit button
}

// Event handler for the Edit button
$('tbody').on('click', '#edit', function() {
  var row = $(this).closest('tr'); // Find the closest <tr> element
  
  if ($(this).text() === 'Edit') {
    makeRowEditable(row); // Make the row editable if the button text is Edit
  } else {
    // Save the changes if the button text is Save
    var id = row.find('td:eq(0)').text();
    var name = row.find('td:eq(1)').text();
    var phone = row.find('td:eq(2)').text();
    var email = row.find('td:eq(3)').text();
    var address = row.find('td:eq(4)').text();

    // Perform the AJAX request to update the data in the database
    $.ajax({
      type: "PUT",
      url: "manufacturer/"+id,
      data: {
        id: id,
        name: name,
        phone: phone,
        email: email,
        address: address
      },
      dataType: "json",
      success: function(response) {
        makeRowNonEditable(row);
        alert('edited'); // Make the row non-editable after saving the changes
      }
    });
  }
});

// Event handler for the Delete button
$('tbody').on('click', '#deleteData', function() {
  var row = $(this).closest('tr'); // Find the closest <tr> element
  var id = $(this).val(); // Get the ID of the record to delete

  // Set up the confirmation dialog
  $('#deleteSupplier').modal('show'); // Show the confirmation modal

  // Event handler for the Delete confirmation button
  $('#delete').on('click', function() {
    // Perform the AJAX request to delete the record
    $.ajax({
      type: "delete",
      url: "manufacturer/"+id,
      dataType: "json",
      success: function(response) {
        row.remove(); // Remove the row from the table
        $('#deleteSupplier').modal('hide'); // Hide the confirmation modal
        $('tbody').html("");
        fetchManufacturer();
      }
    });
  });
});

// Function to save the row data
// function saveRowData(row) {
//   var id = row.find('td:eq(0)').text();
//   var name = row.find('td:eq(1)').text();
//   var phone = row.find
// }


});

</script>
@endsection
@endsection