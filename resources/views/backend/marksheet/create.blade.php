@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <form action="">
                <div class="row">
                    <div class="col-md-12">
                        <school-component :items="{{ json_encode($schools) }}"></school-component>
                    </div>
                    
                    <batch-component></batch-component>
                    
                    
                   
                    
    
                </div>
                <div class="row">
                    <div class="col-md-6 offset-3 text-center">
                        <button type="submit" class="btn btn-primary ">submit</button>
                    </div>
                </div>
                
            </form>
            

        </div>
    </div>
    
       
</div>
@endsection