<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    
    return $request->user();
});
Route::get('/events', [ApiController::class, 'getAllEvents']);
Route::get('/team', [ApiController::class, 'getAllTeam']);

Route::get('/googleapi', [ApiController::class, 'getGoogleEvents']);
Route::get('/googleapi/title/{title}', [ApiController::class, 'getGoogleIndividualEvent']);
Route::get('/team/department/{department}', [ApiController::class, 'getTeamFromDepartment']);

Route::get('/events/title/{title}', [ApiController::class, 'getIndividualEvent']);
Route::get('/googleapi-non', [ApiController::class, 'getGoogleEventsNotInDatabase']);