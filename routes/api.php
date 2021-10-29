<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\InternController;
use App\Models\Intern;

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
Route::get('/Interns', [InternController::class,'index']);
Route::post('/Interns',[InternController::class,'store']);
Route::get('/Interns/{id}',[InternController::class,'show']);
Route::put('/Interns/{id}',[InternController::class,'update']);
Route::delete('/Interns/{id}',[InternController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
