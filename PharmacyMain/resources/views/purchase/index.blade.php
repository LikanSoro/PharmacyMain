@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('styles')
<link href="{{ asset('css/style.css')}}" rel="stylesheet" >
<style>
@media screen {
  #printSection {
      display: none;
  }
}

@media print {
    .modal-lg{
    max-width: 100%;
    width: 100%;
}

  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}
#nonPrintable{
  background:green;
  display: flex;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
  }
  
  .form-group.col-6, .form-group.col-7, .form-group.col-5, .form-group.col-4 {
    width: 100%;
    max-width: 250px; /* Adjust the width as per your requirements */
  }
  
  .form-group.col-4 {
    flex: 0 0 30%; /* Adjust the flex value as per your requirements */
  }
  
  .form-control {
    width: 100%;
  }
  #nonPrintable{
    display:relative;
  }
  #man{
    background:wheat;
    height: 20rem;
    width:30rem;

  }
  #nonPrintable, .container{
    /* float:right; */
    display:flex;
    width:70rem;
    height:20rem;
    background: powderblue
  }
  .container2{
    justify-content: left;
    margin-left: auto;
    margin-bottom:2px;
  }
  input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
@endsection
@section('content')
<div class="content" id="nonPrintable">
  <div class="form-group col-6 " id="man">
    <div class="form-group col-7" >
        Supplier
        <select class="form-control" aria-label="Default select example" name="manufacturer" id="manufacturer">
            <option selected>Select supplier</option>
            @foreach ($manufacturer as $m)
            <option value="{{$m->id}}">{{$m->m_name}}</option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group col-7" >
        Purchase date<input type="text" class="form-control" id="p_date" name="p_date" width="50px" placeholder="{{$dt}}" value="{{$dt}}">
    </div>
    <div class="form-group col-7" >
        Invoice number<input type="text" class="form-control" id="invoice" name="invoice" width="70px">
    </div>
  </div>
    

<div class="row">
 
    <div class="form-group col-6" id="item">item
        <select class="form-control" aria-label="Default select example" id="medicine" name="medicine">
            <option selected>Select item</option>
            <option value=""></option>
        </select>
    </div>
    <div class="form-group col-4" id="pur">
        Batch no.<input type="text" class="form-control" id="b_num" name="b_num" width="70px">
    </div>
    <div class="form-group col-4" id="pur">
        Expiry date<input type="date" class="form-control" id="expiry_date" name="expiry_date" width="70px">
    </div>
    <div class="form-group col-4" id="pur">
        Available Stock/Qnt<input type="text" class="form-control" id="stock" name="stock" value="" disabled>
    </div>
    <div class="form-group col-4" id="pur">
        Quantity<input type="number" class="form-control" id="quantity" name="quantity" width="70px">
    </div>
    <div class="form-group col-4" id="pur">
        MRP<input type="number" class="form-control" id="mrp" name="mrp" width="70px" >
    </div>
    <div class="form-group col-4" id="rate">
        Buy price/Rate<input type="number" class="form-control" id="unit_price" name="unit_price" width="70px" >
    </div>
    <div class="form-group col-4" id="pur">
        Discount(%)<input type="number" class="form-control" id="discount" name="discount" width="70px" >
    </div>
    <div class="form-group col-4" id="pur">
        GST(%)<input type="number" class="form-control" id="tax" name="tax" width="70px" >
    </div>
    <div class="form-group col-4" id="pur">
        Free<input type="number" class="form-control" id="free" name="free" width="70px" >
    </div>
    <div class="form-group col-3" id="price">
        Total price<input type="text" class="form-control" id="total_price" name="total_price" width="70px" disabled>
    </div>
    <div class="form-group col-6" id="description">
        Description<input type="text" class="form-control" id="desc" name="desc" width="70px">
    </div>
    <div class="card-tools">
        <div class="input-group-append">
        <button type="submit" class="btn btn-primary"  id="submit">
        Submit
        </button>
    </div>
</div>
</div>
</div>

  {{-- print modal --}}
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
                              <button type="button" id="print"  rel="noopener"  class="btn btn-default"><i class="fas fa-print"></i> Print</button>
                              {{-- <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                Payment
                              </button> --}}
                              {{-- <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                              </button> --}}
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
                              <address id="supplier">
                                {{-- <strong></strong><br>
                                <br>
                                San Francisco, CA 94107<br>
                                Phone: (804) 123-5432<br>
                                Email: info@almasaeedstudio.com --}}
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                              To
                              <address>
                                <strong>MyPharma</strong><br>
                                Guwahati, Paltan Bazar<br>
                                Kamrup-metropolitan, Assam<br>
                                Phone: (555) 539-1037<br>
                                Email: MyPharma@gmail.com
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col" id="invoice">
                              {{-- <br> --}}
                              {{-- <br> --}}
                              {{-- <b>Order ID:</b> 4F3S8J<br> --}}
                              {{-- <b>Payment Due:</b> 2/22/2014<br> --}}
                              {{-- <b>Account:</b> 968-34567 --}}
                            </div>
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
                                  <th>Free</th>
                                  <th>Description</th>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
    </div>

  </div>
  
</div>

{{-- invoice --}}
<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:goldenrod">Warning!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>Invoice type not created yet</h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="button" onclick="window.location.href='{{url('invoice')}}'" class="btn btn-primary" id="newInvoice">Create invoice type</button>
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

        document.getElementById("print").onclick = function () {
        printElement(document.getElementById("printThis"));
        }
        function printElement(elem) {
        var domClone = elem.cloneNode(true);
    
        var $printSection = document.getElementById("printSection");
    
        if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
        }
    
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
        }


        $('#manufacturer').change(function (e) { 
            e.preventDefault();
            var data = $('#manufacturer').val();
            $('#medicine').empty();
            $('#medicine').append('<option value="">Fetching items...</option>')
            $.ajax({
                type: "get",
                url: "getMedicines/"+data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        $('#medicine').empty();
                        $('#medicine').append('<option value="">Select item</option>')
                        $.each(response.data, function(key,item){
                        $('#medicine').append('<option value="'+item.id+'">'+item.med_name+'('+item.strength+')"</option>');
                    });
                    }
                    else{
                        $('#medicine').empty();
                        $('#medicine').append('<option value="">No items available</option>');
                    }
                }
            });
        });

        $('#medicine').change(function(e){
            e.preventDefault();
            var med = $('#medicine').val();
            $('#stock').empty();
            $('#stock').val('fetching stocks...');
            $.ajax({
                type: "get",
                url: "getQuantity/"+med,
                dataType: "json",
                success: function (response) {
                    if(response.status == 200){
                        $('#stock').empty();
                        $('#stock').val(response.quantity);
                    }
                    else if(response.status == 100){
                        $('#stock').empty();
                        $('#stock').val(response.data);
                    }
                    else{
                        $('#stock').empty();
                        $('#stock').val(0);
                    }
                }
            });
        });
            $(document).on('click','#submit', function (e) {
                e.preventDefault();
                var data = {'manufacturer':$('#manufacturer').val(),
                'p_date':$('#p_date').val(),
                'invoice':$('#invoice').val(),
                'medicine':$('#medicine').val(),
                'batch_number':$('#b_num').val(),
                'expiry_date':$('#expiry_date').val(),
                'quantity':$('#quantity').val(),
                'unit_price':$('#unit_price').val(),
                'total_price':$('#total_price').val(),
                'desc':$('#desc').val(),
                'mrp':$('#mrp').val(),
                'tax':$('#tax').val(),
                'free':$('#free').val(),
                'discount':$('#discount').val()}
                $('#supplier').empty();
      $('#invoice').empty();
$('#print-details').empty();
        $('#small').empty();
   $('#finalTable').empty();
                $.ajax({
                    type: "POST",
                    url: "purchase",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if(response.status == 200){
                            console.log(response);
                        Command: toastr["success"]("Medicine added successfully");

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

            // print
            
            $('#supplier').append('<strong>'+response.manufacturer+'</strong><br>'+response.address+'<br>Phone: '+response.phone+'<br>Email: '+response.email+'');
            $('#invoice').append('<b>Invoice '+response.invoice+'</b>');
            $('#print-details').append('<tr><td>'+response.quantity+'</td><td>'+response.medicine+'</td><td>'+response.free+'</td><td>'+response.description+'</td><td>'+response.total+'</td></tr>');
            $('#small').append(response.pur);
            $('#finalTable').append('<tr><th style="width:50%">Subtotal: </th><td>'+response.total+'</td></tr><tr><th>Tax(GST) </th><td>'+response.tax+'</td></tr><tr><th>Total:</th><td>'+response.total+'</td></tr>')
            $('.bd-example-modal-lg').modal('show');

                $('#manufacturer').val('');
                        $('#invoice').val('')
                        $('#medicine').val('');
                        $('#b_num').val('');
                        $('#expiry_date').val('');
                        $('#quantity').val('');
                        $('#unit_price').val('');
                        $('#total_price').val('');
                        $('#desc').val('');
                        }
                        else if(response.status == 500){
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
                          $('#invoiceModal').modal('show');
                        }
                    }
                });
            });

            $(document).on('input','#discount',function(e){
                e.preventDefault();
                var data = {'quantity':$('#quantity').val(),
                'unit_price':$('#unit_price').val(),
                'discount':$('#discount').val(),
                'tax':$('#tax').val()
            }
                $.ajax({
                    type: "GET",
                    url: "unitPrice",
                    data: data, 
                    dataType: "json",
                    success: function (response) {
                        $('#total_price').val(response);
                    }
                });
            });
            $(document).on('input','#tax',function(e){
                e.preventDefault();
                var data = {'quantity':$('#quantity').val(),
                'unit_price':$('#unit_price').val(),
                'discount':$('#discount').val(),
                'tax':$('#tax').val()
            }
                $.ajax({
                    type: "GET",
                    url: "unitPrice",
                    data: data, 
                    dataType: "json",
                    success: function (response) {
                        $('#total_price').val(response);
                    }
                });
            });
            $(document).on('input','#quantity',function(e){
                e.preventDefault();
                var data = {'quantity':$('#quantity').val(),
                'unit_price':$('#unit_price').val(),
                'discount':$('#discount').val(),
                'tax':$('#tax').val()
            }
                $.ajax({
                    type: "GET",
                    url: "unitPrice",
                    data: data, 
                    dataType: "json",
                    success: function (response) {
                        $('#total_price').val(response);
                    }
                });
            });
            $(document).on('input','#unit_price',function(e){
                e.preventDefault();
                var data = {'quantity':$('#quantity').val(),
                'unit_price':$('#unit_price').val(),
                'discount':$('#discount').val(),
                'tax':$('#tax').val()
            }
                $.ajax({
                    type: "GET",
                    url: "unitPrice",
                    data: data, 
                    dataType: "json",
                    success: function (response) {
                        $('#total_price').val(response);
                    }
                });
            });
            // nav-links highlight
            var links = document.querySelectorAll('.nav-link');
            const link = document.querySelector('[href="{{ url('purchase') }}"]');
            for(var i=0; i<=links.length; i++){
            $('.nav-link').removeClass("active");
            }
            $(link).addClass("active");
    
    });
</script>
<script>
    function printModal(){
        var divContents = document.getElementById("printModalDiv").innerHTML;
            var a = window.open('', '', 'height=1000, width=1000');
            a.document.write(divContents);
            a.document.close();
            a.print();
    }
</script>

@endsection
@endsection