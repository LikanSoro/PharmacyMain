<?php

namespace App\Http\Controllers;

use App\Models\catagory;
use App\Models\manufacturer;
use App\Models\medicine;
use App\Models\purchase;
use App\Models\sale;
use App\Models\units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class medicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function catagory()
    {
        //    
    }

    public function index()
    {
        $manufacturer = manufacturer::all();
        $catagory = catagory::all();
        $um = units::all();
        // $data = medicine::all();
        return view('medicine.addMedicine', ['catagory' => $catagory, 'unit' => $um, 'manufacturer' => $manufacturer]);
    }

    public function fetchMedicine()
    {
        $medicine = medicine::with(['catagory', 'units', 'manufacturer'])->get();
        $catagory = catagory::all();
        $unit = units::all();
        $manufacturer = manufacturer::all();
        return response()->json([
            'med' => $medicine,
            'cat' => $catagory,
            'unit' => $unit,
            'mf' => $manufacturer
        ]);
    }

    public function manageMedicine()
    {
        return view('medicine.manageMedicine');
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
        // print 'eh';
        $validator = Validator::make($request->all(), [
            'medicine_name' => 'required|string|max:255',
            'catagory' => 'required',
            'unit' => 'required',
            'manufacturer' => 'required',
            'generic' => 'required|max:255',
            'strength' => 'required',
        ]);
        if ($validator->passes()) {
            $medicine = new medicine();
            $medicine->med_name = $request->input('medicine_name');
            $medicine->cat_id = $request->input('catagory');
            $medicine->unit_id = $request->input('unit');
            $medicine->mf_id = $request->input('manufacturer');
            $medicine->generic_name = $request->input('generic');
            $medicine->strength = $request->input('strength');
            $medicine->details = $request->input('detail');
            $medicine->save();
            return response()->json([
                'status' => 200,
                'message' => 'units added succesfully'
            ]);
        } else {
            return response()->json(['status' => 500, 'error' => $validator->errors()]);
        }
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
        $medicine = medicine::find($id);

        if (!$medicine) {
            return response()->json(['error' => 'Medicine not found'], 404);
        }

        if ($request->has('generic')) {
            $medicine->generic_name = $request->input('generic');
        }

        if ($request->has('strength')) {
            $medicine->strength = $request->input('strength');
        }

        if ($request->has('details')) {
            $medicine->details = $request->input('details');
        }

        $medicine->save();

        return response()->json(['message' => 'Medicine updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        medicine::where('id', $id)->delete();
        purchase::where('med_id', $id)->delete();
        sale::where('med_id', $id)->delete();
        return response()->json();
    }
}
