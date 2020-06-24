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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-text text-center"><strong>{{ ucfirst($school->school_name) }}</strong></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-stripped">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>School Location</th>
                                        <th>School Principal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ ucfirst($school->school_name) }}</td>
                                        <td>{{ ucfirst($school->school_location) }}</td>
                                        <td>{{ ucfirst($school->principal )}}</td>



                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-text text-center"><strong>Add Classes</strong></p>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('school.class',$school->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('name') }}</div>
                                    <label for="name">Class Name</label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Add Class</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">
                @forelse($classes as $key => $class)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-text ">
                                {{ ucfirst($class->name) }}

                                <button type="button" class="btn  btn-sm" data-toggle="modal"
                                    data-target=".bd-edit-modal-sm{{ $class->id }}"><i class="fas fa-edit"></i></button>

                                <button type="button" class="btn  btn-sm float-right" data-toggle="modal"
                                    data-target=".bd-delete-modal-sm{{ $class->id }}"><i
                                        class="fas fa-trash"></i></button>




                            </p>


                        </div>
                        <div class="card-body text-center">

                            <a href="{{ route('subject.index',$class->id) }}" class="btn btn-primary btn-sm ">View
                                Subject</a>
                            <a href="{{ route('student.index',$class->id) }}" class="btn btn-primary btn-sm ">View
                                Students</a>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>


        </div>
    </div>
</div>

{{-- Edit Class Modal --}}
@forelse ($classes as $class)
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

@endforelse

{{-- Delete Class modal --}}
@forelse ($classes as $class)
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

@endforelse

@endsection