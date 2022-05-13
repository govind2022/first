<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Role;
use App\http\Resources\RoleResource;

class RoleController extends Controller
{
    //
    public function index()
    {
        $data= Role::latest()->get();
        return responce()->join([RoleResource::collection($data),'Role fetched.']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'name'=>'required|string|max:255',
       ]);
       if($validator->fails()){
            return response()->json($validator->errors());
        }
             $Role = Role::Create([
        'name' => $request->name,
        'status' =>$request->status,

            ]);
            return response()->json(['Role Created successfully.', new RoleResource($Role)]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Role =Role::find($id);
        if(is_null($Role)){
            return response()->json('Data not found', 404); 
        }
        return response()->json([new RoleResource($Role)]);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator= Validator::make($request->all(),
        [
            'name'=>'required|string|max:255',
       ]);
       if($validator->fails()){
        return response()->json($validator->errors());       
    }
    $Role=Role::find($id);

    $Role->name = $request->name;
    $Role->status = $request->status;

    $Role->save();
    return response()->json(['Role Updated successfully.', new RoleResource($Role)]);
    }
    public function delete($id)
    {
        $Role=Role::find($id);
        $Role->delete();
        return response()->json('role Delete Successfully');
    }
}