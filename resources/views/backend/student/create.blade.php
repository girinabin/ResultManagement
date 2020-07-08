@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">

                            <p class="card-text text-center"><strong>ADD STUDENT DETAILS</strong></p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                            @endif
                            <form action="{{ route('add.student',$batch->id) }}" method="POST">
                                @csrf
                                
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

        </div>
    </div>
</div>
@endsection