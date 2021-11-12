<?php

use App\Http\Controllers\AssignementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InternController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;


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
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::resource('/Interns',InternController::class);
    Route::get('/Interns/download/{id}',[FileController::class,'show']);
    Route::post('/Interns/upload/{id}',[FileController::class,'store']);
    Route::get('/Interns/show/{id}',[InternController::class,'showInfo']);
    Route::resource('/Groups',GroupController::class);
    Route::get('/Group/get/{id}',[GroupController::class,'showInfo']);

    Route::resource('/Users',UserController::class);

    Route::resource('/Assignment',AssignementController::class);
    Route::post('/Assignment/copy/{id}',[AssignementController::class,'copy']);
    
    Route::resource('/Reviews',ReviewController::class);
});

Route::post('/login',[UserController::class,'logIn']);

