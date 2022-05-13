<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ReligionController;
use App\http\Controllers\RoleController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register',[AuthController::class ,'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('logout',[AuthController::class,'logout']);


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();

    Route::middleware('auth:sanctum')->group( function () {

Route::get('/city',[CityController::class ,'index']);
Route::post('/city',[CityController::class ,'store']);
Route::patch('/city/{id}',[CityController::class ,'update']);
Route::get('/cityshow/{id}',[CityController::class ,'show']);
Route::delete('/citydelete/{id}',[CityController::class ,'destroy']);
/*Cast*/
Route::get('/cast',[CastController::class ,'index']);
Route::post('/cast',[CastController::class ,'store']);
Route::patch('/cast/{id}',[CastController::class,'update']);
Route::get('/castshow/{id}',[CastController::class,'show']);
Route::delete('/castdelete/{id}',[CastController::class,'destroy']);
/*Country*/
Route::get('/country',[CountryController::class ,'index']);
Route::post('/country',[CountryController::class ,'store']);
Route::patch('/country/{id}',[CountryController::class,'update']);
Route::get('/show/{id}',[CountryController::class,'show']);
Route::delete('/delete/{id}',[CountryController::class,'destroy']);
Route::get('/searchcountry/{name}', [CountryController::class,'search']);
/*imageupload*/
Route::get('/image',[ImageController::class,'addImage']);
Route::post('/image',[ImageController::class,'upload']);
Route::get('/viewimage',[ImageController::class,'viewImage']);
/*Education*/
Route::get('/education',[EducationController::class,'index']);
Route::post('/education',[EducationController::class,'insert']);
Route::patch('/education/{id}',[EducationController::class,'update']);
Route::get('/educationshow/{id}',[EducationController::class,'show']);
Route::delete('/deleteeducation/{id}',[EducationController::class,'delete']);
/*Religion*/
Route::get('/religion',[ReligionController::class,'index']);
Route::post('/religion',[ReligionController::class,'insert']);
Route::patch('/religion/{id}',[ReligionController::class,'update']);
Route::get('/religionshow/{id}',[ReligionController::class,'show']);
Route::delete('/religiondelete/{id}',[ReligionController::class,'delete']);
/*Role*/
Route::get('/role',[RoleController::class,'index']);
Route::post('/role',[RoleController::class,'insert']);
Route::patch('/role/{id}',[RoleController::class,'update']);
Route::get('/roleshow/{id}',[RoleController::class,'show']);
Route::delete('/roledelete/{id}',[RoleController::class,'delete']);
});