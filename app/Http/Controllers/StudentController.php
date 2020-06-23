<?php

namespace App\Http\Controllers;

use App\SchoolClass;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Importer;

class StudentController extends Controller
{

    public function importExcel(Request $request,SchoolClass $class)
    {
        $request->validate([
            'file'=>'required|max:5000|mimes:xls,xlsx,csv'
        ]);
            $students = $request->hasFile('file');
            if($students)
            {
                $dateTime = date('Ymd_His');
                $file = $request->file('file');
                $fileName = $dateTime .'-'.$file->getClientOriginalName();
                $savepath = public_path('/uploads/student/');
                $file->move($savepath,$fileName);
                $excel = Importer::make('Excel');
                $excel->load($savepath.$fileName);
                $collection = $excel->getCollection();
                if($collection[0][0]=="Batch" && $collection[0][1]=="SymbolNo" && $collection[0][2]=="Name" && $collection[0][3]=="Father's Name" && $collection[0][4]=="Dob")
                {
                    for($row=1;$row<sizeof($collection);$row++)
                {
                    $class->students()->create([
                        'batch'=>$collection[$row][0],
                        'symbol_no'=>$collection[$row][1],
                        'name'=>$collection[$row][2],
                        'father_name'=>$collection[$row][3],
                        'dob'=>$collection[$row][4],
                        // 'class_id'=>1
                    ]);
                }
                 return redirect()->back()->with('success_message','Imported Successfully!');

                }else{
                    return redirect()->back()->with('error_message','Excel file not Match with Sample given');
                }
                


            }
        
    }
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
    public function show(Student $student)
    {
        $results = $student->sclass->results;
        foreach($results as $result){
            if($result->studentresults['symbol_no']==$student->symbol_no){
                $res[] = $result;
            }
        }
        foreach($res as $re){
            $rest[] = $re->studentresults;
        }
        foreach($rest as $key=>$value){
            $rest[$key] =(object) $value;
        }
       
        $resultss =  json_decode(json_encode($rest),true);
        $results = array_shift($resultss);
       
        return view('backend.student.show',compact('student','resultss'));
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
