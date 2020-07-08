@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        @if(Auth::user()->roles()->first()->name=='SUPERADMIN')
        @forelse ($schools  as $school)
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h4>{{ ucfirst($school->principal) }}</h4>
              <h5>{{ ucfirst($school->school_location) }}</h5>

              <h4 class="mt-5">{{ ucfirst($school->school_name) }}</h4>
            </div>
            <div class="icon">
              <i class="fas fa-school"></i>
            </div>
            <a href="{{ route('school.show',$school->id) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        @empty
        <div class="card mt-1 ">
          <div class="card-body">
            <a href="{{ route('school.create') }}"><button class="btn btn-primary">Add School</button></a>
          </div>
          </div>   
        @endforelse
        @endif
        @if(Auth::user()->roles()->first()->name=='ADMIN')
        @forelse ($classes as $class)
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <strong>{{ $class->name }}</strong>
              <div>
                <a href="{{ route('subject.index',$class->id) }}"><button class=" btn-sm btn-success">View Subject</button></a>

              </div>
              <div class="mt-1">
                <a href="{{ route('index.batch',$class->id) }}"><button class=" btn-sm btn-success">View Batch</button></a>

              </div>


              <h4 class="mt-5"></h4>
            </div>
            <div class="icon">
              <i class="fab fa-buromobelexperte"></i>
            </div>
            <a href="{{ route('index.class',Auth::user()->id) }}" class="small-box-footer"><strong>MORE INFO</strong> <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>  
        @empty
        
           <div class="card mt-1 ">
             <div class="card-body">
               <a href="{{ route('create.class') }}"><button class="btn btn-primary">Add Class</button></a>
             </div>
             </div> 
        @endforelse
        
        @endif
       

        
        
      </div>

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection