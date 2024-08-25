<?php

namespace App\Http\Controllers;
use  App\Models\User;
use  App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function createStudent(Request $request)
    {
        $student = new Student;

        parse_str($request->input('data'), $form_data);
        $student->first_name = $form_data['first_name'];
        $student->last_name = $form_data['last_name'];
        $student->email = $form_data['email'];
        $student->gender = $form_data['gender'];
        if (empty($form_data['id']) || ($form_data['id'] == "")) {
            $student->save();
        } else {
            $student = Student::find($form_data['id']);
            $student->first_name = $form_data['first_name'];
            $student->email = $form_data['email'];
            $student->last_name = $form_data['last_name'];
            $student->gender = $form_data['gender'];

            $student->update();
        }

        // return redirect()->back()->with('success', 'Employee Created Successfully');
    }
}
