<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Reportingteacher;
use App\Models\Student;
use App\Models\Marklist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    public function newstudent()
    {
        if (Auth::id() == "") {
            return view('auth.Login');
        } else {
            $teachers = Reportingteacher::get();
            return view('Student.newstudent')->with(['teachers' => $teachers]);
        }
    }

    public function studentlist(){
        if (Auth::id() == "") {
            return view('auth.Login');
        } else {
            $teachers = Reportingteacher::get();
            return view('Student.studentlist')->with(['teachers' => $teachers]);
        }
    }

    public function ajaxstudentslist(){ 
        $data = Student::get();
        $object = array();
        foreach($data as $student){
            array_push($object ,[
                "student_id" => $student->student_id,
                "student_name" => $student->student_name,
                "age" => $student->age,
                "gender" => $student->gender,
                "teacher_name" => $student->teacher->teacher_name,
            ]); 
        }
        return Datatables::of($object)->make(true);
    }

    public function add_student(Request $request , Student $student){
        $validator = Validator::make($request->all(), [
            'student_name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'teacher_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()[0], 'status' => 202]);
        } else {
            $student->student_name = $request->student_name;
            $student->age = $request->age;
            $student->gender = $request->gender;
            $student->teacher_id = $request->teacher_id;
            if ($student->save()) {
                return response()->json(['message' => 'Student Added Successfully', 'status' => 201]);
            } else {
                return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
            }

        }
    }

    public function student_details(Request $request){
        $data = Student::find($request->student_id);
        return $data;
    }

    public function student_update(Request $request){
        $student = Student::find($request->student_id);
        $student->student_name = $request->student_name;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->teacher_id = $request->teacher_id;
        if($student->save()){
            return response()->json(['message' => 'Student Updated Successfully', 'status' => 201]);
        } else {
            return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
        }

    }

    public function student_delete(Request $request){
        if(Student::find($request->student_id)->delete()){
            DB::table('mark_list')->where('student_id',$request->student_id)->delete();
            return response()->json(['message' => 'Student Deleted Successfully', 'status' => 201]);
        }else{
            return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
        }
    }

    public function marklist(){
        if (Auth::id() == "") {
            return view('auth.Login');
        } else {
            $students = Student::get();
            return view('Student.marklist')->with(['students' => $students]);
        }
    }

    public function ajaxmarklist(){
        $data = Marklist::get();
        $object = array();
        foreach($data as $mark){
            array_push($object ,[
                "marklist_id" => $mark->marklist_id,
                "student_name" => $mark->student->student_name,
                "maths" => $mark->maths,
                "science" => $mark->science,
                "history" => $mark->history,
                "term" => $mark->term,
                "totalmark" => $mark->maths + $mark->science + $mark->history,
                "created_at" => $mark->created_at->toDayDateTimeString(),
            ]); 
        }
        return Datatables::of($object)->make(true);
    }

    public function newstudentmark(){
        if (Auth::id() == "") {
            return view('auth.Login');
        } else {
            $students = Student::get();
            return view('Student.newstudentmark')->with(['students' => $students]);
        }
    }

    public function add_studentmark(Request $request ,Marklist $marklist){
        $validator = Validator::make($request->all(), [
            'student_name' => 'required',
            'term' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->all()[0], 'status' => 202]);
        } else {
            $marklist->student_id = $request->student_name;
            $marklist->term = $request->term;
            $marklist->maths = $request->maths;
            $marklist->science = $request->science;
            $marklist->history = $request->history;
            if ($marklist->save()) {
                return response()->json(['message' => 'Student Mark Added Successfully', 'status' => 201]);
            } else {
                return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
            }

        }
    }

    public function studentmark_delete(Request $request){
        if(Marklist::find($request->marklist_id)->delete()){
            return response()->json(['message' => 'Student Deleted Successfully', 'status' => 201]);
        }else{
            return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
        }
    }

    public function studentmark_details(Request $request){
        $data = Marklist::find($request->marklist_id);
        return $data;
    }

    public function studentmark_update(Request $request){
        $marklist = Marklist::find($request->marklist_id);
        $marklist->student_id = $request->student_name;
        $marklist->term = $request->term;
        $marklist->maths = $request->maths;
        $marklist->science = $request->science;
        $marklist->history = $request->history;
        if($marklist->save()){
            return response()->json(['message' => 'Student Mark Updated Successfully', 'status' => 201]);
        } else {
            return response()->json(['message' => 'Someting Went Wrong', 'status' => 202]);
        }
    }
}
