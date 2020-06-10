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
                @if(Session::has('error_message'))
                <div class="alert alert-danger col-md-3 offset-9" role="alert">
                    {{ Session::get('error_message')}}
                </div>
                @endif

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-sm badge-info" data-toggle="modal"
                                data-target=".bd-student-modal-lg{{ $class->id }}">Add Student</button>
                                <div class="float-right " >
                                    <form action="{{ route('import.student',$class->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="text text-danger">{{ $errors->first('file') }}</div>
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-sm badge-info">Import Student</button>
                                    </form> 
                                    <a href="{{ asset('uploads/sample/students.xlsx') }}" class="float-right">Download Sample</a>
                                </div>
                               
                            <p class="card-text text-center"><strong>{{ ucfirst($class->name) }}'s Student List</strong>
                            </p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-stripped" id="table_id">
                                <thead>
                                    <tr>
                                        <th>Batch</th>
                                        <th>Symbol Number</th>
                                        <th>Student Name</th>
                                        <th>Father's Name</th>
                                        <th>DOB</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $student)
                                    <tr>
                                        <td>{{ $student->batch }}</td>
                                        <td>{{ $student->symbol_no }}</td>
                                        <td>{{ ucfirst($student->name) }}</td>
                                        <td>{{ ucfirst($student->father_name) }}</td>
                                        <td>{{ $student->dob }}</td>
                                        <td>

                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">


                                                    <button type="button" class="mt-2  mb-2  dropdown-item"
                                                        data-toggle="modal"
                                                        data-target=".bd-studentedit-modal-lg{{ $student->id }}"
                                                        title="Edit"><i
                                                            class="fas fa-edit btn-success btn-sm">&nbsp;Edit</i></button>

                                                    <form action="">
                                                        @csrf
                                                        <button type="submit" class="mt-2  mb-2  dropdown-item"
                                                            title="Delete"><i
                                                                class="fas fa-eye  btn-warning btn-sm">&nbsp;View</i></button>
                                                    </form>

                                                    
                                                        <button data-toggle="modal" data-target=".bd-delete-modal-sm{{$student->id  }}" type="button" class="mt-2  mb-2  dropdown-item"
                                                            title="Delete"><i
                                                                class="fas fa-trash  btn-danger btn-sm">&nbsp;Delete</i></button>
                                                               
                                                  

                                                </div>
                                            </div>




                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- STUDENT ADD MODAL --}}
<div class="modal fade bd-student-modal-lg{{ $class->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container mt-2 mb-2">
                <form action="{{ route('add.student',$class->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('batch') }}</div>
                        <label for="batch">Batch/Year</label>
                        <input type="text" name="batch" id="batch" class="form-control" value="{{ old('batch') }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('symbol_no') }}</div>
                        <label for="symbol_no">Symbol Number</label>
                        <input type="text" name="symbol_no" id="symbol_no" class="form-control"
                            value="{{ old('symbol_no') }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('name') }}</div>
                        <label for="name">Student Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('father_name') }}</div>
                        <label for="father_name">Father's Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control"
                            value="{{ old('father_name') }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('dob') }}</div>
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}">
                    </div>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Student Edit Modal --}}
@forelse ($students as $student)
<div class="modal fade bd-studentedit-modal-lg{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="container mt-2 mb-2">
                <form action="{{ route('update.student',$student->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('batch') }}</div>
                        <label for="batch">Batch/Year</label>
                        <input type="text" name="batch" id="batch" class="form-control" value="{{ $student->batch }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('symbol_no') }}</div>
                        <label for="symbol_no">Symbol Number</label>
                        <input type="text" name="symbol_no" id="symbol_no" class="form-control"
                            value="{{ $student->symbol_no }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('name') }}</div>
                        <label for="name">Student Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('father_name') }}</div>
                        <label for="father_name">Father's Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control"
                            value="{{ $student->father_name }}">
                    </div>
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('dob') }}</div>
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob }}">
                    </div>
                    <button type="submit" class="btn btn-warning ">Update</button>
                </form>
            </div>

        </div>
    </div>
</div>
@empty

@endforelse

{{-- Delete Student modal --}}
@forelse ($students as $student)
<div class="modal fade bd-delete-modal-sm{{ $student->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-info">Delete Student {{ ucfirst($student->name) }}</span>
                <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container">
                <form action="{{ route('delete.student',$student->id) }}" method="POST">
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