<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PagesController;

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

Route::prefix('pages')->group( function(){
  Route::get('/{id}/{p_id?}', [PagesController::class, 'index']);
  Route::post('/save', [PagesController::class, 'store']);
  Route::post('/delete', [PagesController::class, 'destroy']);
  Route::post('/update', [PagesController::class, 'update']);
});