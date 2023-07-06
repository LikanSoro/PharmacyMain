@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@section('styles')

    <style>
html,
body,
.intro {
  height: 100%;
}

table td,
table th {
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
}

thead th {
  color: #fff;
}

.card {
  border-radius: .5rem;
}

.table-scroll {
  border-radius: .5rem;
}

.table-scroll table thead th {
  font-size: 1.25rem;
}
thead {
  top: 0;
  position: sticky;
}

#content {
  border: 1px solid #ccc;
  padding: 6px 12px;
  border-radius: 4px;
  background-color: #f9f9f9;
  cursor: text;
}

#content[contenteditable="true"] {
  background-color: #ffffff;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

body {
  font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}
</style>

@endsection
<section class="intro">
    <div class="bg-image h-100" style="background-color: #f5f7fa;">
      <div class="mask d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card">
                <div class="card-body p-0">
                  <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                    <table class="table table-striped mb-0">
                      <thead style="background-color: #505e72;">
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Catagory</th>
                          <th scope="col">Unit of measurement</th>
                          <th scope="col">manufacturer</th>
                          <th scope="col">Generic name</th>
                          <th scope="col">strength</th>
                          <th scope="col">Details</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        fetchMedicine();
        function fetchMedicine(){
            $.ajax({
                type: "GET",
                url: "fetchMedicine",
                dataType: "json",
                success: function (response) {
                    $('tbody').html("");
                    $.each(response.med, function (key, item) { 
                        $('tbody').append('<tr>\
                                        <td ><div id="content1" class="item1">'+item.med_name+'</div></td>\
                                        <td ><div id="content1" class="item2">'+item.catagory.cat_name+'</div></td>\
                                        <td ><div id="content1" class="item3">'+item.units.unit_name+'</div></td>\
                                        <td ><div id="content1" class="item4" value="'+item.manufacturer.id+'">'+item.manufacturer.m_name+'</div></td>\
                                        <td ><div id="content" class="item5">'+item.generic_name+'</div></td>\
                                        <td ><div id="content" class="item6">'+item.strength+'</div></td>\
                                        <td ><div id="content" class="item7">'+item.details+'</div></td>\
                                        <td><button type="button" id="edit" value="'+item.id+'" class="btn btn-sm btn-info ml-1">Edit</button>  <button type="button" id="deleteData1" value="'+item.id+'" class="btn btn-sm btn-danger ml-1" >Delete</button></td>\
                                    </tr>');
                });
            }
            });
            }
            $(document).on('click','#deleteData1', function () {
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
      'Your item has been deleted.',
      'success'
    )
    var id = $(this).val();
                  $.ajax({
                    type: "delete",
                    url: "medicine/"+id,
                    dataType: "json",
                    success: function (response) {
                      fetchMedicine();
                    }
                  });

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your item is not deleted :)',
      'error'
    )
  }
})
                });



            $(document).on('click','#edit', function () {
                var id = $(this).val();
                $(this).closest('tr').find('td #content').attr('contenteditable', true);
                $(this).closest('tr').find('td div').focus();
                $(this).closest('tr').find('#edit').text("Save")
                    $(this).closest('tr').find('#edit').removeClass("btn-info")
                    $(this).closest('tr').find('#edit').addClass("btn-success");
                    $(this).closest('tr').find('#edit').removeAttr('id');
                    $(this).closest('tr').find('.btn-success').attr('id','save');

                $(document).on('click','#save', function () {
                    var data = {
                    'med_name':$(this).closest('tr').find('.item1').text(),
                    'catagory':$(this).closest('tr').find('.item2').text(),
                    'unit':$(this).closest('tr').find('.item3').text(),
                    'manufacturer':$(this).closest('tr').find('.item4').text(),
                    'strength':$(this).closest('tr').find('.item6').text(),
                    'details':$(this).closest('tr').find('.item7').text(),
                    'generic':$(this).closest('tr').find('.item5').text()
                }

                $(this).closest('tr').find('#save').removeClass("btn-success")
                    $(this).closest('tr').find('#save').addClass("btn-info");
                    $(this).closest('tr').find('#save').removeAttr('id');
                    $(this).closest('tr').find('.btn-info').attr('id','edit');
                    $(this).closest('tr').find('#edit').text("Edit");
                    $(this).closest('tr').find('td #content').attr('contenteditable', false);
                $.ajax({
                    type: "PUT",
                    url: "medicine/"+id,
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        alert('saved');
                        fetchMedicine();
                    }
                });
                });

                
//                 $('#deleteData').on('click', function () {
//                   alert('hey');
//                   const swalWithBootstrapButtons = Swal.mixin({
//   customClass: {
//     confirmButton: 'btn btn-success',
//     cancelButton: 'btn btn-danger'
//   },
//   buttonsStyling: false
// })

// swalWithBootstrapButtons.fire({
//   title: 'Are you sure?',
//   text: "You won't be able to revert this!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonText: 'Yes, delete it!',
//   cancelButtonText: 'No, cancel!',
//   reverseButtons: true
// }).then((result) => {
//   if (result.isConfirmed) {
//     swalWithBootstrapButtons.fire(
//       'Deleted!',
//       'Your item has been deleted.',
//       'success'
//     )
//     var id = $(this).val();
//                   $.ajax({
//                     type: "delete",
//                     url: "medicine/"+id,
//                     dataType: "json",
//                     success: function (response) {
                      
//                     }
//                   });

//   } else if (
//     /* Read more about handling dismissals below */
//     result.dismiss === Swal.DismissReason.cancel
//   ) {
//     swalWithBootstrapButtons.fire(
//       'Cancelled',
//       'Your item is not deleted :)',
//       'error'
//     )
//   }
// })

                  
//                 });

$(document).on('click', '#deleteData', function() {
    var itemId = $(this).val();
    alert(itemId);
    // Perform delete operation or any other desired action
    // using the itemId variable
    
    // For example, you can remove the entire table row:
    $(this).closest('tr').remove();
});
                

            });
    });
</script>
@endsection