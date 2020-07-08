@extends('layouts.master')
@section('content')
<div class="content-wrapper">

    <div class="content">
        
        <div class="container-fluid">
            <div class="row">
                @if(Session::has('success_message'))
                <div class="alert alert-primary col-md-3 offset-9" role="alert">
                    {{ Session::get('success_message')}}
                </div>
                @endif
                <div class="col-md-8 offset-2">
                    <div class="card mt-1">
                        <div class="card-header">
                            <a href="{{ route('school.index') }}" class="float-right">
                                <button class="btn-sm badge-info"><strong>View School</strong></button>
                            </a>
                            <a href="{{ route('school.create') }}" class="float-left">
                                <button class=" btn-sm badge-info"><strong>Add School</strong></button>
                            </a>
                            <div class="card-text text-center">
                                <strong>{{ $school->school_name }}</strong>
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <strong>SCHOOL'S EMAIL : </strong>{{ $school->user->email }}
                            </div>
                            <div>
                                <strong>SCHOOL'S LOCATION : </strong>{{ $school->school_location }}
                            </div>
                            <div>
                                <strong>SCHOOL'S PRINCIPAL : </strong>{{ $school->principal }}
                            </div>
                            <div>
                                <strong>SCHOOL'S ROLE : </strong>{{ $school->user->roles()->first()->name }}
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('school.edit',$school->id) }}"><button class="btn-sm btn-warning">Edit</button></a>
                            <a href="{{ route('school.delete',$school->id) }}" class="float-right"><button class="btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this school({{ $school->school_name }})?')">Delete</button></a>

                        </div>
                    </div>
                </div>
               

            </div>
            
            


        </div>
    </div>
</div>

{{-- Edit Class Modal --}}
{{-- @forelse ($classes as $class)
<div class="modal fade bd-edit-modal-sm{{ $class->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><span class="badge badge-info">Edit Class {{ ucfirst($class->name) }}</span></div>
            <div class="container">
                <form action="{{ route('update.class',$class->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('classname') }}</div>
                        <label for="classname">Class Name</label>
                        <input class="form-control" type="text" name="classname" value="{{ $class->name }}">
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm mb-2">Update</button>
                </form>
            </div>

        </div>
    </div>
</div>
@empty

@endforelse --}}

{{-- Delete Class modal --}}
{{-- @forelse ($classes as $class)
<div class="modal fade bd-delete-modal-sm{{ $class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-info">Delete Class {{ ucfirst($class->name) }}</span>
                <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container">
                <form action="{{ route('delete.class',$class->id) }}" method="POST">
                    @csrf
                    <div>
                        <p>Are You Sure?</p>
                        <button type="submit" class="btn btn-danger btn-sm mb-2 mt-2 ">Delete</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@empty

@endforelse --}}

@endsection