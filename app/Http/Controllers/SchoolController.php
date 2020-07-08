<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use App\User;
use Illuminate\Http\Request;

class SchoolController extends Controller
{

   
    
    public function index()
    {
        $this->authorize('index', User::class);
        
        $schools = School::all();
        return view('backend.school.index',compact('schools'));
    }

   
    
    public function create()
    {
        $this->authorize('create',User::class);
        
        $schools = School::all();
        return view('backend.school.create',compact('schools'));
    }

    
    public function store(Request $request)
    {
        $this->authorize('store', User::class);
        $data = $request->validate([
            'school_name' => 'required|string',
            'school_location' =>' required|string',
            'principal' => 'required|string',
            'school_email'=>'required|email',
            'school_password'=>'required|string|min:8',
            
        ]);
        $user = User::Create([
            'name'=>$data['school_name'],
            'email'=>$data['school_email'],
            'password'=>bcrypt($data['school_password'])
        ]);
        $user->roles()->create([
            'name'=>'ADMIN'
        ]);
        $user->school()->create([
            'school_name'=>$data['school_name'],
            'school_location'=>$data['school_location'],
            'principal'=>$data['principal'],  
        ]);
        
      
        if($user){
            return redirect()->route('school.index')->with('success_message','School Created Successfully');
        }

    }

    
    public function edit(School $school)
    {
        $this->authorize('edit',User::class);
        return view('backend.school.edit',compact('school'));
    }

    
    public function update(Request $request, School $school)
    {
        $this->authorize('update',User::class);
        
        $data = $request->validate([
            'school_name'=>'required|string',
            'school_location'=>'required|string',
            'principal'=>'required|string',
            'school_email'=>'required|email'
        ]);
        $data['school_name'] = strtoupper($request->school_name);
        $data['school_location'] = strtoupper($request->school_location);
        $data['principal'] = strtoupper($request->principal);

        $result = School::where('id',$school->id)->update([
            'school_name'=>$data['school_name'],
            'school_location'=>$data['school_location'],
            'principal'=>$data['principal'],

        ]);
        $user = User::where('id',$school->user_id)->update([
            'email'=>$data['school_email']
        ]);
        
        if($result && $user)
        {
            return redirect()->route('school.index')->with('success_message','School Updated!');
        }
    }

   public function show(School $school){
       
       return view('backend.school.show',compact('school'));
   }
    public function destroy(School $school)
    {
        $this->authorize('destroy',User::class);
        
        $result = School::where(['id'=>$school->id])->delete();
        $user = User::where(['id'=>$school->user_id])->delete();
        if($result && $user)
        {
            return redirect()->back()->with('success_message','School Deleted!');
        }

    }

    public function schoolDelete(School $school){
        $this->authorize('destroy',User::class);
        
        $result = School::where(['id'=>$school->id])->delete();
        $user = User::where(['id'=>$school->user_id])->delete();
        if($result && $user)
        {
            return redirect()->route('school.index')->with('success_message','School Deleted!');
        }
    }
}
