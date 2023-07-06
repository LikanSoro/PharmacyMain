@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<style>
    /* Custom styling for radio buttons and submit button */
    .form-check input[type="radio"],
    .btn-submit {
      display: none;
    }
  
    .form-check input[type="radio"] + label,
    .btn-submit {
      display: inline-block;
      padding: 10px 20px;
      background-color: #f2f2f2;
      color: #333;
      font-weight: 600;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
  
    .form-check input[type="radio"]:checked + label,
    .btn-submit:hover {
      background-color: #007bff;
      color: #fff;
    }

    .btn-submit {
  border: none; /* Remove the button border */
  background-color: #ff7f50; /* Set the button color */
}
  </style>
  
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="mb-3">
          <label for="invoiceType" class="form-label">Invoice Type</label>
          <input type="text" class="form-control" value="" id="invoiceType" placeholder="Enter invoice type">
        </div>
        <h6>Map to:</h6>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="radioOptions" id="customerRadio" value="customer">
          <label class="form-check-label" for="customerRadio">Customer</label>
        </div>
  
        <div class="form-check">
          <input class="form-check-input" type="radio" name="radioOptions" id="manufacturerRadio" value="manufacturer">
          <label class="form-check-label" for="manufacturerRadio">Supplier</label>
        </div>
  
        <div class="mt-3">
          <button type="submit" class="btn-submit" id="submit">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-5">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Invoice Type</th>
              <th scope="col">Mapped With</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="dd">
            <!-- Table rows can be dynamically added here -->
          </tbody>
        </table>
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
        var numRows = $("#dd").length;

        console.log("Total number of table rows: " + numRows);
        fetchInvoice();
        function fetchInvoice(){
          $('#dd').html("");
            var selectedValue = $('input[name=radioOptions]:checked').val();
            $.ajax({
                type: "get",
                url: "fetchInvoiceType",
                dataType: "json",
                success: function (response) {
                    
                    $.each(response, function(key,item){
                        if(item.mapped_to == 1){
                          
                            $('#dd').append('<tr>\
                            <td>'+item.name+'</td>\
                            <td>Customer</td>\
                            <td><button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" data-toggle="modal" data-target="#deleteCatagory">Delete</button></td></tr>');
                            numRows += 1;
                          }
                        else{
                          // $('#dd').html("");
                            $('#dd').append('<tr>\
                            <td>'+item.name+'</td>\
                            <td>Supplier</td>\
                            <td><button type="button" id="deleteData" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" >Delete</button></td></tr>');
                          }
                        
                    });
                }
            });
        }

        $('#submit').on('click', function () {
            var selectedValue = $('input[name=radioOptions]:checked').val();
            var data = $('#invoiceType').val();
            $.ajax({
                type: "post",
                url: "invoiceStore",
                data: {name:data , 'map':selectedValue },
                dataType: "json",
                success: function (response) {
                  if(response.status == 400){
                        Swal.fire(
                        'Oops!',
                        'You cannot add more than two invoice types',
                        'customer/manufacturer'
                        )
                    }
                    else{
                      fetchInvoice();
                      Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Invoice type added',
                      showConfirmButton: false,
                      timer: 1500
                      })
                      $('#invoiceType').val('');
                    
                    }
                  
                }
            });
            // console.log(selectedValue);
        });
        $(document).on('click','#deleteData', function () {
          const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    swalWithBootstrapButtons.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success')
      var id = $(this).val();
          $.ajax({
            type: "post",
            url: "deleteInvoiceType/"+id,
            dataType: "json",
            success: function (response) {
              fetchInvoice();
            }
          });
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
        });
    });
</script>
@endsection