<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Education;
use App\Models\Country;
use App\Http\Resources\EducationResource;

class EducationController extends Controller
{
    //
    public function index()
    {
        //$data = Education::latest()->get();
        $data = Education::join('countries','countries.id','=','education.country_id')
        ->get(['education.*','countries.name as country']);
        return response()->json([EducationResource::collection($data), 'Education fetched.']);
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
            'country_id' =>'required'

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $Education = Education::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'status' => $request->status,
            
         ]);
        
        return response()->json(['Education created successfully.', new EducationResource($Education)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Education = Education::find($id);
        if (is_null($Education)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new EducationResource($Education)]);
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
        $Education = Education::find($id);
        //$student->name = $request->input('name');


        $Education->name = $request->name;
        $Education->country_id =$request->country_id;
        $Education->status = $request->status;
       
        $Education->save();
        
        return response()->json(['Education updated successfully.', new EducationResource($Education)]);
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
       $Education = Education::find($id); 
       $Education->delete();

        return response()->json('Education deleted successfully');
    }
}
