<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

    public function addClass(Request $request,$id)
    {
        
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        $school = School::findOrFail($id);
        $result = $school->classes()->create($data);
        if($result)
        {
            return redirect()->back()->with('success_message','Class Created!');
        }

    }

    public function updateClass(Request $request,$id)
    {
        
        $request->validate([
            'classname'=>'required|string'
        ]);
        
        $data['name'] = $request->classname;
        $class = SchoolClass::findOrFail($id);
        
        $result = SchoolClass::where(['id'=>$class->id,'school_id'=>$class->school->id])->update($data);
        if($result)
        {
            return redirect()->back()->with('success_message','Class Updated!');
        }
    }

    public function deleteClass($id)
    {
        $class = SchoolClass::findOrFail($id);
        $result = SchoolClass::where(['id'=>$class->id,'school_id'=>$class->school->id])->delete();
        if($result)
        {
            return redirect()->back()->with('success_message','Class Deleted!');
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $schools = School::all();
        return view('backend.school.index',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        return view('backend.school.create',compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'school_name' => 'required|string',
            'school_location' =>' required|string',
            'principal' => 'required|string'
        ]);
        $school = School::Create($data);
        if($school){
            return redirect()->back()->with('success_message','School Added Successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        $classes = SchoolClass::all();
        return view('backend.school.show',compact('school','classes'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('backend.school.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $data = $request->validate([
            'school_name'=>'required|string',
            'school_location'=>'required|string',
            'principal'=>'required|string'
        ]);
        $result = School::where('id',$school->id)->update($data);
        if($result)
        {
            return redirect()->back()->with('success_message','School Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        dd($school);
    }
}
