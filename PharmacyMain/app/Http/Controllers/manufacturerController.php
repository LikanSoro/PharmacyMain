<?php

namespace App\Http\Controllers;

use App\Models\manufacturer;
use App\Models\medicine;
use App\Models\purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class manufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manufacturer/index');
    }

    public function fetchManufacturer()
    {
        $data = manufacturer::all();
        return response()->json([
            'manufacturer' => $data
        ]);
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
            'name' => 'required|max:100'
        ]);
        if ($validator->passes()) {
            $manufacturer = new manufacturer();
            $manufacturer->m_name = $request->input('name');
            $manufacturer->m_email = $request->input('email');
            $manufacturer->m_phone = $request->input('phone');
            $manufacturer->m_address = $request->input('address');
            $manufacturer->save();
            return response()->json([
                'status' => 200,
                'message' => 'manufacturer added succesfully'
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
        $id = $request->input('id');
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');

        // Find the manufacturer by ID
        $manufacturer = Manufacturer::find($id);

        // Update the manufacturer data
        $manufacturer->m_name = $name;
        $manufacturer->m_phone = $phone;
        $manufacturer->m_email = $email;
        $manufacturer->m_address = $address;
        $manufacturer->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        manufacturer::where('id', $id)->delete();

        purchase::where('mf_id', $id)->delete();

        medicine::where('mf_id', $id)->delete();
        return response()->json();
    }
}
