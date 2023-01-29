<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        return view('form');
    }

    public function addStudent(Request $request){

        $file =  $request->file('file');
        $fileName = time().''.$file->getClientOriginalName();
        $filePath = $file->storAs('images',$fileName,'public');

        $student = new Student;
        $studnent->name = $request->name;
        $studnent->email = $request->email;
        $studnent->image = $filePath;
        $studnent->save();


        return response()->json(['res'=>'Student Created Successfully !']);
    }
}
