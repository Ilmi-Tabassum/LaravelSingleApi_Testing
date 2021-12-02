<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Employee;

class ApiController extends Controller
{
    //Create Api-Post
    public function createEmployee(Request $request)
    {

        //validation
        $request->validate([
            "name" => "required",
            "email" => "required|email| unique:employees",
            "phone_num" => "required",
            "gender" => "required",
            "age" => "required|integer"

        ]);

        //create data

        $employee = new Employee();

        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone_num = $request->phone_num;
        $employee->gender = $request->gender;
        $employee->age = $request->age;

        $employee->save();

        //We can create employee :
//      Employee::create([
//          "name" =>$request->name
//      ]);


        //send response
        return response()->json([
            "status" => 1,
            "message" => "Employeee Created Successfully"
        ]);
    }


//List API-Get
    public function listEmployees()
    {

        $employees = Employee::get();
//      print_r($employees);
        return response()->json([
            "status" => 1,
            "message" => "Listing employees",
            "data" => $employees
        ], 200);
    }

//SINGLE DETAIL API - get
    public function getSingleEmployee($id)
    {
        if (Employee::where("id", $id)->exists()) {
            $employee_detail = Employee::where("id", $id)->first();

            return response()->json([
                "status" => 1,
                "message" => "Employee found",
                "data" => $employee_detail
            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee Not Found!!"
            ], 404);
        }
    }

    //Update Api - PUT
    public function updateEmployee(Request $request, $id)
    {

        if (Employee::where("id", $id)->exists()) {
            $employee = Employee::find($id);
            $employee->name = !empty($request->name) ? $request->name : $employee->name;
            $employee->email = !empty($request->email) ? $request->email : $employee->email;
            $employee->phone_num = !empty($request->phone_num) ? $request->phone_num : $employee->phone_num;
            $employee->gender = !empty($request->gender) ? $request->gender : $employee->gender;
            $employee->age = !empty($request->age) ? $request->age : $employee->age;

            $employee->save();
            return response()->json([
                "status" => 1,
                "message" => "Employee Update  Successfully",

            ]);
        } else {

            return response()->json([
                "status" => 0,
                "message" => "Employee Not Found!!"
            ], 404);
        }
    }

    //Delete Api - Delete
    public function deleteEmployee($id)
    {

        if (Employee:: where("id", $id)->exists()) {
            $employee = Employee::find($id);
            $employee->delete();
            return response()->json([
                "status" => 1,
                "message" => "Employee deleted  Successfully",

            ]);
        } else {
            return response()->json([
                "status" => 0,
                "message" => "Employee Not Found!!"
            ], 404);
        }
    }
}


