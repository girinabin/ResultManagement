@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('school.index') }}">
                                <button class="btn btn-sm badge-info"><strong>View School</strong></button>
                            </a>

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
                                    <input type="text" name="school_name" id="school_name" class="form-control" value="{{ old('school_name') }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('school_location') }}</div>
                                    <label for="school_location">School Location</label>
                                    <input type="text" name="school_location" id="school_location" class="form-control" value="{{ old('school_location') }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('principal') }}</div>
                                    <label for="principal">School Principal</label>
                                    <input type="text" name="principal" id="principal" class="form-control" value="{{ old('principal') }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('school_email') }}</div>
                                    <label for="school_name">School Email</label>
                                    <input type="email" name="school_email" id="school_email" class="form-control" value="{{ old('school_email') }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('school_password') }}</div>
                                    <label for="school_name">School Password</label>
                                    <input type="password" name="school_password" id="school_password" class="form-control" value="{{ old('school_password') }}">
                                </div>
                                <button class="btn btn-primary ">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection