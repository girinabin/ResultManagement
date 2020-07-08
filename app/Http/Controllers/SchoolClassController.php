<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function createClass(){
        
        $this->authorize('createClass',SchoolClass::class);
        return view('backend.class.create');
    }

    public function addClass(Request $request,User $user)
    {
        $this->authorize('addClass',SchoolClass::class);
        $postData = $request->validate(
            [
                'subject' => 'required',
                'subject.*.name' => 'required',
            ],
            [
                'subject.required'=>'Class Field Required',
                'subject.*.name.required' => 'Class Name Required!',
            ]
        );
        foreach($postData['subject'] as $subject){
            $user->sclasses()->create([
                'name'=>$subject['name']
                ]);
        }
        
        
       
            return redirect()->route('index.class',$user->id)->with('success_message','Class Created!');
        

    }

    public function indexClass(User $user){
        $this->authorize('indexClass',SchoolClass::class);
        $sclasses = SchoolClass::where(['user_id'=>$user->id])->orderBy('created_at','DESC')->get();
        return view('backend.class.index',compact('sclasses'));
    }

    public function updateClass(Request $request,SchoolClass $class)
    {
        $this->authorize('updateClass',$class);
  
        
        $request->validate([
            'classname'=>'required|string'
        ]);
        
        $data['name'] = strtoupper($request->classname);
        $class = SchoolClass::findOrFail($class->id);
        
        $result = SchoolClass::where(['id'=>$class->id,'user_id'=>$class->user->id])->update($data);
        if($result)
        {
            return redirect()->back()->with('success_message','Class Updated!');
        }
    }

    public function deleteClass(SchoolClass $class)
    {
        $this->authorize('deleteClass',$class);
        $class = SchoolClass::findOrFail($class->id);
        $result = SchoolClass::where(['id'=>$class->id,'user_id'=>$class->user->id])->delete();
        if($result)
        {
            return redirect()->back()->with('success_message','Class Deleted!');
        }

    }
}
