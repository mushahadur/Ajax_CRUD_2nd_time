<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        
        return view('form', ['students' => Student::orderBy('id', 'desc')->get()]);
    }

    public function addStudent(Request $request){
        Student::newStudent($request);
        return response()->json(['res'=>'Student Created Successfully !']);
    }
    public function delete($id){
        Student::deleteStudent($id);
        return response()->json(['result'=>'success']);
    }
}
