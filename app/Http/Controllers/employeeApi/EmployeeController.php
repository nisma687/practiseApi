<?php

namespace App\Http\Controllers\employeeApi;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    // getting all data from the table
    public function index(Request $request){
        $employee=Employee::all();
        if($employee->count()>0){
            return response()->json([
                "employees" => $employee,
                "message"=>"found some data",
                "status"=>"success",



            ]);
        }else{
            return response()->json([
                
                "message"=>"no data found",
                "status"=>"success",
            ]);
        }
    }
    public function store (Request $request){
        $validate=Validator::make($request->all(),[
            "Name"=>"required|string|max:232",
            "Phone"=>"required|string|digits:11",
            "Email"=>"required|string|email",
            "DateOfBirth"=>"required|string"
        ]);
        if($validate->fails()){
            return response()->json([
                "error"=> $validate->errors()->first(),
                "message"=> "error occurred",
            ],404) ;
        }
        else{
            $employee=Employee::create(
               [
                "Name"=> $request->Name,
                "Email"=> $request->Email,
                "Phone"=> $request->Phone,
                "DateOfBirth"=> $request->DateOfBirth,
               ]
            );
            return response()->json([
                "EMployee"=> $employee,
                "message"=> "success",
            ]);
        }
    }
    public function show($id){
        $employee=Employee::find($id);
        if($employee){
            return response()->json([
                "employees" => $employee,
                "message"=>"found",
                "status"=>"success",



            ]);
        }else{
            return response()->json([
                
                "message"=>"no data found",
                "status"=>"success",
            ]);
        }
    }
    public function update(Request $request,$id){
        $validate=Validator::make($request->all(),[
            "Name"=>"required|string|max:232",
            "Phone"=>"required|string|digits:11",
            "Email"=>"required|string|email",
            "DateOfBirth"=>"required|string"
        ]);
        if($validate->fails()){
            return response()->json([
                "error"=> $validate->errors()->first(),
                "message"=> "error occurred",
            ],404) ;
        }
        else{
            $employee=Employee::find($id);
            if($employee){
                $employee->update(
                    [
                     "Name"=> $request->Name,
                     "Email"=> $request->Email,
                     "Phone"=> $request->Phone,
                     "DateOfBirth"=> $request->DateOfBirth,
                    ]
                 );
                 return response()->json([
                     "EMployee"=> $employee,
                     "message"=> "success",
                 ]);
            } else{
                return response()->json([
                    "error"=> $validate->errors()->first(),
                    "message"=> "error occurred",
                ],404) ;

            }
           
        }

    }
    public function destroy($id){
        $employee=Employee::find($id);
        if($employee){
            $employee->delete();
            return response()->json([
                "EMployee"=> $employee,
                "message"=> "success employee delete",
            ]);
            
    }
    else{
        return response()->json([
            "error"=> "error occured",
            "status"=>404,
            "message"=> "error occurred",
        ],404) ;
    }
}
    
}
