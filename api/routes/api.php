<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

//Api Phase 1
//Get the list of all employees using route : http://127.0.0.1:8000/api/list-employees
Route::get("list-employees", [ApiController::class,"listEmployees"]);


Route::get("single-employees/{id}", [ApiController::class,"getSingleEmployee"]);

// post Method : http://127.0.0.1:8000/api/add-employee
Route::post("add-employee", [ApiController::class,"createEmployee"]);

//Update : http://127.0.0.1:8000/api/update-employee/1
Route::put("update-employee/{id}", [ApiController::class,"updateEmployee"]);

//Delete : http://127.0.0.1:8000/api/delete-employee/1
Route::delete("delete-employee/{id}", [ApiController::class,"deleteEmployee"]);
