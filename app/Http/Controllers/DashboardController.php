<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolClass;
use Illuminate\Http\Request;
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
        
        return view('backend.dashboard.index');
    }

    public function addClass(Request $request)
    {
        $school = School::find(2);
        $sclass = SchoolClass::create(['name'=>$request->name]);
        $school->schoolClasses()->syncWithOutDetaching($sclass);
        return redirect()->back();
    }
}
