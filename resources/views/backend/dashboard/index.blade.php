@extends('layouts.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
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
            
        @endforelse

        
        
      </div>

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection