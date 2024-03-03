<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index (){
        $students=Student::all();
        if($students->count()>0){
            return response()->json([
                'students'=> $students,
                'message'=>'success',
                "status"=>"200",
            ],200);
        }
        else{
            return response()->json([
                
                'message'=>'No data found',
                "status"=>"404",
            ],404);


        }  
    }
    public function store(Request $request){
        $validator= Validator:: make($request->all(),[
            'name'=>"required|string|max:255",
            'course'=>"required|string|max:255",
            'email'=>"required|email|max:255",
            'phone'=>"required|digits:11",
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages(),
                "status"=>"422",
            ],422);

        }
        else{
            $student= Student::create([
                'name'=>$request->name,
                'course'=>$request->course,
                'phone'=>$request->phone,
                'email'=>$request->email

            ]);
            if($student){
                return response()->json([
                    'message'=> 'success',
                    'status'=> 'success',
                ],200);
            }
            else{
                return response()->json([
                    'message'=> 'failed,Something went wrong',
                    'status'=> '500'
                ],500);
            }
            
        }
    }
    public function show($id){
        $student=Student::find($id);
        if($student){
            return response()->json([
                'message'=> 'Student found!!',
                'status'=> 200,
                 'student'=> $student,
            ],200);

        }else{
            return response()->json([
                'message'=> 'no student found',
                'status'=> 404,
            ],404);
        }
    }
    public function edit($id){
        $student=Student::find( $id );
        if($student){
            return response()->json([
                'message'=> 'Student found!!',
                'status'=> 200,
                 'student'=> $student,
            ],200);
                
    }
    else{
        return response()->json([
            'message'=> 'no student found',
            'status'=> 404,
        ],404);
    }  
    }
    public function update(Request $request, $id){
        $validator=Validator::make($request->all(),[
            'email'=> 'required|email',
            'phone'=> 'required|max:233|string',
            'name'=> 'required|string|max:233',
            'course'=> 'required|max:233|string',

        ]);
        if($validator->fails()){
            return response()->json(['message'=>$validator->messages(),
            "status"=>"422"],422) ;
        }
        else{
            $student=Student::find($id);
            if($student){
                $student->update([
                    'name'=> $request->name,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                    'course'=> $request->course,
                ]);
                return response()->json([
                    'message'=> 'Student Updated Successfully',
                    'status'=> 200,
                ],200);
        }
        else{
            return response()->json([
                'message'=> 'something went wrong,no such student found',
                    'status'=> 404,
            ],404);
            }
}
    }
    public function destroy($id){
       $student=Student::find($id) ;
       if($student){
        $student->delete();
        return response()->json([
            'message'=> 'successfully destroyed the data',
            'status'=> 200,
        ],200);
       }
       
       
       
       
       else{
        return response()->json([
            'message'=> 'something went wrong,no such student found',
                'status'=> 404,
        ],404);
        
       }

    }

















}
