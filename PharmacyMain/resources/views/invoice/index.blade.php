@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<section class="intro">
  <div class="container">
    <div class="form-group ">
      <select class="form-select" aria-label="Default select example" id="catagory" >
          <option selected data-mdb-icon="https://mdbootstrap.com/img/Photos/Avatars/avatar-1.jpg"><p class="lead">Select invoice type...</p></option>
          <option value="1">Customer</option>
          <option value="2">Supplier</option>
      </select>
  </div>
  </div>
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
                          <th scope="col">Invoice type</th>
                          <th scope="col">User</th>
                          <th scope="col">Invoice no</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
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

  {{-- print --}}
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

            fetchInvoice();
            function fetchInvoice(){
                $.ajax({
                    type: "get",
                    url: "fetchInvoice",
                    dataType: "json",
                    success: function (response) {
                        $.each(response.data, function(index, valueOfElement) {
                var invoice = response.invoice[index];
                $('tbody').append('<tr><td>'+invoice+'</td><td>'+valueOfElement.user+'</td><td>'+valueOfElement.invoive_no+'</td><td><button type="button" onclick="window.print()" id="print"  rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button></td></tr>');
                });
                    }
                });
            }

            $('#catagory').change(function (e) { 
              $('tbody').empty();
              e.preventDefault();
              var value = $(this).val();
              $.ajax({
                type: "get",
                url: "invoiceData/"+value,
                dataType: "json",
                success: function (response) {
                  $.each(response, function(index, valueOfElement) {
                // var invoice = response.invoice[index];
                $('tbody').append('<tr><td>'+valueOfElement.name+'</td><td>'+valueOfElement.user+'</td><td>'+valueOfElement.invoive_no+'</td><td><button type="button" onclick="window.print()" id="print"  rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button></td></tr>');
                });
                // console.log(response);
                }
              });
            });

    });
  </script>
@endsection