@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">

                            <p class="card-text text-center"><strong>Edit {{ $subject->class->name }} Subject Details</strong></p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                            @endif
                            <form action="{{ route('subject.update',$subject->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('name') }}</div>
                                    <label for="school_name">Subject Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $subject->name }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('FM') }}</div>
                                    <label for="school_name">Full Marks</label>
                                    <input type="text" name="FM" id="FM" class="form-control" value="{{ $subject->FM }}">
                                </div>
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('PM') }}</div>
                                    <label for="school_name">Pass Marks</label>
                                    <input type="text" name="PM" id="PM" class="form-control" value="{{ $subject->PM }}">
                                </div>
                                

                                <button class="btn btn-warning ">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
