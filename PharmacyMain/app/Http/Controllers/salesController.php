<?php

namespace App\Http\Controllers;

use App\Models\catagory;
use App\Models\customer;
use App\Models\customerType;
use App\Models\invoice;
use App\Models\medicine;
use App\Models\sale;
use App\Models\stock;
use App\Models\units;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class salesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = catagory::all();
        $customer = customer::all();
        return view('sales/index', ['data' => $data, 'customer' => $customer]);
    }

    public function generatepdf($id)
    {
        $data = sale::where('order_id', $id)->get();
        return response()->json(['data' => $data]);
    }

    public function manageSales()
    {
        return view('sales/managesale');
    }
    public function fetchSales()
    {
        $customer = [];
        $medicine = [];
        $batch = [];

        $data = sale::all();
        foreach ($data as $d) {
            $getCustomer = customer::where('id', $d->customer_id)->get();
            foreach ($getCustomer as $g) {
                array_push($customer, $g->name);
            }

            $getMedicine = medicine::where('id', $d->med_id)->get();
            foreach ($getMedicine as $m) {
                array_push($medicine, $m->name);
            }

            $getBatch = stock::where('id', $d->stock_id)->get();
            foreach ($getBatch as $b) {
                array_push($batch, $b->batch_no);
            }
        }
        return response()->json(['data' => $data, 'customer' => $customer, 'batch' => $batch, 'medicine' => $medicine]);
    }

    public function getMeds(Request $request)
    {
        $search = $request->input('search');
        // if ($search == '') {
        $meds1 = medicine::orderby('med_name', 'asc')->select('med_name', 'id', 'generic_name', 'strength')->get();
        // } else {
        $meds = medicine::orderby('med_name', 'asc')->select('med_name', 'id', 'generic_name', 'strength', 'unit_id', 'cat_id')->where('med_name', 'LIKE', '%' . $search . '%')->limit(5)->get();
        // foreach ($meds as $med) {
        //     $data1 = units::select('unit_name')->where('id', $med->unit_id)->get();
        //     $data2 = catagory::select('cat_name')->where('id', $med->cat_id)->get();
        // }
        // }

        return response()->json(['meds' => $meds, 'meds1' => $meds1]);
    }

    public function fetchBatch($id)
    {
        $batches = stock::select('batch_no', 'id', 'expiry_date', 'med_id', 'quantity', 'sell_price')->where('med_id', $id)->get();
        $meds = medicine::select('strength', 'cat_id', 'unit_id')->where('id', $id)->get();
        foreach ($meds as $med) {
            $unit = units::where('id', $med->unit_id)->pluck('unit_name');
            $catagory = catagory::where('id', $med->cat_id)->pluck('cat_name');
            $strength = $med->strength;
        }
        if (count($batches) == 0) {
            return response()->json(['status' => 500, 'unit' => $unit, 'catagory' => $catagory, 'strength' => $strength]);
        } else {
            return response()->json(['status' => 200, 'data' => $batches, 'unit' => $unit, 'catagory' => $catagory, 'strength' => $strength]);
        }
    }

    public function fetchExpiry($id)
    {
        $expiry = stock::select('expiry_date')->where('id', $id)->get();
        return response()->json($expiry);
    }

    public function fetchTotal(Request $request, $batch)
    {
        $price = stock::select('sell_price', 'expiry_date', 'med_id', 'id', 'quantity')->where('batch_no', $batch)->get();

        foreach ($price as $pr) {
            $total = $request->quantity * $pr->sell_price;
            $expiry = $pr->expiry_date;
            $med_id = $pr->med_id;
            $id = $pr->id;
            $quantity = $pr->quantity;
            return response()->json(['total' => $total, 'expiry' => $expiry, 'med_id' => $med_id, 'id' => $id, 'quantity' => $quantity]);
        }
    }

    public function MedsCatagoryWise($id)
    {
        $data = medicine::where('cat_id', $id)->get();
        if (count($data) == 0) {
            return response()->json(['status' => 500]);
        } else {
            return response()->json(['status' => 200, 'meds' => $data]);
        }
    }
    public function fetchMeds()
    {
        $data = medicine::all();
        return response()->json($data);
    }

    public function getCustomer(Request $request)
    {
        $search = $request->input('search');
        // if ($search == '') {
        //     $customer1 = customer::orderby('name', 'asc')->select('name', 'id')->get();
        // } else {
        $customer = customer::orderby('name', 'asc')->select('name', 'id')->where('name', 'LIKE', '%' . $search . '%')->limit(5)->get();
        // }

        return response()->json(['customer' => $customer]);
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
        $meds = [];
        // $customerArray = ' ';
        $totalPrice = 0;
        $unique_id = floor(time() - 999999999);
        $order_id = sale::select('id')->where('order_id', $unique_id)->get();
        if (count($order_id) == 0) {
            $dueAmount = $request->input('due');
            foreach ($request->input('array') as $ar) {
                // array_push($meds, $ar['med_id']);
                if ($request->input('customer') != '') {
                    $customer = customer::where('name', $request->input('customer'))->get();
                    foreach ($customer as $cust) {
                        $c_id = $cust->id;
                    }
                } else {
                    $c_id = 0;
                }

                $sales = new sale();

                $sales->invoice = $unique_id;
                $sales->customer_id = $c_id;
                $sales->med_id = $ar['med_id'];
                $sales->stock_id = $ar['stock_id'];
                $sales->quantity = $ar['quantity'];
                $totalPrice += $ar['total'];
                $sales->total_price = $ar['total'];
                if ($dueAmount != '') {
                    $due = $request->input('due');
                    $sales->due = $dueAmount;
                    $dueAmount = '';
                }
                $sales->order_id = $unique_id;
                $medicine = medicine::where('id', $ar['med_id'])->get();
                foreach ($medicine as $m) {
                    array_push($meds, $m->med_name);
                }


                $stock = stock::where('id', $ar['stock_id'])->first();
                $stock->quantity = $stock->quantity - $ar['quantity'];
                $stock->update();
                $sales->save();

                $data = sale::where('order_id', $unique_id)->get();

                $invoice = new invoice();
                $invoice->invoice_type = 1;
                $user = sale::select('customer_id')->where('invoice', $unique_id)->get();
                foreach ($user as $u) {
                    $userID = $u->customer_id;
                }
                $invoice->user = $userID;
                $invoice->invoive_no = $unique_id;
                $invoice->save();
            }
        } else {
            $unique_id = floor(time() - 999999999) + 10;
        }


        return response()->json(['data' => $data, 'meds' => $meds, 'total' => $totalPrice]);
        // return response()->json($meds);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('sales')->where('order_id', $id)->update(array('due' => 0));
        return response()->json('updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
