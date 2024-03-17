@extends('layouts.master')
@section('css')
<title>Balances</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        @if(Request::is('usersbalance'))
        {{__('app.All_balances')}}
        @else
        {{trans('app.Someones_balance',['name' => $user->name])}}
        @endif
        <small>Amount is in AZN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="/usersbalance"><a href="#">Balances</a></li>
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
                  <th>Name</th>
                  <th>Product</th>
                  <th>Earned</th>
                  <th>Amount</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($bals as $bal)
                    <tr>
                      <td>
                        @foreach($users = App\User::where('id',$bal->user_id)->get() as $us)
                        <a href="/usersbalance/user={{$us->id}}">{{$us->name}} {{$us->surname}}</a>
                        @endforeach
                        @if($users = App\User::where('id',$bal->user_id)->count() == 0)
                        <b style="color:red;">Deleted</b>
                        @endif
                      </td>
                        <td>
                       @foreach($prod = App\Products::where('id',$bal->prod_id)->get() as $prod)
                          {{$prod->product_name}}
                       @endforeach
                       @if($prod = App\Products::where('id',$bal->prod_id)->count() == 0)
                       <b style="color:red;">Deleted Product</b>
                       @endif
                      </td>
                      <td>{{$bal->amount}}</td>
                      <TD>
                        @if($bal->status == 0)
                        <span style="color:red;">Unpaid</span>
                        @elseif($bal->status == 1)
                        <span style="color:green;">Paid</span>
                        @endif
                      </TD>
                      <td>
                        <div class="btn-group-vertical">
                          <a data-toggle="modal" data-target="#change{{$bal->id}}" class="btn btn-primary">Change</a> 
                          <a data-toggle="modal" data-target="#delete{{$bal->id}}" class="btn btn-danger">Delete</a>
                        </div>
                      </td>
                    </tr>

                    <div class="modal fade" style="display:none;" id="change{{$bal->id}}" role="dialog">
                      <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Sold</h4>
                      </div>
                      <form class="form-horizontal row-fluid" action="/changebalance/{{$bal->id}}" method="POST">
                        {{ csrf_field() }}
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Already paid?</label>
                          <select class="form-control" name="status" required>
                            <option value="0" @if($bal->status == 0) selected @endif>Unpaid</option>
                            <option value="1" @if($bal->status == 1) selected @endif>Paid</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Change Seller</label>
                          <select class="form-control" name="user_id" required>
                            @foreach($users = App\User::all() as $user)
                            <option value="{{$user->id}}" @if($bal->user_id == $user->id) selected @endif>{{$user->name}} {{$user->surname}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary">Change</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                    </div>

                  </div>
                </div>
                    <div class="modal fade" id="delete{{$bal->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure to delete this balance?</p>
                          </div>
                          <div class="modal-footer">
                            <a href="/deletebalance/{{$bal->id}}"  class="btn btn-danger">Yes</a>
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
                  <th>Product</th>
                  <th>Earned</th>
                  <th>Amount</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <table class="table table-hover">
                <tr>
                  <th>
                    <div class="btn-group pull-right">
                      @if(Request::is('usersbalance'))
                      <a href="/paid-amounts" class="btn btn-danger">Paid</a>
                      @elseif(Request::is('paid-amounts'))
                      <a href="/usersbalance" class="btn btn-danger">Unpaid</a>
                      @endif
                      <a onClick="window.location.reload()" class="btn btn-success">Refresh it</a>
                      <a class="btn btn-primary" href="/totalbalances"> Total Left Balances</a>
                    </div>
                  </th>
                </tr>
              </table>
              <br>
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
