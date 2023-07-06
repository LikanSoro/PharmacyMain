<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoicetype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoice.invoiceType');
    }

    public function manageInvoice()
    {
        return view('invoice.index');
    }

    public function fetchInvoice()
    {
        $data = invoice::all();
        $myarray = [];
        foreach ($data as $d) {
            $type = invoicetype::select('name')->where('mapped_to', $d->invoice_type)->get();
            foreach ($type as $t) {
                array_push($myarray, $t->name);
            }
        }
        return response()->json(['data' => $data, 'invoice' => $myarray]);
    }

    public function invoiceStore(Request $request)
    {
        if (count(invoicetype::all()) >= 2) {
            return response()->json(['status' => 400]);
        } else {
            $count = '';
            $invoice = new invoicetype();
            $invoice->name = $request->input('name');


            if ($request->input('map') == 'customer') {
                $invoice->mapped_to = 1;
                $count = 1;
            } else {
                $invoice->mapped_to = 2;
                $count = 2;
            }
            $invoice->save();
            return response()->json($count);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchInvoiceType()
    {
        $data = invoicetype::all();
        return response()->json($data);
    }

    public function invoiceData($id)
    {
        // $myarray = [];
        // $data = invoice::where('invoice_type', $id)->get();
        // $type = invoicetype::select('name')->where('mapped_to', $id)->get();
        // foreach ($type as $t) {
        //     array_push($myarray, $t->name);
        // }
        $data = DB::table('invoices')
            ->join('invoicetypes', 'invoices.invoice_type', '=', 'invoicetypes.mapped_to')
            ->select('invoices.*', 'invoicetypes.name as name')
            ->where('invoices.invoice_type', '=', $id)
            ->get();
        return response()->json($data);
        // return response()->json(['data' => $data, 'invoice' => $myarray]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function deleteInvoiceType($id)
    {
        invoicetype::where('id', $id)->delete();
        invoice::where('invoice_type', $id)->delete();
        return response()->json();
    }
}
