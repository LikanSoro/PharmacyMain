<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoicetype;
use App\Models\manufacturer;
use App\Models\medicine;
use App\Models\purchase;
use App\Models\stock;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class purchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Manufacturer = manufacturer::all();
        $today = Carbon::today();
        $dt = $today->format("Y-m-d");
        return view('purchase.index', ['manufacturer' => $Manufacturer, 'dt' => $dt]);
    }

    public function getMedicines($id)
    {
        $data = DB::table('medicines')->where('mf_id', $id)->get();
        if (count($data) > 0) {
            return response()->json([
                'status' => 200,
                'data' => $data
            ]);
        } else {
            return response()->json(['status' => 500, 'message' => 'not found']);
        }
    }

    public function getQuantity($id)
    {
        $data = DB::table('stocks')->where('med_id', $id)->pluck('quantity');
        if (count($data) == 1) {
            return response()->json([
                'status' => 200,
                'quantity' => $data
            ]);
        } elseif (count($data) > 1) {
            $x = 0;
            foreach ($data as $key => $value) {
                $x = $data[$key] + $x;
            }
            return response()->json(['status' => 100, 'data' => $x]);
        } else {
            return response()->json(['status' => 500]);
        }
    }

    public function unitPrice(Request $request)
    {
        $x = $request->input('quantity') * $request->input('unit_price');
        $disc = ($request->input('discount') / 100) * $x;
        $x = $x - $disc;
        $tax = ($request->input('tax') / 100) * $x;
        $x = $x + $tax;
        return response()->json($x);
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
    public function fetchPurchase()
    {
        $medicine = [];
        $manufacturer = [];
        $data = purchase::all();
        foreach ($data as $d) {
            // $medID = $d->med_id;
            // $manufacturerID = $d->mf_id;

            $medName = medicine::select('med_name')->where('id', $d->med_id)->get();
            $manu = manufacturer::select('m_name')->where('id', $d->mf_id)->get();

            foreach ($medName as $mm) {
                array_push($medicine, $mm->med_name);
            }
            foreach ($manu as $man) {
                array_push($manufacturer, $man->m_name);
            }
        }



        // foreach ($medName as $m) {
        //     $medicine = $m->med_name;
        // }


        // foreach ($manu as $mm) {
        //     $manufacturer = $mm->m_name;
        // }
        return response()->json(['medicine' => $medicine, 'data' => $data, 'manufacturer' => $manufacturer]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $free = 0;
        $validator = Validator::make($request->all(), [
            'medicine' => 'required',
            'manufacturer' => 'required',
            'batch_number' => 'required|unique:purchases,batch_no|numeric',
            'invoice' => 'required|unique:purchases,invoice_no|numeric',
            'expiry_date' => 'required',
            'p_date' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'mrp' => 'required',
        ]);
        if ($validator->passes()) {
            $purchase = new purchase();
            $purchase->med_id = $request->input('medicine');
            $purchase->mf_id = $request->input('manufacturer');
            $purchase->batch_no = $request->input('batch_number');
            $purchase->invoice_no = $request->input('invoice');
            $purchase->expiry_date = $request->input('expiry_date');
            $purchase->purchase_date = $request->input('p_date');
            $purchase->units = $request->input('quantity');
            $purchase->unit_price = $request->input('unit_price');
            $purchase->desc = $request->input('desc');
            $purchase->total_price = $request->input('total_price');
            $purchase->sales_tax = $request->input('tax');
            if ($request->input('free')) {
                $purchase->free = $request->input('free');
            } else {
                $purchase->free = 0;
            }

            $purchase->save();

            $stock = new stock();
            $stock->med_id = $request->input('medicine');
            $stock->batch_no = $request->input('batch_number');
            $stock->expiry_date = $request->input('expiry_date');
            $stock->buy_price = $request->input('total_price');
            $stock->mrp = $request->input('mrp');
            $stock->sell_price = $request->input('mrp');
            $stock->unit_price = $request->input('unit_price');
            $stock->purchase_date = $request->input('p_date');
            if ($request->input('free')) {
                $stock->quantity = $request->input('quantity') + $request->input('free');
                $stock->total_sell_price = $request->input('mrp') * ($request->input('quantity') + $request->input('free'));
                $free = $request->input('free');
            } else {
                $stock->quantity = $request->input('quantity');
                $stock->total_sell_price = $request->input('mrp') * $request->input('quantity');
                $free = 0;
            }

            $stock->save();

            // data to be printed
            $med = medicine::select('med_name')->where('id', $request->input('medicine'))->get();
            foreach ($med as $m) {
                $medicinename = $m->med_name;
            }
            $mfr = manufacturer::where('id', $request->input('manufacturer'))->get();
            foreach ($mfr as $mf) {
                $manufacturer = $mf->m_name;
                $phone = $mf->m_phone;
                $email = $mf->m_email;
                $address = $mf->m_address;
            }
            $batch = $request->input('batch_number');
            $invoice = $request->input('invoice');

            $exp = $request->input('expiry_date');

            $pur = $request->input('p_date');

            $qty = $request->input('quantity');

            $unitpr = $request->input('unit_price');

            $dsc = $request->input('desc');

            $total = $request->input('total_price');

            $tax = $request->input('tax');

            $invoice = invoicetype::all();
            if (count($invoice) == 0) {
                return response()->json(['status' => 400]);
            } else {


                $invoice = new invoice();
                $invoice->invoice_type = 2;
                $user = purchase::select('mf_id')->where('invoice_no', $request->input('invoice'))->get();
                foreach ($user as $u) {
                    $userID = $u->mf_id;
                }
                $invoice->user = $userID;
                $invoice->invoive_no = $request->input('invoice');
                $invoice->save();
                $send_invoice = $request->input('invoice');
                return response()->json(['status' => 200, 'medicine' => $medicinename, 'manufacturer' => $manufacturer, 'batch' => $batch, 'invoice' => $send_invoice, 'expiry' => $exp, 'purchase' => $pur, 'quantity' => $qty, 'unit_price' => $unitpr, 'description' => $dsc, 'total' => $total, 'tax' => $tax, 'phone' => $phone, 'email' => $email, 'address' => $address, 'free' => $free]);
            }
        } else {
            return response()->json(['status' => 500, 'error' => $validator->errors()]);
        }
        // return response()->json($request->input('p_date'));
    }

    public function managePurchase()
    {
        $data = purchase::all();
        return view('purchase/managePurchase', ['data' => $data]);
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
        //
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
