<?php

namespace App\Http\Controllers;

use App\Batch;
use App\SchoolClass;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function addBatch(SchoolClass $class){
        $this->authorize('addBatch',Batch::class);
        $this->authorize('creates',$class);
        return view('backend.batch.create',compact('class'));
    }

    public function storeBatch(Request $request ,SchoolClass $class){
        $this->authorize('addBatch',Batch::class);
        $this->authorize('creates',$class);
        $postData = $request->validate([
            'batch_name'=>['required'],

        ]);
        
        $class->batches()->create([
            'batch'=>$postData['batch_name']
        ]);
        return redirect()->back()->with('success_message','Batch Added Successfully');
    }

    public function viewBatch(SchoolClass $class){
        $this->authorize('addBatch',Batch::class);
        $this->authorize('creates',$class);
       $batches = Batch::where(['class_id'=>$class->id])->orderBy('created_at','DESC')->get();
       return view('backend.batch.index',compact('batches','class')); 
    }

    public function updateBatch(Request $request,Batch $batch){
        $this->authorize('addBatch',Batch::class);
        $this->authorize('updateBatch',$batch);
        $postData = $request->validate([
            'batch_name'=>['required']
        ]);
        $batch = Batch::where(['id'=>$batch->id,'class_id'=>$batch->sclass->id])->update([
            'batch'=>$postData['batch_name']
        ]);
        if($batch){
            return redirect()->back()->with('success_message','Batch Updated!');
        }
    }

    public function deleteBatch(Batch $batch){
        $this->authorize('addBatch',Batch::class);
        $this->authorize('updateBatch',$batch);
        $batch = Batch::where(['id'=>$batch->id,'class_id'=>$batch->sclass->id])->delete();
        if($batch){
            return redirect()->back()->with('success_message','Batch Deleted!');
        }
        
    }
}
