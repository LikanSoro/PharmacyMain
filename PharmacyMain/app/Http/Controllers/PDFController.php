<?php

namespace App\Http\Controllers;

use App\Models\manufacturer;
use App\Models\medicine;
use App\Models\purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(request $request)
    {

        $item = $request->input('medicine');
        $invoice = $request->input('medicine');
        $sname = $request->input('medicine');
        $saddress = $request->input('medicine');
        $semail = $request->input('medicine');
        $sphone = $request->input('medicine');
        $unitprice = $request->input('medicine');
        $quantity = $request->input('medicine');
        $total = $request->input('medicine');
        $purchaseTime = $request->input('medicine');
        $purchaseDate = $request->input('medicine');
        $stax = $request->input('medicine');

        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com hh',
        //     'date' => date('m/d/Y')
        // ];

        $pdf = Pdf::loadview('pdf', compact(
            'item',
            'invoice',
            'sname',
            'saddress',
            'semail',
            'sphone',
            'unitprice',
            'quantity',
            'total',
            'purchaseTime',
            'purchaseDate',
            'stax'
        ));
        return $pdf->download('Purchaseinvoice.pdf');
        // return view('pdf', compact(
        // 'item',
        // 'invoice',
        // 'sname',
        // 'saddress',
        // 'semail',
        // 'sphone',
        // 'unitprice',
        // 'quantity',
        // 'total',
        // 'purchaseTime',
        // 'purchaseDate',
        // 'stax'
        // ));
    }

    public function downloadPDF($id)
    {
        // $discount = 0;
        // if ($request->input('discount')) {
        //     $discount = $request->input('discount');
        //     echo $discount;
        // }
        // $free = 0;
        // if ($request->input('free')) {
        //     $free = $request->input('free');
        // }
        // $medicineID = $request->input('medicine');
        // $manufacturerID = $request->input('manufacturer');
        // $medicine = medicine::select('med_name')->where('id', $medicineID)->get();
        // foreach ($medicine as $med) {
        //     $med_name1 = $med->med_name;
        // }
        // $manufacturer = manufacturer::select('m_name', 'm_phone', 'm_email', 'm_address')->where('id', $manufacturerID)->get();
        // foreach ($manufacturer as $mf) {
        //     $mfname = $mf->m_name;
        //     $mfphone = $mf->m_phone;
        //     $mfemail = $mf->m_email;
        //     $mfaddress = $mf->m_address;
        // }
        $purchase = purchase::where('invoice_no', $id)->get();
        foreach ($purchase as $purchase1) {
            $invoice1 = $purchase1->invoice_no;
            $unitprice1 = $purchase1->unit_price;
            $units1 = $purchase1->units;
            $total1 = $purchase1->total_price;
            $tax1 = $purchase1->sales_tax;
            $purchasetime1 = Carbon::parse($purchase1->created_at)->format('Y-m-d');
            $purchasedate1 = Carbon::parse($purchase1->created_at)->format('H-i-s');
            $med_id = $purchase1->med_id;
            $mf_id = $purchase1->mf_id;
        }
        $medicine = medicine::select('med_name')->where('id', $med_id)->get();
        foreach ($medicine as $med) {
            $med_name1 = $med->med_name;
        }
        $manufacturer = manufacturer::select('m_name', 'm_phone', 'm_email', 'm_address')->where('id', $mf_id)->get();
        foreach ($manufacturer as $mf) {
            $mfname = $mf->m_name;
            $mfphone = $mf->m_phone;
            $mfemail = $mf->m_email;
            $mfaddress = $mf->m_address;
        }
        $data = [
            'item' => $med_name1,
            'invoice' => $invoice1,
            'sname' => $mfname,
            'saddress' => $mfaddress,
            'semail' => $mfemail,
            'sphone' => $mfphone,
            'unitprice' => $unitprice1,
            'quantity' => $units1,
            'total' => $total1,
            'purchaseTime' => $purchasetime1,
            'purchaseDate' => $purchasedate1,
            'stax' => $tax1,
        ];


        $pdf = Pdf::loadview('pdf', $data);
        return $pdf->stream('Purchase.pdf');
        // echo $request->input('invoice');
        // return response()->json($data);
    }

    public function generateSalesPDF()
    {
    }
}
