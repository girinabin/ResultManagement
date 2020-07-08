<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Result;
use App\SchoolClass;
use App\Student;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Importer;

class StudentController extends Controller
{
    public function create(Batch $batch)
    {
        $this->authorize('create', Student::class);
        $this->authorize('batchStudent', $batch);
        return view('backend.student.create', compact('batch'));
    }


    public function importExcel(Request $request, Batch $batch)
    {
        $this->authorize('create', Student::class);
        $this->authorize('batchStudent', $batch);
        $request->validate([
            'file' => 'required|max:5000|mimes:xls,xlsx,csv'
        ]);
        $students = $request->hasFile('file');
        if ($students) {
            $dateTime = date('Ymd_His');
            $file = $request->file('file');
            $fileName = $dateTime . '-' . $file->getClientOriginalName();
            $savepath = public_path('/uploads/student/');
            $file->move($savepath, $fileName);
            $excel = Importer::make('Excel');
            $excel->load($savepath . $fileName);
            $collection = $excel->getCollection();
            $students = $batch->students;
            foreach ($students as $student) {
                $symbol_db[] = $student->symbol_no;
                foreach ($collection as $coll) {

                    $symbol_ex[] = $coll[0];
                }
            }
            if ($students->count() > 0) {
                $result = array_intersect($symbol_db, $symbol_ex);
                if ($result !== array()) {
                    return redirect()->back()->with('error_message', 'Duplicate SymbolNo');
                }
            }






            if ($collection[0][0] == "SymbolNo" && $collection[0][1] == "Name" && $collection[0][2] == "Father's Name" && $collection[0][3] == "Dob") {
                for ($row = 1; $row < sizeof($collection); $row++) {
                    $batch->students()->create([
                        'class_id' => $batch->sclass->id,
                        'symbol_no' => $collection[$row][0],
                        'name' => $collection[$row][1],
                        'father_name' => $collection[$row][2],
                        'dob' => $collection[$row][3],

                    ]);
                }
                return redirect()->back()->with('success_message', 'Imported Successfully!');
            } else {
                return redirect()->back()->with('error_message', 'Excel file not Match with Sample given');
            }
        }
    }

    public function index(Batch $batch)
    {
        $this->authorize('create', Student::class);
        $this->authorize('batchStudent', $batch);
        $results = Result::all();
        if (count($results) > 0) {
            foreach ($results as $r) {
                foreach ($r->studentresults as $sym) {
                    $symbol[] = $sym['SymbolNo'];
                }
            }
            $students = Student::where('class_id', $class->id)->get();

            return view('backend.student.index', compact('class', 'students', 'results', 'symbol'));
        } else {
            $students = Student::where(['class_id' => $batch->sclass->id, 'batch_id' => $batch->id])->get();

            return view('backend.student.index', compact('batch', 'students', 'results'));
        }
    }


    public function store(Request $request, Batch $batch)
    {
        $this->authorize('create', Student::class);
        $this->authorize('batchStudent', $batch);

        $data = $request->validate([
            'symbol_no' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'dob' => 'required'
        ]);

        $result = $batch->students()->create([
            'class_id' => $batch->sclass->id,
            'symbol_no' => $data['symbol_no'],
            'name' => $data['name'],
            'father_name' => $data['father_name'],
            'dob' => $data['dob']

        ]);
        if ($result) {
            return redirect()->back()->with('success_message', 'Student Created!');
        }
    }


    public function show(Student $student)
    {
        $this->authorize('create', Student::class);
        $this->authorize('show', $student);
        $studentLists = $student->sclass->students;
        $subjects = $student->sclass->subjects;


        $marks = $student->sclass->results;
        foreach ($marks as $mark) {
            if ($mark->studentresults[0]['SymbolNo'] == $student->symbol_no) {
                $marks = $mark->studentresults;
            }
        }
        // dd($marks);
        $final = $marks[0];
        unset($final['SymbolNo']);



        $total = 0;

        foreach ($final as $key => $f) {
            $total += (int) $f;
        }
        // dd($total);

        $fullmarks = 0;
        foreach ($subjects as $subject) {
            $fullmarks += (int) $subject->FM;
        }
        $percentage = ($total / $fullmarks) * 100;

        foreach ($subjects as $key => $subject) {
            foreach ($final as $index => $f) {
                if (strtolower($subject->name) == strtolower($index)) {
                    $avalue[] = $subject;
                    $bkeys[] = $f;
                }
            }
        }


        $newArray = array_map(null, $bkeys, $avalue);


        $pdf = PDF::loadView('backend.student.shows', compact('student', 'final', 'total', 'subjects', 'newArray', 'percentage', 'studentLists'));
        return $pdf->download('invoice.pdf');


        return view('backend.student.shows', compact('student', 'final', 'total', 'subjects', 'newArray', 'percentage', 'studentLists'));
        // $html = \view('backend.student.shows', compact('student','final','total','subjects','newArray','percentage'));
        // $html = $html->render();
        // $mpdf= new \Mpdf\Mpdf();
        // $mpdf->WriteHTML($html);
        // $fileName = 'Marksheet.pdf';
        // $mpdf->Output($fileName,'I');
        // return view('backend.student.shows')->with(['student'=>$student,'final'=>$final,'total'=>$total,'subjects'=>$subjects,'newArray'=>$newArray,'percentage'=>$percentage]);

    }




    public function update(Request $request, Student $student)
    {
        $this->authorize('create', Student::class);
        $this->authorize('show', $student);
        $data = $request->validate([

            'symbol_no' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'dob' => 'required'
        ]);
        $data['symbol_no'] = strtoupper($request->symbol_no);
        $data['name'] = strtoupper($request->name);
        $data['father_name'] = strtoupper($request->father_name);



        $result = Student::where(['id' => $student->id, 'class_id' => $student->class_id, 'batch_id' => $student->batch->id])->update($data);
        if ($result) {
            return redirect()->back()->with('success_message', 'Student Updated!');
        }
    }


    public function destroy(Student $student)
    {
        $this->authorize('create', Student::class);
        $this->authorize('show', $student);
        $results = Result::all();
        foreach ($results as $result) {
            foreach ($results as $r) {
                foreach ($r->studentresults as $sym) {
                    $symbol = $sym['SymbolNo'];
                    if ($symbol == $sym['SymbolNo']) {

                        DB::table('results')->whereJsonContains('studentresults', ['SymbolNo'  => $student->symbol_no])
                            ->delete();
                    }
                }
            }
        }




        $result = Student::where(['id' => $student->id, 'class_id' => $student->class_id, 'batch_id' => $student->batch->id])->delete();
        if ($result) {
            return redirect()->back()->with('success_message', 'Student Deleted!');
        }
    }
}
