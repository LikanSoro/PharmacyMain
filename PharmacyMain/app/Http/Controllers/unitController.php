<?php

namespace App\Http\Controllers;

use App\Models\units;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class unitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchUnit(){
        $data = units::all();
        return response()->json([
            'units'=>$data
        ]);
    }

    public function index()
    {
        return view('unit/index');
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
        $validator = Validator::make($request->all(),[
            'unit_name' => 'required|max:100'
        ]);
        if($validator->passes()){
            $units = new units();
            $units->unit_name = $request->input('unit_name');
            $units->save();
            return response()->json([
                'status'=>200,
                'message'=>'units added succesfully'
            ]);
        }
        else{
            return response()->json([
            'status'=> 500,
            'error'=>$validator->errors()
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
