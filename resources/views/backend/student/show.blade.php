@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            
            <div class="row">
                Name:{{ $student->name }}
                Result:
                
                
                     @foreach ($resultss as $result)
                       @foreach($result as $key => $r)
                       {{ $key }}:{{ $result[$key] }}
                       @endforeach
                     @endforeach
               
                 
              
            </div>
        </div>
    </div>
</div>



@endsection