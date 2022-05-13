<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Country;
use App\Http\Resources\CountryResource;

class CountryController extends Controller
{
    //
    public function index()
    {
        $data = Country::latest()->get();
        return response()->json([CountryResource::collection($data), 'Country fetched.']);
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
            'name' => 'required|string|max:255',
            

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $Country = Country::create([
            'name' => $request->name,
            'code' =>$request->code,
            'status' => $request->status,
            
         ]);
        
        return response()->json(['Country created successfully.', new CountryResource($Country)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Country = Country::find($id);
        if (is_null($Country)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CountryResource($Country)]);
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
        $Country = Country::find($id);
        //$student->name = $request->input('name');


        $Country->name = $request->name;
        $Country->code = $request->code;
        $Country->status = $request->status;
       
        $Country->save();
        
        return response()->json(['Country updated successfully.', new CountryResource($Country)]);
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
       $Country = Country::find($id); 
       $Country->delete();

        return response()->json('Country deleted successfully');
    }
    public function search($name)
    {
        return Country::where('name',$name)
        ->get();
    }
}
