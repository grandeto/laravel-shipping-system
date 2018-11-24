<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['api.headers'])->group(function () {
    Route::apiResource('/countries', 'API\CountryController');
    Route::apiResource('/prices', 'API\PriceController');
    Route::post('/compare', 'API\PriceController@compare');
});
