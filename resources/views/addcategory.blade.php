@extends('layouts.master')
@section('css')
<title>Add Category</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Categories
        <small>list of categories</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/addcategory">Categories</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            @include('layouts.alerts')
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>About</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($cats = App\Category::orderBy('created_at','desc')->get() as $cat)
                  <tr class="odd gradeX">
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->cat_name}}</td>
                    <td>{{$cat->about}}</td>
                    <td>
                      <a class="btn btn-danger" data-toggle="modal" data-target="#delete{{$cat->id}}"> Delete</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="delete{{$cat->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Delete</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to delete <b>{{$cat->cat_name}}</b>?</p>
                        </div>
                        <div class="modal-footer">
                          <a href="/deletecategory/{{$cat->id}}"  class="btn btn-danger">Yes</a>
                          <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>About</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add">Add Category</a>
              <br>
                <div class="modal fade" id="add" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Category</h4>
                      </div>
                      <form class="form-horizontal row-fluid" action="addcat" method="POST">
                        <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="control-group">
                          <label class="control-label" for="basicinput">Category Name</label>
                          <div class="controls">
                            <input class="form-control" type="text" name="cat_name" id="basicinput" placeholder="Type something here...">
                          </div>
                        </div>
                        <div class="control-group">
                        	<label class="control-label" for="basicinput">About</label>
                        	<div class="controls">
                        			<textarea class="form-control" name="about" rows="5" placeholder="Type information about category..."></textarea>
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
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
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
