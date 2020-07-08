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
                            <a href="{{ route('create.class') }}">
                                <button class="btn btn-sm badge-info"><strong>Add Class</strong></button>
                            </a>
                            <p class="card-text text-center"><strong>CLASS LIST</strong></p>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($sclasses as $key => $sclass)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <p class="card-text text-center ">
                                                {{ ucfirst($sclass->name) }}
                
                                                <button type="button" class="btn  btn-sm float-left" data-toggle="modal"
                                                    data-target=".bd-edit-modal-sm{{ $sclass->id }}"><i class="fas fa-edit"></i></button>
                
                                                <button type="button" class="btn  btn-sm float-right" data-toggle="modal"
                                                    data-target=".bd-delete-modal-sm{{ $sclass->id }}"><i
                                                        class="fas fa-trash"></i></button>
                
                
                
                
                                            </p>
                
                
                                        </div>
                                        <div class="card-body text-center">
                
                                            <div>
                                                <div class="float-left" >
                                                    <div class="mt-1">
                                                        <a href="{{ route('subject.create',$sclass->id) }}" class="btn btn-info btn-sm ">ADD
                                                            SUBJECT</a>
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ route('subject.index',$sclass->id) }}" class="btn btn-secondary btn-sm ">VIEW
                                                            SUBJECT</a>
                                                    </div>
                                                </div>
                                                <div class="float-right">
                                                    <div class="mt-1">
                                                        <a href="{{ route('add.batch',$sclass->id) }}" class="btn btn-info btn-sm ">ADD
                                                            BATCH</a>
                                                    </div>
                                                    <div class="mt-1">
                                                        <a href="{{ route('index.batch',$sclass->id) }}" class="btn btn-secondary btn-sm ">VIEW
                                                            BATCH</a>
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

{{-- Edit Class Modal --}}
@forelse ($sclasses as $sclass)
<div class="modal fade bd-edit-modal-sm{{ $sclass->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header"><span class="badge badge-info">Edit Class {{ $sclass->name }}</span></div>
            <div class="container">
                <form action="{{ route('update.class',$sclass->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="text text-danger">{{ $errors->first('classname') }}</div>
                        <label for="classname">Class Name</label>
                        <input class="form-control" type="text" name="classname" value="{{ $sclass->name }}">
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
@forelse ($sclasses as $sclass)
<div class="modal fade bd-delete-modal-sm{{ $sclass->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-info">Delete Class {{ $sclass->name }}</span>
                <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container">
                <form action="{{ route('delete.class',$sclass->id) }}" method="POST">
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