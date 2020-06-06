@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
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

                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                  Action
                                                </button>
                                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                                  
                                                  <form action="{{ route('school.edit',$school->id) }}">
                                                    @csrf
                                                    <button type="submit" class="mt-2  mb-2  dropdown-item"
                                                        title="Edit"><i class="fas fa-edit btn-success btn-sm">&nbsp;Edit</i></button>
                                                  </form>
                                                  <form action="{{ route('school.show',$school->id) }}">
                                                    @csrf
                                                    <button type="submit" class="mt-2  mb-2  dropdown-item"
                                                        title="Delete"><i class="fas fa-eye  btn-warning btn-sm">&nbsp;View</i></button>
                                                </form>
                                                  <form action="{{ route('school.destroy',$school->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="mt-2  mb-2  dropdown-item"
                                                        title="Delete"><i class="fas fa-trash  btn-danger btn-sm">&nbsp;Delete</i></button>
                                                </form>
                                                 
                                                </div>
                                              </div>
                                            



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