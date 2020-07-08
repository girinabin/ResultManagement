@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 offset-3">
                    <div class="card">
                        <div class="card-header">

                            <p class="card-text text-center"><strong>ADD BATCH FOR CLASS <span class="badge badge-info">{{ $class->name }}</span></strong></p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                            @endif
                            <form action="{{ route('store.batch',$class->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="text text-danger">{{ $errors->first('batch_name') }}</div>
                                    <label for="school_name">BatchName</label>
                                    <input type="text" name="batch_name" id="name" class="form-control" value="{{ old('batch_name') }}">
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