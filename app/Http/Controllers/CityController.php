<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Models\City;
use App\Http\Resources\CityResource;




class CityController extends Controller
{
    //
    public function index()
    {
        $data = City::latest()->get();
        return response()->json([CityResource::collection($data), 'City fetched.']);
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
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $City = City::create([
            'name' => $request->name,
            
         ]);
        
        return response()->json(['City created successfully.', new CityResource($City)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $City = City::find($id);
        if (is_null($City)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CityResource($City)]);
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
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
        $City = City::find($id);
        //$student->name = $request->input('name');


        $City->name = $request->name;
       
        $City->save();
        
        return response()->json(['City updated successfully.', new CityResource($City)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $City = City::where('id', $id)->firstorfail()->delete();
       $City = City::find($id); 
       $City->delete();

        return response()->json('City deleted successfully');
    }
}
