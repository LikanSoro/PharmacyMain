<?php

namespace App\Http\Controllers;

use App\Models\catagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class catagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('catagory/index');
    }

    public function fetch()
    {
        $catagory = catagory::all();
        return response()->json([
            'catagory'=>$catagory,
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
        $validator = Validator::make($request->all(),[
            'cat_name' => 'required|max:100'
        ]);
        if($validator->passes()){
            $catagory = new catagory();
            $catagory->cat_name = $request->input('cat_name');
            $catagory->save();
            return response()->json([
                'status'=>200,
                'message'=>'catagory added succesfully'
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
        $catagory = DB::table('catagories')->where('id',$id)->first();
        return response()->json([
            'message'=> $catagory
        ]);
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
        DB::table('catagories')->where('id',$id)->first();
        DB::update('update catagories set cat_name = ? where id = ?',[$request->input('cat_name'),$id]);
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('catagories')->where('id',$id)->delete();
        return response()->json();
    }
}
