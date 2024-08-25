<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use  App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function createEmployee(Request $request)
    {
        $employeecreate = new Employee;

        parse_str($request->input('data'), $form_data);
        $employeecreate->name = $form_data['name'];
        $employeecreate->email = $form_data['email'];
        $employeecreate->phone = $form_data['phone'];
        if (empty($form_data['id']) || ($form_data['id'] == "")) {
            $employeecreate->save();
        } else {
            $employeecreate = Employee::find($form_data['id']);
            $employeecreate->name = $form_data['name'];
            $employeecreate->email = $form_data['email'];
            $employeecreate->phone = $form_data['phone'];
            $employeecreate->update();
        }

        // return redirect()->back()->with('success', 'Employee Created Successfully');
    }
        public function getEmployee(Request $request)
        {
            return Employee::orderBy('id', 'desc')->get();
        }
        public function editEmployee(Request $request)
        {
            return Employee::find($request->id);
        }
}
