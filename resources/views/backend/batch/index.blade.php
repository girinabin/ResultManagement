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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('add.batch',$class->id) }}">
                                <button class="btn btn-sm badge-info"><strong>Add Batch</strong></button>
                            </a>
                            <a href="{{ route('index.class',Auth::user()->id) }}">
                                <button class="btn btn-sm badge-info float-right"><strong>View Class</strong></button>
                            </a>
                            <p class="card-text text-center"><strong>CLASS <span
                                        class="badge-info">{{ $class->name }}</span> BATCH LIST</strong></p>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($batches as $key => $sclass)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-text text-center ">
                                                Batch {{ ucfirst($sclass->batch) }}

                                                <button type="button" class="btn  btn-sm float-left" data-toggle="modal"
                                                    data-target=".bd-edit-modal-sm{{ $sclass->id }}"><i
                                                        class="fas fa-edit" title="EDIT"></i></button>

                                                <button title="DELETE" type="button" class="btn  btn-sm float-right"
                                                    data-toggle="modal"
                                                    data-target=".bd-delete-modal-sm{{ $sclass->id }}"><i
                                                        class="fas fa-trash"></i></button>




                                            </p>


                                        </div>
                                        <div class="card-body text-center">

                                            <div>
                                                <div class="float-left">
                                                    <div class="mt-1">
                                                        <a href="{{ route('student.create',$sclass->id) }}"
                                                            class="btn btn-info btn-sm ">ADD
                                                            STUDENT</a>
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ route('student.index',$sclass->id) }}"
                                                            class="btn btn-secondary btn-sm ">VIEW
                                                            STUDENTS</a>
                                                    </div>
                                                </div>
                                                
                                               <div class="float-right">
                                                <div class="mt-1">
                                                    <form action="{{ route('import.student',$sclass->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <div class="text text-danger">{{ $errors->first('file') }}</div>
                                                            <input type="file" name="file" class="form-control"  style="width: 110px;padding:2px;padding-left:12px;">
                                                        </div>
                    
                                                        <button type="submit" class="btn btn-sm badge-info">Import Student</button>
                                                    </form>
                                                </div>
                                               </div>
                                                
                                             
                                               
                                                
                                            </div>





                                        </div>
                                    </div>
                                </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

            </div>




        </div>
    </div>
</div>

{{-- Edit Batch Modal --}}
@forelse ($batches as $sclass)
<div class="modal fade bd-edit-modal-sm{{ $sclass->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><span class="badge badge-info">Edit Batch {{ $sclass->name }}</span></div>
            <div class="container">
                <form action="{{ route('update.batch',$sclass->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('batch_name') }}</div>
                        <label for="classname">Batch Name</label>
                        <input class="form-control" type="text" name="batch_name" value="{{ $sclass->batch }}">
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm mb-2">Update</button>
                </form>
            </div>

        </div>
    </div>
</div>
@empty

@endforelse

{{-- Delete Batch modal --}}
@forelse ($batches as $sclass)
<div class="modal fade bd-delete-modal-sm{{ $sclass->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-info">Delete Batch {{ $sclass->batch }}</span>
                <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container">
                <form action="{{ route('delete.batch',$sclass->id) }}" method="POST">
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