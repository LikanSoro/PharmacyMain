@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('styles')
<style>
    .content1{
        height: 40rem;
        width: 45.5rem;
        background:rgb(189, 198, 200);
        float: right;
        margin-right: 10px;
        border: 1px solid #fcdede;
        margin-top: 5px;
        -webkit-box-shadow: 0 10px 6px -6px #777;
    -moz-box-shadow: 0 10px 6px -6px #777;
    box-shadow: 0 10px 6px -6px #777;
    border-radius: 5px;
    position: relative;

    }
    .content2{
        height: 40rem;
        width: 32rem;
        background:rgb(189, 198, 200);
        float:left;
        margin-left: 10px;
        margin-top: 5px;
        -webkit-box-shadow: 0 10px 6px -6px #777;
    -moz-box-shadow: 0 10px 6px -6px #777;
    box-shadow: 0 10px 6px -6px #777;
    border-radius: 5px;
    }
    .search_med{
        width: 15rem;
        margin-top: 7px;
        margin-left: 7px;
        float:left;
    }
    .search_med:hover{
        box-shadow: 0 8px 10px -6px #777;
    }
    .med_catagory{
        width:11rem;
        float:right;
        margin-top: 7px;
        margin-right: 15px;
    }
    .med_catagory:hover{
        box-shadow: 0 8px 10px -6px #777;
    }
    .container{
        background: rgb(247, 250, 252);
        height: 87%;
        width: 100%;
        display: flex;
        border-radius: 5px;
        padding: 10px;
        border: 1px solid rgb(233, 231, 231);
        flex-wrap: wrap;
        overflow: hidden;
        overflow-y: scroll;
    }
    .list{
        /* float:left; */
        height: 40%;
        width: 40%;
        background:rgb(214, 226, 239);
        margin-left: 10px;
        margin-top: 10px;
        border-radius: 5px;
        box-shadow: 0 6px 10px -6px #c0bfbf;
        /* display: inline-block; */
        padding: 10px;
        border: 1px solid rgb(227, 223, 223);
    }
    a {
    text-decoration: none;
    }

    .details{
        background: #aebece;
        display: flex;
        justify-content: center;
        border: 1px solid rgb(252, 251, 251);
        height: 3.6rem;

    }

    .batchSelect{
        height:8rem;
        width: 29rem;
        margin-right: 8px;
        background: rgb(240, 249, 240);
    }
    #formSelect{
        height:8rem;
    }
    .summary{
        height: 12rem;
        width:98%;
        background: rgb(191, 194, 197);
        position: absolute;
        bottom: 21px;
        margin-inline: auto;
        border-radius: 6px;
    }
    #bbb{
        height: 23rem;
        width: 44.6rem;
        background: white;
        position: absolute;
        overflow: hidden;
        overflow-y: scroll;
        margin-left: 7px;
        border-radius: 5px;
        margin-top: 5px;
    }
    .quantity{
        display: flex;
        justify-content: left;
        height: auto;
        margin-top: 12px;
        align-items: center;
    }
    .minus{
        background: rgb(145, 145, 245);
        border-radius: 50%;
        border:solid 0px #cbcaca;
        margin-right: 0.3rem;
    }
    .plus{
        background: rgb(145, 145, 245);
        border-radius: 50%;
        border:solid 0px #cbcaca;
        margin-left: 0.3rem;
    }
    .st{
        width: 5rem;
    }
    #h6{
        margin-right: 0.8rem;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    .item{
        width: 9rem;
    }
    .tab1 th{
        text-align: left;
        border-style: hidden;
    }
    .Item{
        display: flex;

        flex-direction: column;
        width: 12rem;
        height: 2.9rem;
        background:rgb(247, 250, 252);
        border:solid 1.5px #bcb7b7;
        border-radius: 3px;
        /* margin-left: px; */
        padding:0 1rem;
        line-height: 1.3rem;
    }
    .Qty{
        width: 6rem;
    }
    .Total_price{
        width: 9rem;
    }
    .add{
        margin-left: 5px;
    }
    .Qty{
        width: 6.5rem;
        height: 2.9rem;
        background:rgb(247, 250, 252);
        border:solid 1.5px #bcb7b7;
        border-radius: 3px;
        display: flex;
        justify-content: center;

    }
    .Total_price{
        width: 6.5rem;
        height: 2.9rem;
        background:rgb(247, 250, 252);
        border:solid 1.5px #bcb7b7;
        border-radius: 3px;
        display: flex;
        justify-content: center;
    }
    .Qty span{
        margin-top: 0.5rem;
        margin-right: 1rem;
    }
    .Total_price span{
        margin-top: 0.5rem;
        margin-right: 1rem;
    }
    .edit{
        align-content: center;
        margin-right: 5px;
    }
    .card {
  /* Set a fixed height for the card */
  overflow: hidden; /* Hide any overflow */
}

.table-container {
  height: 64.6%;
  overflow-y: auto; /* Enable vertical scrolling */
}
.sticky-header th {
  position: sticky;
  top: 0;
  background-color: #f8f9fa; /* Add background color to the sticky header */
  z-index: 1; /* Ensure the header is above the table body */
}
    .bottom-right {
            bottom: 0;
            right: 0;
            margin-right: 27px;
            margin-bottom: 12px;
        }
        .bottom-right button{
            height: 3rem;
            width: 10rem;
        }
        .bottom-left {
            bottom: 0;
            left: 0;
            margin-left: 2rem;
            margin-bottom: 12px;
        }
        .bottom-left button{
            height: 3rem;
            width: 10rem;
        }
    .total-count{
        margin-left:2rem;
        margin-top:0.6rem;
        margin-right:2rem;
        display: flex;
    }
    .total-count span{
        padding:4.6px;
        font-weight: bold;
    }
    .total-count span p{
        display: inline;
        float: right;
        height: 12px;;
        margin-right: 6px;
        font-weight: normal;
    }
    #order{
        width: 30rem;
        height: 3rem;
        justify-content: center;
        border-radius: 30px;
        margin-right: 2rem;
        background: rgb(122, 122, 142);
        border:none;
        box-shadow: 0 6px 20px -6px #fcf6f6;
    }
    #order:hover{
        box-shadow: 0 8px 10px -6px #777;
    }

    /* ordermodal */
    .total-count2{
        margin-left:2px;
        margin-top:0.6rem;
        margin-right:2rem;
        display: flex;
        margin-bottom: 20px;
    }
    .total-count2 span{
        padding:4.6px;
        font-weight: bold;
    }
    .total-count2 span p{
        display: inline;
        float: right;
        height: 12px;;
        margin-right: 6px;
        font-weight: normal;
    }
    
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

body {
  font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}

.Qty {
  display: flex;
  align-items: center;
  border: 1px solid #ccc;
  background-color: #fff;
}

.editableSpan {
  flex: 1;
  padding: 5px;
  text-align: center;
  width: 100%;
}
</style>
@endsection
@section('content')
<div class="d-flex col-12 justify-content-between flex-grow-1" style="height: 90vh">
<div class="card col-6">
    <div class="float-container">
    <div class="meds">
        <input type="text" class="form-control search_med" id="searchs"  placeholder="search medicines..."> 
    </div>
    <div class="meds">
    <div class="form-group med_catagory">
        <select class="form-select medsCatagory" aria-label="Default select example" id="catagory" name="catagory">
            <option selected data-mdb-icon="https://mdbootstrap.com/img/Photos/Avatars/avatar-1.jpg"><p class="lead">Search catagory</p></option>
            @foreach ($data as $d)
            <option value="{{$d->id}}">{{$d->cat_name}}</option>
            @endforeach
        </select>
    </div>
    </div>
    </div>
    <div class="container">
        
    </div>
    
</div>
{{-- <p>due amount cannot be greater bug</p>
<p>minus icon</p> --}}
<div class="card col-6 border ml-1">
        <div class="d-flex align-middle mb-10">  
        <p class="text-secondary font-bold">select customer:</p>
            <input type="text" class="form-control col-7 ml-auto" id="customerSearch" placeholder="search..." value="">
        </div>
        <div><a style="font-size: 14px; text-align:left; font-family:Arial, Helvetica, sans-serif; font-weight:600; cursor:pointer; margin-bottom:10px"  data-toggle="modal" data-target="#newCustomer" class="text-primary col-auto">New customer +</a></div>
    <div class="table-container ">
    <table class="table table-hover text-nowrap" id="store_table">
        <form class="items-form">
        <thead class="sticky-header">
          <tr>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tabledata">
            <tr>
                <td><div class="Item"><span id='itemName'></span><span class="text-secondary" id="bb"></span><input type="hidden" class="itemsInput" value=""><input type="hidden" id="position" value=""></div></td>
                <td>
                    <div class="Qty"><span></span><input type="hidden" class="qtyInput" value=""></div>
                </td>
                <td>
                    <div class="Total_price"><span class="new"></span><input type="hidden" class="totalInput" value=""></div>
                </td>
                <td><button type="button" class="btn btn-success amber-text edit" title="Delete"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-success amber-text delete" title="Delete"><i class="fas fa-window-close"></i></button></td>
            </tr>
        </tbody>
        </form>
      </table>
    </div>
    
    
    <div class="summary">
        <div class="row total-count">
            <span class="border-bottom" id="sub-total">
            Sub total: 
            </span>
            <span class="border-bottom" id="discount">
          Discount:
        </span>
        <span class="border-bottom" id="total">
           Total: 
        </span>
        </div>
        <div class="position-absolute bottom-right">
       
        <button type="button" class="btn btn-primary" id="order">ORDER</button>
    </div>
    </div>

</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="details">
                <h1 class="display-6" id="lead" ></h1>
                <input type="hidden" id="medicineId" value="">
            </div>
            <div class="details2">
                <table class="table table-hover text-nowrap" >
                    <thead>
                        <tr>
                            <td>STRENGTH</td>
                            <td>CATAGORY</td>
                            <td>UNIT</td>
                        </tr>
                    </thead>
                    <tbody id="table2">
                        
                    </tbody>
                </table>
                <h6>Select batch</h6>
                <div class="batchSelect">
                    <select class="form-select" id="formSelect" multiple aria-label="multiple select example">
                        <option value=""></option>
                    </select>
                </div>
                <div class="quantity">
                    <h6 id="h6">Quantity :</h6>
                    <button type="button" class="btn btn-primary amber-text minus" id="delete" value="-"><i class="fa fa-minus-circle" aria-hidden="false"></i></button>
                    <input type="number" class="form-control st" size="3" value="" />
                    <button type="button" class="btn btn-primary amber-text plus" value="+"><i class="fas fa-plus-circle"></i></button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submit1">Add item</button>
        </div>
    </div>
    </div>
</div>

{{-- order modal --}}
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header border-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="details3">
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <td><h6>Item</h6></td>
                            <td><h6>Quantity</h6></td>
                            <td><h6>Total price</h6></td>
                        </tr>
                    </thead>
                    <tbody id="table3">
                        
                    </tbody>
                </table>
                <div class="bill">
                    <div class="row total-count2">
                    <span class="border-bottom" id="total2">
                    Total: 
                    </span>
                    </div>
                </div>
                <div class="payment">
                    <h6>Mode of payment</h6>
                    <input class="form-control" placeholder="Cash" disabled>
                    <input class='form-control mt-2' placeholder="Due amount" id="due" val="">
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="proceed">Complete order</button>
        </div>
    </div>
    </div>
</div>

{{-- new customer modal --}}
<div class="modal fade" id="newCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add new customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="customerButton">Add customer</button>
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
{{-- <button id="test" id="but">test</button> --}}
  @section('scripts')
<script>
    $(document).ready(function () {

        // console.log();
        $('#but').on('click', function () {
            alert('er');
        });

        $('.st').val(1);
        fetchMeds();
        function fetchMeds(){
            $.ajax({
                type: "GET",
                url: "fetchMeds",
                dataType: "json",
                success: function (response) {
                    $.each(response, function (indexInArray, valueOfElement) { 
                        $('.container').append('<div  class="list" id='+valueOfElement.id+'><span>'+valueOfElement.med_name+'</span></div>');
                });

                }
            });
        }
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

        // quantity increment/decrement
        $(document).on('click','.plus', function () {
            var x = parseInt($('.st').val());
            x += 1;
            $('.st').val(x);
        });
        $(document).on('click','.minus', function () {
            var x = parseInt($('.st').val());
            if(x != 1){
                x = x-1;
                $('.st').val(x);
            }
            else{
                $('.st').val(x);
            }
        });

        $('#searchs').on('input', function () {
            var x = $(this).val();
                if(x == ''){
                    $('.list').remove();
                    $.ajax({
                    type: "post",
                    url: "getMeds",
                    data: { search: x },
                    dataType: "json",
                    success: function (response) {
                        $('.list').remove();
                        $.each(response.meds1, function (indexInArray, valueOfElement) { 
                            $('.container').append('<div  class="list" id='+valueOfElement.id+'><span>'+valueOfElement.med_name+'</span></div>');
                        });
                    }
                });
                }
                else{
                
                $.ajax({
                    type: "post",
                    url: "getMeds",
                    data: { search: x },
                    dataType: "json",
                    success: function (response) {
                        $('.list').remove();
                        $.each(response.meds, function (indexInArray, valueOfElement) { 
                            $('.container').append('<div  class="list" id='+valueOfElement.id+'><span>'+valueOfElement.med_name+'</span></div>');
                        });
                    }
                });
            }
        });

        $('.medsCatagory').on('change', function () {
            $('.list').remove();
            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "MedsCatagoryWise/"+id,
                dataType: "json",
                success: function (response) {
                    if(response.status !== 500){
                        
                        $.each(response.meds, function (indexInArray, valueOfElement) { 
                            $('.container').append('<div  class="list" id='+valueOfElement.id+'><span>'+valueOfElement.med_name+'</span></div>');
                        });
                    }
                    else{
                        alert('No medicines in this catagory');
                    }
                }
            });
        });

    $(document).on('click', '.list', function() {
        $('#stockQuantity').empty();
    $('#formSelect').empty();
    $('#table2').empty();
    $('#lead').empty();
    $('.st').val(1);
    var elementId = $(this).attr('id');

    var elementValue = $(this).text();
    $.ajax({
        type: "GET",
        url: "fetchBatch/"+elementId,
        dataType: "json",
        success: function (response) {

                        $('#submit1').removeAttr('disabled',true);
                        $('#lead').append('<h1 class="display-6" id="lead">'+elementValue+'</h1><input type="hidden" id="medicineId" value="'+elementId+'">');
                        if(response.status !== 500){
                        $('#table2').append('<tr><td><p class="lead">'+response.strength+'</p></td><td><p class="lead">'+response.catagory+'</p></td><td><p class="lead">'+response.unit+'</p></td></tr>');
                        $.each(response.data, function (indexInArray, valueOfElement) {
                            var key = valueOfElement.batch_no; 
                            if (myQuantity.hasOwnProperty(key)){
                            $('#formSelect').append('<option value="'+valueOfElement.batch_no+'">'+valueOfElement.batch_no+'\ (exp_date: '+valueOfElement.expiry_date+')\ (stock: '+myQuantity[key]+')\ (sell price:'+valueOfElement.sell_price+')</option>');
                            }
                            else{
                                $('#formSelect').append('<option value="'+valueOfElement.batch_no+'">'+valueOfElement.batch_no+'\ (exp_date: '+valueOfElement.expiry_date+')\ (stock: '+valueOfElement.quantity+')\ (sell price:'+valueOfElement.sell_price+')</option>');
                                var myKey= valueOfElement.batch_no;
                                var myValue = valueOfElement.quantity;
                                populateArray(myKey , myValue)
                            }
                        });
                
                        }
                        else{
                            $('#table2').append('<tr><td><p class="lead">'+response.strength+'</p></td><td><p class="lead">'+response.catagory+'</p></td><td><p class="lead">'+response.unit+'</p></td></tr>')
                            }
                    $('#exampleModalCenter').modal('show');    
        }
    });
    
    });
    var x = $('.text-nowrap tr').length;
    var uniqueId = 1;
    // var index = 0;
    // var fakeposition = 1;
    console.log($('.text-nowrap tr').length);
    $(document).on('click','#submit1', function (e) {
        e.preventDefault();




        // var stock = 0;
        var med = $('#medicineId').val();
        var batch = $('#formSelect').val();
        var med_name = $('#lead').text();
        var quantity = parseInt($('.st').val());
        console.log(batch);
        if(myQuantity.hasOwnProperty(batch)){
            var stock = myQuantity[batch];
        }
        // console.log(quantity , stock);
        if(quantity <= stock){
            $.ajax({
                type: "POST",
                url: "fetchTotal/"+batch,
                data:{'quantity': quantity },
                dataType: "json",
                success: function (response) {
                    
                    if(x==3){
                        $('.Item').empty();
                        $('.Qty').empty();
                        $('.Total_price').empty();
                        $('.Item').append('<span id="itemName">'+med_name+'</span><span class="text-secondary" id="bb">Batch: '+batch+'</span><input type="hidden" class="itemsInput" value="'+uniqueId+'"><input type="hidden" id="position" value="'+uniqueId+'">');
                        $('.Qty').append('<span  class="editableSpan">'+quantity+'</span><input type="hidden" class="qtyInput" value="'+quantity+'">');
                        $('.Total_price').append('<span class="new"> &#8377;'+response.total+'</span><input type="hidden" class="totalInput" value="'+response.total+'">');
                        $('#exampleModalCenter').modal('hide');
                        $('.st').val(1);
                        x += 1;
                        var newBatch = '';
                        $.each(batch, function (indexInArray, valueOfElement) { 
                            newBatch = valueOfElement;
                        });
                        let keyValuePairs = [
                        ['id',uniqueId],
                        ['batch',newBatch],
                        ['item', med_name],
                        ['med_id', response.med_id],
                        ['stock_id', response.id],
                        ['quantity', quantity],
                        ['total', response.total]
                        ];

                        getData(med_name, keyValuePairs);
                        updateBill();
                        uniqueId++;
                        stock -= quantity;
                        populateArray(newBatch , stock );
                        console.log(myArray)
                    }
                    else{
                    $('#tabledata').append('<tr><td><div class="Item"><span id="itemName">'+med_name+'</span><span class="text-secondary" id="bb">Batch: '+batch+'</span><input type="hidden" class="itemsInput" value="'+uniqueId+'"><input type="hidden" id="position" value="'+uniqueId+'"></div></td>\<td><div class="Qty"><span class="editableSpan">'+quantity+'</span><input type="hidden" class="qtyInput" value="'+quantity+'"></div></td><td><div class="Total_price"><span class="new"> &#8377;'+response.total+'</span><input type="hidden" class="totalInput" value="'+response.total+'"></div></td><td><button type="button" class="btn btn-success amber-text edit" title="Delete"><i class="fas fa-edit"></i></button><button type="button" class="btn btn-success amber-text delete" title="Delete"><i class="fas fa-window-close"></i></button></td></tr>')
                    $('#exampleModalCenter').modal('hide');
                    $('.st').val(1);
                    
                    x += 1;
                    var newBatch = '';
                        $.each(batch, function (indexInArray, valueOfElement) { 
                            newBatch = valueOfElement;
                        });
                    var keyValuePairs = [
                        ['id',uniqueId],
                        ['batch',newBatch],
                        ['item', med_name],
                        ['med_id', response.med_id],
                        ['stock_id', response.id],
                        ['quantity', quantity],
                        ['total', response.total]
                        ];
                        // store unique id and tr row 
                        // storeRowKeyValuePairs(index , uniqueId);
                        // console.log(rowCount)
                        // trkeys(fakeposition, index)
                        // console.log(keyCount);
                        // fakeposition = 1;
                        // index = 1;



                        getData(med_name, keyValuePairs);
                        updateBill();
                        uniqueId++;
                        stock -= quantity;
                        populateArray(newBatch , stock );
                    }
                }
            });
        }
        else{
            alert("Available stock: "+stock);
        }    
    });
    $(document).on('click', '.edit', function() { //mark
  var qtySpan = $(this).closest('tr').find('.Qty span');
  var qtyInput = $(this).closest('tr').find('.qtyInput');
  var totalInput = $(this).closest('tr').find('.totalInput').val();
  var zz = $(this).closest('tr').find('#position').val();
  var oldqty = $(this).closest('tr').find('.qtyInput').val();
  var span = $(this).closest('tr').find('.new');
  var changable = $(this).closest('tr').find('.totalInput');

  qtySpan.attr('contenteditable', true).focus();

  qtySpan.on('input', function() {
    var editedText = $(this).text();
    qtySpan.text(editedText);
    qtyInput.val(editedText);
  });

  qtySpan.on('blur', function() {
    qtySpan.attr('contenteditable', false);
    var quantity = $(this).closest('tr').find('.qtyInput').val();
    console.log(totalInput);
    // console.log(myArray);
    console.log(zz);
    var newTotalcount =(totalInput/oldqty);
    var newTotal = quantity*newTotalcount;
    // console.log('new ' +newTotal);

        $.each(myArray, function (indexInArray, valueOfElement) { 
        if(valueOfElement.id == zz){
            valueOfElement.quantity = quantity;
            console.log(newTotal);
            valueOfElement.total = newTotal;
            changable.val(newTotal);
            span.text(newTotal);
        }
    });
    updateBill();
    console.log(myArray)
});
});



    var removed = [];
    $(document).on('click','.delete', function (e) {
        var Newbatch = 0
        if(x == 4){
            var id = $(this).closest('tr').find('.itemsInput').val(); 
            var bbValue = $(this).closest('tr').find('#bb').text();
            var bbParts = bbValue.split(':');
            if (bbParts.length > 1) {
                Newbatch = parseInt(bbParts[1].trim());
                
            }
            $.each(myArray, function (indexInArray, valueOfElement) { 
                if(valueOfElement.id == id){
                    if(myQuantity.hasOwnProperty(Newbatch)){
                    var stock = myQuantity[Newbatch];
                    stock += valueOfElement.quantity;
                    }
                    populateArray(Newbatch , stock );

                    delete valueOfElement.id
                    delete valueOfElement.batch;
                    delete valueOfElement.item;
                    delete valueOfElement.quantity;
                    delete valueOfElement.total;
                    delete valueOfElement.med_id;
                    delete valueOfElement.stock_id;
                }
            

            });
            $('.Item').empty();
            $('.Qty').empty();
            $('.Total_price').empty();
            x--;
            updateBill();
            
            
        }
        else if(x==3){
            alert("can't delete");
        }else{
            var bbValue = $(this).closest('tr').find('#bb').text();
            var bbParts = bbValue.split(':');
            if (bbParts.length > 1) {
                var Newbatch = bbParts[1].trim();
                
            }
            var id = $(this).closest('tr').find('.itemsInput').val(); 
            $.each(myArray, function (indexInArray, valueOfElement) { 
                if(valueOfElement.id == id){
                    if(myQuantity.hasOwnProperty(Newbatch)){
                    var stock = myQuantity[Newbatch];
                    stock += valueOfElement.quantity;
                    }
                    populateArray(Newbatch , stock );
                    delete valueOfElement.id
                    delete valueOfElement.batch;
                    delete valueOfElement.item;
                    delete valueOfElement.quantity;
                    delete valueOfElement.total;
                    delete valueOfElement.med_id;
                    delete valueOfElement.stock_id;

                    
                }
            });
            $(this).closest('tr').remove();
            x--;
            updateBill();

        }
    });
    $('#formSelect').change(function () { 
        
        var batch = $('#formSelect').val();
        
            $.ajax({
                type: "post",
                url: "fetchTotal/"+batch,
                dataType: "json",
                success: function (response) {
                    var d = response.expiry;

                    var currentDate = new Date();
  var inputDate = new Date(d);

  // Set the time to the end of the day for proper comparison
  inputDate.setHours(23, 59, 59, 999);

  // Compare the input date with the current date
  if (inputDate < currentDate) {
    Command: toastr["warning"]("Item expired 1! Please select different batch");
                        $('#submit1').attr('disabled',true);
  } else {
    console.log('not expired');
    $('#submit1').removeAttr('disabled',true);
  }
                 
                }
            });
        });

        
    var rowCount = [];
    function storeRowKeyValuePairs(key, value) {
        rowCount[key] = value;
        console.log("Key-value pair added to the array: 1 " + key + " - " + value);
        // console.log(rowCount);
        }

        var  keyCount = [];
    function trkeys(key, value) {
        keyCount[key] = value;
        console.log("Key-value pair added to the array: 2" + key + " - " + value);
        // console.log(rowCount);
        }    
    



    var myArray = [];
    function getData(med_name, keyValuePairs){
        const dynamicArray = {};
        for (let i = 0; i < keyValuePairs.length; i++) {
        const key = keyValuePairs[i][0];
        const value = keyValuePairs[i][1];
        dynamicArray[key] = value;
    }
    myArray.push(dynamicArray);
    }

    // batch array
    var myQuantity = [];
    function populateArray(key, value) {
        myQuantity[key] = value;
        console.log("Key-value pair added to the array: " + key + " - " + value);
        console.log(myQuantity);
        }

    

    function updateBill(){
        $('#sub-total > p').html("");
        $('#discount > p').html("");
        $('#total > p').html("");
        var total_price = 0;
        $.each(myArray, function (indexInArray, valueOfElement) {
            if(isNaN(valueOfElement.total) !== true){
                total_price += valueOfElement.total;
            }
        });
            $('#sub-total').append('<p>'+total_price+'</p>');
            $('#discount').append('<p>0</p>');
            $('#total').append('<p>'+total_price+'</p>');
    }  
    $('#order').on('click', function () {
        console.log($('#qtyInput').val());
        $('#due').val('');
        console.log($('#customer').val());
        $('#table3').empty();
        $('#sub-total2 > p').html("");
        $('#discount2 > p').html("");
        
        $('#orderModal').modal('show');
        var price = 0;
        console.log(myArray);
        $.each(myArray, function (indexInArray, valueOfElement) { 
            $('#total2 > p').html("");
            if(valueOfElement.batch == null){
                return true;
            }
            else{
                $('#table3').append('<tr><td><p>'+valueOfElement.item+'</p></td><td><p>'+valueOfElement.quantity+'</p></td><td><p>'+valueOfElement.total+'</p></td></tr>');
            if(isNaN(valueOfElement.total) !== true){
                price += valueOfElement.total;
            }
            $('#total2').append('<p>'+price+'</p>');
            }
        });
        });


        $('#proceed').on('click', function () {
            var due = $('#due').val();
            var customer = $('#customerSearch').val();
            var total = $('#total2 > p').text();
            $('#invoice').empty();
            $('#print-details').empty();
            $('#small').empty();
            $('#finalTable').empty();
            x -= 1;
            if(due != ''){
                if(customer != ''){
                    console.log(due);
                    console.log(total);
                    if(due>total){
                        alert('Due amount cannot be greater than total amount: '+total);
                    }
                    else{
                        $.ajax({
                            type: "POST",
                            url: "sales",
                            data: {customer:customer, array:myArray, due: due},
                            dataType: "json",
                            success: function (response) {
                                console.log('saved');
                                $('.Item').empty();
                                $('.Qty').empty();
                                $('.Total_price').empty();
                                $('#customerSearch').val('');
                                $('#orderModal').modal('hide');
                                
                                Command: toastr["success"]("Order successfully");
                                $.each(response.data, function (indexInArray, valueOfElement) { 
                                    var medicine = response.meds[indexInArray];
                                    $('#invoice').append('<b>Invoice '+response.invoice+'</b>');
                                    $('#print-details').append('<tr><td>'+valueOfElement.quantity+'</td><td>'+medicine+'</td><td>'+valueOfElement.total_price+'</td></tr>');
                                    $('#small').append(valueOfElement.pur);
                                    
                                });
                                $('#finalTable').append('<tr><th style="width:50%">Subtotal: </th><td>'+response.total+'</td></tr><tr><th>Tax(GST) </th><td>'+response.tax+'</td></tr><tr><th>Total:</th><td>'+response.total+'</td></tr>')
                                $('.bd-example-modal-lg').modal('show');
                            }
                        });
                    }
                }
                else{
                    alert('Please select customer first!');
                }
            }
            else{
                // console.log(myArray);
                $.ajax({
                            type: "POST",
                            url: "sales",
                            data: {customer:customer, array:myArray, due: due},
                            dataType: "json",
                            success: function (response) {
                                console.log('saved');
                                $('.Item').empty();
                                $('.Qty').empty();
                                $('.Total_price').empty();
                                $('#customerSearch').val('');
                                $('#orderModal').modal('hide');
                                Command: toastr["success"]("Order successfully !");
                                $.each(response.data, function (indexInArray, valueOfElement) { 
                                    var medicine = response.meds[indexInArray];
                                    $('#invoice').append('<b>Invoice '+response.invoice+'</b>');
                                    $('#print-details').append('<tr><td>'+valueOfElement.quantity+'</td><td>'+medicine+'</td><td>'+valueOfElement.total_price+'</td></tr>');
                                    $('#small').append(valueOfElement.pur);
                                });
                                $('#finalTable').append('<tr><th style="width:50%">Subtotal: </th><td>'+response.total+'</td></tr><tr><th>Tax(GST) </th><td>0</td></tr><tr><th>Total:</th><td>'+response.total+'</td></tr>')
                                $('.bd-example-modal-lg').modal('show');
                                console.log(response);
                            }
                        });
            }
        });

        $('#customerButton').on('click', function () {
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
                    $("#name").val('');
                $("#email").val('');
                $("#phone").val('');
                $("#address").val('');
                $('#newCustomer').modal('hide')
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

        // customer search
        $('#customerSearch').autocomplete({
            source: function(request, response){
                $.ajax({
                    type: "post",
                    url: "getCustomer",
                    data: { search: request.term },
                    dataType: "json",
                    success: function (data) {
                        response($.map(data.customer, function (key) {
                            return {
                                label: key.name,
                                id: key.id,
                            }
                        }));
                    }
                });
            },
            select: function(event, ui) {

                $('#customerSearch').val(ui.item.id);
                console.log($('#customerSearch').val());
            }
        });

});
</script>
@endsection

@endsection