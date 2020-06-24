<?php

namespace App\Http\Controllers;

use App\Result;
use App\SchoolClass;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SchoolClass $class)
    {
        $subjects = Subject::where('class_id', $class->id)->get();
        return view('backend.subject.index', compact('subjects', 'class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SchoolClass $class)
    {
        return view('backend.subject.create', compact('class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, SchoolClass $class)
    {

        $postData = $request->validate(
            [

                'subject' => 'required',
                'subject.*.name' => 'required',
                'subject.*.FM' => 'required|numeric',
                'subject.*.PM' => 'required|numeric',


            ],
            [
                'subject.*.name.required' => 'Subject Name Required!',
                'subject.*.FM.required' => 'Full Marks Required!',
                'subject.*.PM.required' => 'Pass Marks Required!',
                'subject.*.FM.numeric' => 'Full Marks Should Be Numeric',
                'subject.*.PM.numeric' => 'Pass Marks Should Be Numeric',


            ]
        );
        // dd($postData['subject']);
        foreach ($postData['subject'] as $data) {
            $class->subjects()->create([
                'name' => $data['name'],
                'FM' => $data['FM'],
                'PM' => $data['PM']
            ]);
        }
        return redirect()->route('subject.index', $class->id)->with('success_message', 'Subject Created Successfully');
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
    public function edit(Subject $subject)
    {
        
        return view('backend.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $postData = $request->validate([
            'name' => 'required',
            'FM' => 'required|numeric',
            'PM' => 'required|numeric',
        ]);
         Subject::where(['id'=>$subject->id,'class_id'=>$subject->class_id])->update($postData);


        return redirect()->route('subject.index',$subject->class->id)->with('success_message', 'Subject Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Subject::where('id', $id)->delete();
        if ($data) {
            return redirect()->back()->with('success_message', 'Subject Deleted!');
        }
    }
}
