@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
</style>
@section('content')

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
                      <thead style="background-color: #76808e;">
                        <tr>
                          <th scope="col">Order id</th>
                          <th scope="col">Batch</th>
                          <th scope="col">Order date</th>
                          <th scope="col">Item</th>
                          <th scope="col">Customer</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Total price</th>
                          <th scope="col">Amount due</th>
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

  {{-- modal --}}
  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      
      <div class="modal-content">
          <div id="printThis">
          <body>
                <div >
                  <!-- Content Header (Page header) -->
                  <section class="content-header">
                    <div class="container-fluid">
                      <div class="row mb-2">
                        <div class="col-sm-6">
                          <h1>Invoice</h1>
                        </div>
                        <div class="col-sm-6">
                          {{-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Invoice</li>
                          </ol> --}}
                          <ol class="breadcrumb float-lg-right">
                          <div class="row no-print">
                              <div class="col-12">
                                  {{-- window.print();return false; --}}
                                <button type="button" id="print" onclick="window.print()" rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                              </div>
                            </div>
                          </ol>
                        </div>
                        
                      </div>
                    </div><!-- /.container-fluid -->
                  </section>
              
                  <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
              
              
                          <!-- Main content -->
                          <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                              <div class="col-12">
                                <h4>
                                  <i class="fas fa-globe"></i> MyPharma
                                  <small class="float-right" id="small"></small>
                                </h4>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                              <div class="col-sm-4 invoice-col">
                                From
                                <address >
                                    <strong>MyPharma</strong><br>
                                    Guwahati, Paltan Bazar<br>
                                    Kamrup-metropolitan, Assam<br>
                                    Phone: (555) 539-1037<br>
                                    Email: MyPharma@gmail.com
                                </address>
                              </div>
                              <!-- /.col -->
                              
                              <!-- /.col -->
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
              
                            <!-- Table row -->
                            <div class="row">
                              <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                  <tr>
                                    <th>Qty</th>
                                    <th>Product</th>

                                    <th>Subtotal</th>
                                  </tr>
                                  </thead>
                                  <tbody id="print-details">
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
              
                            <div class="row">
                              <div class="col-6">
                                <div class="table-responsive">
                                  <table class="table" id="finalTable">
                                    <tr>
                                    
                                  </table>
                                </div>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
              
                            <!-- this row will not appear when printing -->
                            
                          </div>
                          <!-- /.invoice -->
                        </div><!-- /.col -->
                      </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                  </section>
                  <!-- /.content -->
                </div>
  
              
            </body>
        </div>
            <div class="modal-footer">
                <button type="button" onclick="window.location.reload()" id="closeModal">Close</button>
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

    fetchSale();
    function fetchSale(){
        $.ajax({
            type: "get",
            url: "fetchSales",
            dataType: "json",
            success: function (response) {
                $.each(response.data, function (indexInArray, valueOfElement) { 
                    var customer = response.customer[indexInArray];
                    if(customer == null){
                        var batch = response.batch[indexInArray];
                    var medicine = response.medicine[indexInArray];
                    $('tbody').append('<tr><td class="data">' +valueOfElement.order_id + '</td><td>' + batch + '</td><td>' + valueOfElement.created_at + '</td><td>' + medicine + '</td><td> Walk-in </td><td>' + valueOfElement.quantity + '</td><td>' + valueOfElement.total_price + '</td><td>' + valueOfElement.due + '</td><td><button type="button" id="print"  rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button></td></tr>');
                    }
                    else{
                        var batch = response.batch[indexInArray];
                    var medicine = response.medicine[indexInArray];
                    $('tbody').append('<tr><td class="data">' +valueOfElement.order_id + '</td><td>' + batch + '</td><td>' + valueOfElement.created_at + '</td><td>' + medicine + '</td><td>' + customer + '</td><td>' + valueOfElement.quantity + '</td><td>' + valueOfElement.total_price + '</td><td>' + valueOfElement.due + '</td><td><button type="button" id="print"  rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button></td></tr>');
                    }
                });
            }
        });
    }
    $(document).on('click','#print', function () {
      $('#invoice').empty();
            $('#print-details').empty();
            $('#small').empty();
            $('#finalTable').empty();
      var table = $(this).closest('tr').find('td.data').text();
      $.ajax({
        type: "get",
        url: "generatepdf/"+table,
        dataType: "json",
        success: function (response) {
          $.each(response.data, function (indexInArray, valueOfElement) { 
                                    // var medicine = response.meds[indexInArray];
                                    $('#invoice').append('<b>Invoice '+response.invoice+'</b>');
                                    $('#print-details').append('<tr><td>'+valueOfElement.quantity+'</td><td>medicine</td><td>'+valueOfElement.total_price+'</td></tr>');
                                    $('#small').append(valueOfElement.pur);
                                    
                                });
                                $('#finalTable').append('<tr><th style="width:50%">Subtotal: </th><td>'+response.total+'</td></tr><tr><th>Tax(GST) </th><td>'+response.tax+'</td></tr><tr><th>Total:</th><td>'+response.total+'</td></tr>')
                                $('.bd-example-modal-lg').modal('show');
        }
      });
      console.log(table)
    });

    });
  </script>
@endsection