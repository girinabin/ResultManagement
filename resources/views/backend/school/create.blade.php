@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-text text-center"><strong>Add School Details</strong></p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success_message')}}
                              </div>  
                            @endif
                            <form action="{{ route('school.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('school_name') }}</div>
                                    <label for="school_name">School Name</label>
                                    <input type="text" name="school_name" id="school_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('school_location') }}</div>
                                    <label for="school_location">School Location</label>
                                    <input type="text" name="school_location" id="school_location" class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('principal') }}</div>
                                    <label for="principal">School Principal</label>
                                    <input type="text" name="principal" id="principal" class="form-control">
                                </div>
                                <button class="btn btn-primary ">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <p class="card-text text-center"><strong>School List</strong></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-stripped">
                                <thead>
                                    <tr>
                                        <th>School Name</th>
                                        <th>Address</th>
                                        <th>Principal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schools as $key => $school)
                                    <tr>
                                        <td>{{ $school->school_name }}</td>
                                        <td>{{ $school->school_location }}</td>
                                        <td>{{ $school->principal }}</td>
                                        <td>
                                            <form action="{{ route('school.edit',$school->id) }}">
                                                <button type="submit" class="mt-2  mb-2 btn btn-success btn-sm" title="Edit"><i class="fas fa-edit"></i></button>
                                            </form>
                                            
                                            <form action="">
                                                <button  type="submit" class="mt-2  mb-2 btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                            {{-- <a href="{{ route('school.edit',$school->id) }}" title="edit"></a>
                                            
                                            <a href="{{ route('school.destroy',$school->id) }}" title="Delete"><i class="fas fa-trash"></i></a> --}}
                                            
                                           
                                            
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection