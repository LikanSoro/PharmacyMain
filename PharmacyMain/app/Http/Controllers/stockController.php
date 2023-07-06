<?php

namespace App\Http\Controllers;

use App\Models\medicine;
use App\Models\stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stock/index');
    }

    public function fetchStock()
    {
        // $meds = [];
        // $data = stock::all();

        // foreach ($data as $d) {
        //     $medicine = medicine::where('id', $d->med_id)->get();
        //     foreach ($medicine as $med) {
        //         array_push($meds, $med->med_name);
        //     }
        // }
        // return response()->json(['data' => $data, 'meds' => $meds]);

        $users = DB::table('stocks')
            ->join('medicines', 'stocks.med_id', '=', 'medicines.id')
            ->select('stocks.*', 'medicines.med_name as medicine_name')
            ->get();
        return response()->json($users);
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

    public function expired()
    {
        $myarr = [];
        $expiredStocks = Stock::whereDate('expiry_date', '<', Carbon::today())->get();
        foreach ($expiredStocks as $ex) {
            $med = medicine::where('id', $ex->med_id)->get();
            foreach ($med as $m) {
                array_push($myarr, $m->med_name);
            }
        }
        return response()->json(['data' => $expiredStocks, 'med' => $myarr]);
    }

    public function stockCreated()
    {
        $myarr = [];
        $stocks = Stock::orderBy('created_at', 'asc')->get();
        foreach ($stocks as $ex) {
            $med = medicine::where('id', $ex->med_id)->get();
            foreach ($med as $m) {
                array_push($myarr, $m->med_name);
            }
        }
        return response()->json(['data' => $stocks, 'med' => $myarr]);
    }


    public function getZeroQuantityStocks()
    {
        $myarr = [];
        $zeroQuantityStocks = Stock::where('quantity', 0)->get();
        foreach ($zeroQuantityStocks as $ex) {
            $med = medicine::where('id', $ex->med_id)->get();
            foreach ($med as $m) {
                array_push($myarr, $m->med_name);
            }
        }
        return response()->json(['data' => $zeroQuantityStocks, 'med' => $myarr]);
    }

    public function delete(Request $request)
    {
        foreach ($request->input('array') as $d) {

            stock::where('batch_no', $d['batchNo'])->delete();
        }
        return response()->json();
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
}
