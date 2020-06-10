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
                            
                            <a href="{{ route('school.create') }}">
                                <button class="btn btn-sm badge-info"><strong>Add School</strong></button>
                            </a>
                            

                            <p class="card-text text-center"><strong>School List</strong></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-stripped" id="table_id">
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
                                                <button data-toggle="modal" data-target=".bd-delete-modal-sm{{$school->id  }}" type="button" class="mt-2  mb-2  dropdown-item"
                                                    title="Delete"><i
                                                        class="fas fa-trash  btn-danger btn-sm">&nbsp;Delete</i></button>
                                                 
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
{{-- Delete School Modal --}}
@forelse ($schools as $school)
<div class="modal fade bd-delete-modal-sm{{ $school->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge badge-info">{{ ucfirst($school->school_name) }}</span>
                <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="container">
                <form action="{{ route('school.destroy',$school->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
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