<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware'=>'setLocale'], function (){
//
//    Route::get('/blogs', [ApiController::class, 'blogs']);
//    Route::get('/blog_single/{id}', [ApiController::class, 'blog_single']);
//    Route::get('/faqs', [ApiController::class,'faqs']);
//
//});
