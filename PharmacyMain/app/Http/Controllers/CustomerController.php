<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer/index');
    }

    public function fetchCustomer()
    {
        $data = customer::all();
        return response()->json([
            'customer' => $data
        ]);
    }

    public function creditCustomer()
    {
        $myArray = [];



        // $saleData = sale::all();
        $customer = customer::all();
        foreach ($customer as $cust) {
            $rows = sale::where('customer_id', $cust->id)->where('due', '!=', 0)->get();
            if (count($rows) !== 0) {
                foreach ($rows as $r) {
                    $total = 0;
                    $countTotal = sale::select('total_price')->where('order_id', $r->order_id)->get();
                    foreach ($countTotal as $count) {
                        $total += $count->total_price;
                    }
                    $keyValuePairs = [
                        ['name', $cust->name],
                        ['phone', $cust->phone],
                        ['address', $cust->address],
                        ['total_price', $total],
                        ['order_id', $r->order_id],
                        ['dueAmount', $r->due]
                    ];
                    $dynamicArray = [];
                    for ($i = 0; $i < count($keyValuePairs); $i++) {
                        $key = $keyValuePairs[$i][0];
                        $value = $keyValuePairs[$i][1];
                        $dynamicArray[$key] = $value;
                    }
                    array_push($myArray, $dynamicArray);
                }
            }

            // }
        }
        function getData($keyValuePairs)
        {
            $dynamicArray = [];
            for ($i = 0; $i < count($keyValuePairs); $i++) {
                $key = $keyValuePairs[$i][0];
                $value = $keyValuePairs[$i][1];
                $dynamicArray[$key] = $value;
            }
            array_push($myArray, $dynamicArray);
        }

        return view('customer/credit', compact('myArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:customers,name',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        if ($validator->passes()) {
            $customer = new customer();
            $customer->name = $request->input('name');
            $customer->email = $request->input('email');
            $customer->phone = $request->input('phone');
            $customer->address = $request->input('address');
            $customer->save();
            return response()->json([
                'status' => 200,
                'message' => 'customer added succesfully'
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'error' => $validator->errors()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, customer $customer)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        customer::where('id', $customer)->delete();
        sale::where('customer_id', $customer)->delete();
        return response()->json();
    }
}
