@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">
                {{-- <button type="button" class="btn btn-default backlink float-right"> <i class="fa fa-backward" > </i> Back</button> --}}

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