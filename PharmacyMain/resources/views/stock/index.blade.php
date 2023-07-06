@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Custom Dropdown container */
    #product-dropdown {
      position: relative;
      /* display: inline-block; */
      margin: 6px;
      margin-right:5rem;
      width:5rem;
    }

    /* Custom Dropdown select */
    #product-dropdown select {
      padding: 10px;
      font-size: 15px;
      border: none;
      border-radius: 10px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-color: #eae3ec;
    }

    /* Floating effect for select options */
    #product-dropdown select option {
      background-color: white;
      /* color: black; */
      border-radius: 20px;
    }
  </style>
@section('content')
<!-- Table with panel -->
<div class="card card-cascade narrower">

    <!--Card image-->
    <div
      class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
  
      <div>
        <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2" id="delete">
          <i class="far fa-trash-alt mt-0"></i>
        </button>
      </div>
  
      <div id="product-dropdown">
        <select id="myDropdown">
          <option disabled selected>Sort by</option>
          <option value="all-stock">All stock</option>
          <option value="expired">Expired Products</option>
          <option value="stock-created">Stock created</option>
          <option value="empty-stock">Empty stock</option>
        </select>
      </div>
    </div>
    <!--/Card image-->
  
    <div class="px-4">
  
      <div class="table-wrapper">
        <!--Table-->
        <table class="table table-hover mb-0">
  
          <!--Table head-->
          <thead>
            <tr>
              <th>
                <p></p>
              </th>
              <th class="th-lg">
                Batch number
                
              </th>
              <th class="th-lg">
                Item
                
              </th>
              <th class="th-lg">
                    Expiry date
              </th>
              <th class="th-lg">
                Unit price

              </th>
              <th class="th-lg">
                MRP

              </th>
              <th class="th-lg">
                Purchase price
                
              </th>
              <th class="th-lg">
                Available quantity
               
              </th>
              <th class="th-lg">
                Sell total
                
              </th>
            </tr>
          </thead>
          <!--Table head-->
  
          <!--Table body-->
          <tbody>
            
          
          </tbody>
          <!--Table body-->
        </table>
        <!--Table-->
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

        fetchStocks();
        function fetchStocks(){
            var id = 1;
            $.ajax({
                type: "get",
                url: "fetchStock",
                dataType: "json",
                success: function (response) {
                    $.each(response, function(index, valueOfElement) {
                    // var medicine = response.meds[index];
                    $('tbody').append('<tr><th scope="row"><input type="checkbox"></th><td>'+valueOfElement.batch_no+'</td><td>'+valueOfElement.medicine_name+'</td><td>'+valueOfElement.expiry_date+'</td><td>'+valueOfElement.unit_price+'</td><td>'+valueOfElement.mrp+'</td><td>'+valueOfElement.buy_price+'</td><td>'+valueOfElement.quantity+'</td><td>'+valueOfElement.total_sell_price+'</td></tr>');    
                    id += 1;
                    console.log(response);
                });
                }
            });
        }
        $('#myDropdown').change(function () {
           var value = $('#myDropdown').val();
           console.log(value);
           if(value == 'expired'){
            $.ajax({
                type: "get",
                url: "expired",
                dataType: "json",
                success: function (response) {
                    $('tbody').empty();
                    $.each(response.data, function(index, valueOfElement) {
                    var medicine = response.med[index];
                    $('tbody').append('<tr><th scope="row"><input type="checkbox"></th><td>'+valueOfElement.batch_no+'</td><td>'+medicine+'</td><td>'+valueOfElement.expiry_date+'</td><td>'+valueOfElement.unit_price+'</td><td>'+valueOfElement.mrp+'</td><td>'+valueOfElement.buy_price+'</td><td>'+valueOfElement.quantity+'</td><td>'+valueOfElement.total_sell_price+'</td></tr>');    
                });
                }
            });
           }
           else if(value == 'stock-created'){
            $('tbody').empty();
            $.ajax({
                type: "get",
                url: "stock-created",
                dataType: "json",
                success: function (response) {
                    $.each(response.data, function(index, valueOfElement) {
                    var medicine = response.med[index];
                    $('tbody').append('<tr><th scope="row"><input type="checkbox" ></th><td>'+valueOfElement.batch_no+'</td><td>'+medicine+'</td><td>'+valueOfElement.expiry_date+'</td><td>'+valueOfElement.unit_price+'</td><td>'+valueOfElement.mrp+'</td><td>'+valueOfElement.buy_price+'</td><td>'+valueOfElement.quantity+'</td><td>'+valueOfElement.total_sell_price+'</td></tr>');    
                });
                }
            });
           }
           else if(value == 'empty-stock'){
            $('tbody').empty();
            $.ajax({
                type: "get",
                url: "getZeroQuantityStocks",
                dataType: "json",
                success: function (response) {
                    $.each(response.data, function(index, valueOfElement) {
                    var medicine = response.med[index];
                    $('tbody').append('<tr><th scope="row"><input type="checkbox" ></th><td>'+valueOfElement.batch_no+'</td><td>'+medicine+'</td><td>'+valueOfElement.expiry_date+'</td><td>'+valueOfElement.unit_price+'</td><td>'+valueOfElement.mrp+'</td><td>'+valueOfElement.buy_price+'</td><td>'+valueOfElement.quantity+'</td><td>'+valueOfElement.total_sell_price+'</td></tr>'); 
                });
                }
            });
           }
           else{
            $('tbody').empty();
            fetchStocks();
           }
        });

$('#delete').on('click', function () {
        var checkedRows = [];
    $('tbody tr').each(function() {
  var checkbox = $(this).find('input[type="checkbox"]');
  if (checkbox.is(':checked')) {

    var batchNo = $(this).find('td:nth-child(2)').text();
    checkedRows.push({
      batchNo: batchNo,
    });
  }
});
 $.ajax({
    type: "post",
    url: "delete",
    data: {array: checkedRows},
    dataType: "json",
    success: function (response) {
        $('tbody').empty();
        fetchStocks();
    }
 });
});
       




    });
</script>
@endsection