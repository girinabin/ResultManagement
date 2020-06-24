@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div>
                    <strong>Student Name</strong>:{{ $student['name'] }}<br>
                    <strong>Symbol No</strong>:{{ $student['symbol_no'] }}<br>
                    <strong>Father Name</strong>:{{ $student['father_name'] }}<br>
                    <strong>Class</strong>:{{ $student->sclass->name }}
                </div>
               

                <table class="table">
                    <thead>
                        <tr>

                            <th>Subject</th>
                            <th>FM</th>
                            <th>PM</th>
                            <th>Obtain Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($c as $key=> $item)
                        <tr>

                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['FM'] }}</td>
                            <td>{{ $item['PM'] }}</td>
                            <th>{{ $key }}</th>

                        </tr>
                        @endforeach --}}
                        
                        @forelse ($newArray as $key=> $array)
                        <tr>
                            <td>{{ strtoUpper($array[1]['name']) }}</td>
                            <td>{{ $array[1]['FM'] }}</td>
                            <td>{{ $array[1]['PM'] }}</td>
                            <td>{{ $array[0] }}</td>
                        </tr>
                        @empty
                            
                        @endforelse

                    </tbody>
                </table>



                


            </div>

        </div>
    </div>
</div>



@endsection