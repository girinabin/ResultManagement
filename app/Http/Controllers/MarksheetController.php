<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use Illuminate\Http\Request;

class MarksheetController extends Controller
{
    public function create()
    {
        $schools = School::all();
        foreach($schools as $school){
            $sclasses[] = $school->classes;
        }
        // dd($sclasses);
        

        return view('backend.marksheet.create',compact('schools','sclasses'));
    }

    public function findClass(Request $request){
        $sch = $request->school;
        $schools = School::all();
        foreach($schools as $school)
        {
            if($school->school_name == $sch){
                $class[] = $school->classes;
            }
        }
        return response()->json($class,200);

    }
}
