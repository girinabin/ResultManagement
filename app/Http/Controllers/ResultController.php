<?php

namespace App\Http\Controllers;

use App\Result;
use App\SchoolClass;
use Illuminate\Http\Request;
use Importer;

class ResultController extends Controller
{
    public function importResult(Request $request,SchoolClass $class)
    {

        $request->validate([
            'resultfile'=>'required|max:5000|mimes:xls,xlsx,csv'
        ]);
            $results = $request->hasFile('resultfile');
            if($results)
            {
                $dateTime = date('Ymd_His');
                $file = $request->file('resultfile');
                $fileName = $dateTime .'-'.$file->getClientOriginalName();
                $savepath = public_path('/uploads/result/');
                $file->move($savepath,$fileName);
                $excel = Importer::make('Excel');
                $excel->load($savepath.$fileName);
                $collections = $excel->getCollection();
                $checkcollection = $excel->getCollection();

                $collectn = $collections->shift();
                $collections = $collections->all();
                
                if($checkcollection[0][0]=="SymbolNo")
                {
                    foreach($collections as  $collection){
                        foreach($collection as $index=>$coll){
                            $class->results()->create([
                                'studentresults'=>[
                                    
                                    $collectn[$index]=>$coll,
                                    'symbol_no'=>$collection[0]
                                  
                                ]
                            ]); 
                        }
                        
                           
                        
                        
                    }
                 return redirect()->back()->with('success_message','Imported Successfully!');

                }else{
                    return redirect()->back()->with('error_message','Excel file not Match with Sample given');
                }
                


            }
    }
}
