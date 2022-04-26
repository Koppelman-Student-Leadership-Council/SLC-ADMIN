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
Route::get('/clubs', [ApiController::class, 'getAllClubs']);

Route::get('/team/active', [ApiController::class, 'getAllActiveTeam']);

Route::get('/events-calendar', [ApiController::class, 'getGoogleEventsParsed']);
Route::get('/events-calendar/title/{title}', [ApiController::class, 'getGoogleIndividualEvent']);
Route::get('/team/department/{department}', [ApiController::class, 'getTeamFromDepartmentActive']);

Route::get('/events/title/{title}', [ApiController::class, 'getIndividualEvent']);
Route::get('/events-calendar-non', [ApiController::class, 'getAllEvents']);
Route::get('/events-calendar-non/{title}', [ApiController::class, 'existsInDatabaseRes']);











