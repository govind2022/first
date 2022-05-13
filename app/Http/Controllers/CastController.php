<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Models\Cast;
use App\Http\Resources\CasteResource;

class CastController extends Controller
{
    //
    public function index()
    {
        $data = Cast::latest()->get();
        return response()->json([CasteResource::collection($data), 'Cast fetched.']);
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

        $Cast = Cast::create([
            'name' => $request->name,
            'status' => $request->status
            
         ]);
        
        return response()->json(['Cast created successfully.', new CasteResource($Cast)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Cast = Cast::find($id);
        if (is_null($Cast)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new CasteResource($Cast)]);
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
        $Cast = Cast::find($id);
        //$student->name = $request->input('name');


        $Cast->name = $request->name;
        $Cast->status = $request->status;
       
        $Cast->save();
        
        return response()->json(['Cast updated successfully.', new CasteResource($Cast)]);
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
       $Cast = Cast::find($id); 
       $Cast->delete();

       

        return response()->json('Cast deleted successfully');
    }
}
