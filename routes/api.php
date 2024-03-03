<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\employeeApi\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// creating routes

Route::get('students',[StudentController::class,'index']);
Route::post('students',[StudentController::class,'store']);
Route::get('students/{id}',[StudentController::class,'show']);
Route::get('students/{id}/edit',[StudentController::class,'edit']);
Route::put('students/{id}/edit',[StudentController::class,'update']);
Route::delete('students/{id}/delete',[StudentController::class,'destroy']);

Route::get('employees',[EmployeeController::class,'index']);
Route::post('employees',[EmployeeController::class,'store']);
Route::get('employees/{id}',[EmployeeController::class,'show']);
Route::put('employees/{id}/update',[EmployeeController::class,'update']);
Route::delete('employees/{id}/delete',[EmployeeController::class,'destroy']);
