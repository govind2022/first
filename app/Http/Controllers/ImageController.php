<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Postimage;
use App\Http\Resources\ImageuploadResource;


class ImageController extends Controller
{
    //
   public function upload(Request $request){
       $result =$request->file('file')->store('/public');
       return ['result'=>$result];
   }
       
    
        
}  
    

