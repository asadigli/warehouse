@extends('layouts.master')
@section('css')
<title>İnformasiya</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Information
        <small>information about products</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/information">Information</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Detail</th>
                @if(Auth::user()->role_id == 3)
                  <th>Actions</th>
                @endif
                </tr>
                </thead>
                <tbody>
                  @foreach($info as $inf)
                  <tr class="even gradeC">
                    <td>{{$inf->name}}</td>
                    <td>
                      {{$inf->details}}
                     </td>
                     @if(Auth::user()->role_id == 3)
                        <td>
                          <a data-toggle="modal" data-target="#delete{{$inf->id}}" class="btn btn-danger">Delete</a><br><br>
                        </td>
                      @endif
                  </tr>
                  <div class="modal fade" id="delete{{$inf->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Delete</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to delete <b><i>{{$inf->name}}</i> </b>?</p>
                        </div>
                        <div class="modal-footer">
                          <a href="/deleteinfo/{{$inf->id}}"  class="btn btn-danger">Yes</a>
                          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  

                  @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Detail</th>
                @if(Auth::user()->role_id == 3)
                  <th>Actions</th>
                @endif
                </tr>
                </tfoot>
              </table>
              <hr>
              <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add">Add Information</a>
              <div class="modal fade" id="add" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      @if(Auth::user()->role_id == 3)
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Add New Infomation</h4>
                      @endif
                    </div>
                    <form class="form-horizontal row-fluid" action="/adddetail" method="POST">
                      <div class="modal-body">
                      {{ csrf_field() }}
                      <div class="control-group">
                        <label class="control-label" for="basicinput">Title</label>
                        <div class="controls">
                          <input class="form-control" type="text" name="name" minlength="5" maxlength="100" placeholder="Type title here...">
                        </div>
                      </div>

                      <div class="control-group">
                      	<label class="control-label" for="basicinput">Details</label>
                      	<div class="controls">
                      			<textarea name="detail" rows="3" cols="5" minlength="10" maxlength="600" placeholder="Type more detailed information..."></textarea>
                      	</div>
                    </div>
                      <br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                      <input type="submit" name="submit" value="Add" class="btn btn-primary">
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              @include('layouts.alerts')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
@endsection
