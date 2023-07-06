@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<p class="lead text-md-left ml-3">Credit customer</p>
<table class="table table-bordered">
    <thead>
      <tr class="table-active">
        <th scope="col">Name</th>
        <th scope="col">Phone number</th>
        <th scope="col">Address</th>
        <th scope="col">Order id</th>
        <th scope="col">Total amount</th>
        <th scope="col">Due amount</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($myArray as $ar)
    <tr>
        <td>{{$ar['name']}}</td>
        <td>{{$ar['phone']}}</td>
        <td>{{$ar['address']}}</td>
        <td>{{$ar['order_id']}}</td>
        <td>{{$ar['total_price']}}</td>
        <td>{{$ar['dueAmount']}}</td>
        <td><button class="btn-primary" id="paid">Paid</button></td>
    </tr>
    @endforeach
    </tbody>
  </table>

  <script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
        'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click','#paid', function () {
            console.log('clicked');
            var currentRow = $(this).closest('tr');
            // console.log(currentRow);
            var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
            var col2=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
            var col3=currentRow.find("td:eq(2)").html(); 
            var col4=currentRow.find("td:eq(3)").html(); //order id 
            var col5=currentRow.find("td:eq(4)").html(); 
            var col6=currentRow.find("td:eq(5)").html(); 
            console.log(col1+','+col2+','+col3+','+col4+','+col5+','+col6);
            alert('Mark as paid !');
            $.ajax({
                type: "PUT",
                url: "sales/"+col4,
                data:{due:col6} ,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection