@extends('layouts.master')
@section('content')

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-7 offset-3">
                    <div class="card">
                        <div class="card-header">

                            <p class="card-text text-center"><strong>Add {{ ucfirst($class->name) }} Subject </strong></p>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success_message'))
                            <div class="alert alert-primary" role="alert">
                                {{ Session::get('success_message')}}
                            </div>
                            @endif
                            <form action="{{ route('subject.store',$class->id) }}" method="POST">
                                @csrf
                                <table id="images1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                      @if($errors->any())
                                      <div class="text text-danger">{{ $errors->first('subject') }}</div>
                                      <br>
                                      <div class="text text-danger">{{ $errors->first('subject.*.name') }}</div>
                                      <br>
                                      <div class="text text-danger">{{ $errors->first('subject.*.FM') }}</div>
                                      <br>
                                      <div class="text text-danger">{{ $errors->first('subject.*.PM') }}</div>
                                      @endif



                                      <tr>
                                        <td class="text-left">Subject Name</td>
                                        <td class="text-left">FM</td>
                                        <td class="text-left">PM</td>

                                        {{-- <td class="text-left">Course Code</td> --}}
                                        <td></td>
                                      </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="2"></td>
                                        <td></td>
                                        <td class="text-left"><button type="button" onclick="addImage('1');" data-toggle="tooltip" title="Add Subject" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                                      </tr>
                                    </tfoot>
                                  </table>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <script type="text/javascript"><!--
        var image_row =0;

        function addImage(language_id) {
            html  = '<tr id="image-row' + image_row + '">';
            html += '  <td class="text-left"><input type="text" name="subject[' + image_row + '][name]" value="" placeholder="Subject Name" class="form-control" required /></td>';
            html += '  <td class="text-left"><input type="text" name="subject[' + image_row + '][FM]" value="" placeholder="Full Marks" class="form-control" required /></td>';
            html += '  <td class="text-left"><input type="text" name="subject[' + image_row + '][PM]" value="" placeholder="Pass Marks" class="form-control" required  /></td>';


            // html += '  <td class="text-left" style="width: 30%;"><input type="text" name="subject[' + image_row + '][code]" value="" placeholder="Course Code" class="form-control" /></td>';
            html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + ', .tooltip\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            $('#images' + language_id + ' tbody').append(html);

            image_row++;
        }
        //--></script>
          <script type="text/javascript"><!--
        $('.language a:first').tab('show');
        //--></script>
</div>
@endsection

