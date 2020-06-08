<?php

namespace App\Http\Controllers;

use App\SchoolClass;
use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolClass $class)
    {
        $students = Student::where('class_id',$class->id)->get();
        return view('backend.student.index',compact('class','students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,SchoolClass $class)
    {
        $data = $request->validate([
            'batch'=>'required|numeric',
            'symbol_no'=>'required|numeric|unique:students',
            'name'=>'required',
            'father_name'=>'required',
            'dob'=>'required'
        ]);

        $result = $class->students()->create($data);
        if($result)
        {
            return redirect()->back()->with('success_message','Student Created!');
        }
        

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'batch'=>'required',
            'symbol_no'=>'required',
            'name'=>'required',
            'father_name'=>'required',
            'dob'=>'required'
        ]);
    
        
        $result = Student::where(['id'=>$student->id,'class_id'=>$student->class_id])->update($data);
        if($result)
        {
            return redirect()->back()->with('success_message','Student Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $result = Student::where(['id'=>$student->id,'class_id'=>$student->class_id])->delete();
        if($result)
        {
            return redirect()->back()->with('success_message','Student Deleted!');
        }
    }
}
