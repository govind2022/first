<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Religion;
use App\Models\City;
use App\Models\Country;
use App\Http\Resources\ReligionResource; 


class ReligionController extends Controller
{
    //
    public function index()
    {
        //$data = Education::latest()->get();
        $data = Religion::join('cities','cities.id','=','religions.city_id')
        ->join('countries','countries.id','=','religions.country_id')
        ->get(['religions.*','cities.name as city','countries.name as country']);
        return response()->json([ReligionResource::collection($data), 'Religion fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'country_id' =>'required',
            'city_id' => 'required'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $Religion = Religion::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
             'country_id' => $request->country_id,
            'status' => $request->status,
            
         ]);
        
        return response()->json(['Religion created successfully.', new ReligionResource($Religion)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Religion = Religion::find($id);
        if (is_null($Religion)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new ReligionResource($Religion)]);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $Religion = Religion::find($id);
        //$student->name = $request->input('name');


        $Religion->name = $request->name;
        $Religion->city_id = $request->city_id;
        $Religion->country_id =$request->country_id;
        $Religion->status = $request->status;
       
        $Religion->save();
        
        return response()->json(['Religion updated successfully.', new ReligionResource($Religion)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
       // $City = City::where('id', $id)->firstorfail()->delete();
       $Religion = Religion::find($id); 
       $Religion->delete();

        return response()->json('Religion deleted successfully');
    }
}
