@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                Name:{{ $student->name }}
                Class:{{ $student->sclass->name }}
                Result:
                @foreach ($final as $key=>$value)
                   {{ $key }}:{{ $value }} 
                   <br>
                   
                @endforeach
                Total:{{ $total }}

                
                   
               
                 
              
            </div>
            <div class="row">
                @foreach ($subjects as $subject)
                   {{ $subject->name }}
                @endforeach
            </div>
        </div>
    </div>
</div>



@endsection