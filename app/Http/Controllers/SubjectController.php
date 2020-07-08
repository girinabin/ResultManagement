<?php

namespace App\Http\Controllers;

use App\Result;
use App\SchoolClass;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   
    public function index(SchoolClass $class)
    {
        $this->authorize('create',Subject::class);
        $this->authorize('creates',$class);
        $subjects = Subject::where('class_id', $class->id)->get();
        return view('backend.subject.index', compact('subjects', 'class'));
    }

    
    public function create(SchoolClass $class)
    {
        $this->authorize('create',Subject::class);
        $this->authorize('creates',$class);
        return view('backend.subject.create', compact('class'));
    }

    
    public function store(Request $request, SchoolClass $class)
    {
        $this->authorize('create',Subject::class);
        $this->authorize('creates',$class);

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

    
    public function edit(Subject $subject)
    {
        $this->authorize('editSubject',$subject);
        
        return view('backend.subject.edit', compact('subject'));
    }

    
    public function update(Request $request, Subject $subject)
    {
        $this->authorize('editSubject',$subject);

        $postData = $request->validate([
            'name' => 'required',
            'FM' => 'required|numeric',
            'PM' => 'required|numeric',
        ]);
         Subject::where(['id'=>$subject->id,'class_id'=>$subject->class_id])->update($postData);


        return redirect()->route('subject.index',$subject->class->id)->with('success_message', 'Subject Updated Successfully');
    }

    
    public function destroy(Subject $subject)
    {
        $this->authorize('editSubject',$subject);
        $data = Subject::where('id', $subject->id)->delete();
        if ($data) {
            return redirect()->back()->with('success_message', 'Subject Deleted!');
        }
    }
}
