<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class DashboardController extends Controller
{
    public function index()
    {
    //    $school = School::find(1);
    //    foreach($school->schoolClasses as $class)
    //    {
    //        print_r($class->name);
    //    } 
        
        $schools = School::orderBy('created_at','DESC')->get();
        $classes = SchoolClass::where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->get();
        // dd($classes);
        return view('backend.dashboard.index',compact('schools','classes'));
    }

    public function addClass(Request $request)
    {
        // $school = School::find(2);
        // $sclass = SchoolClass::create(['name'=>$request->name]);
        // $school->schoolClasses()->syncWithOutDetaching($sclass);
        // return redirect()->back();
    }


}
