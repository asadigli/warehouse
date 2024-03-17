@extends('layouts.master')
@section('css')
<title>Add Balance</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{__('app.Add_balance')}}
        <small>add new balance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.Add_balance')}}</a></li>
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
                  <th>{{__('app.ID')}}</th>
                  <th>{{__('app.Name')}}</th>
                  <th>{{__('app.Income')}}</th>
                  <th>{{__('app.Action')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($prod = App\Products::orderBy('created_at','desc')->get() as $prod)
                  <tr class="even gradeC">
                    <td>{{$prod->product_id}}</td>
                    <td>{{$prod->product_name}}</td>
                    <td class="center">{{$prod->price}} - {{$prod->first_price}} = <b style="color:red">{{($prod->price) - ($prod->first_price)}}</b> </td>
                    <td>
                      <a class="btn" data-toggle="modal" data-target="#sell{{$prod->id}}" style="background-color:#ff3300;color:white;" href="" name="button">{{__('app.Sold')}}</a><br><br>
                    </td>
                  </tr>
                  <div class="modal fade" id="sell{{$prod->id}}" role="dialog" style="display:none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">{{__('app.Sell')}}</h4>
                        </div>
                        <form class="form-horizontal row-fluid" action="/addbalance" method="POST">
                          {{ csrf_field() }}
                        <div class="modal-body">
                          <p>{{__('app.Seller')}}?</p>
                          <br>
                            <div class="form-group">
                              <select class="form-control" name="user_id">
                              @foreach($users = App\User::all() as $user)
                              <option value="{{$user->id}}" style="text-transform:capitalize;">{{$user->name}} {{$user->surname}}</option>
                              @endforeach
                            </select>
                            </div>
                            <div class="form-group">
                              @php($earn = 0)
                              @php($earn = ((int)$prod->price - (int)$prod->first_price))
                              <input type="tex" class="form-control" name="amount" value="{{$earn}}" placeholder="Amount here...">
                            </div>
                            <input type="hidden" name="prod_id" value="{{$prod->id}}">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('app.Close')}}</button>
                          <button type="submit" name="submit" class="btn btn-primary">{{__('app.Sold')}}</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>{{__('app.ID')}}</th>
                  <th>{{__('app.Name')}}</th>
                  <th>{{__('app.Income')}}</th>
                  <th>{{__('app.Action')}}</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <div class="pull-right">
                @if(Auth::user()->role_id == 3)
                  <a href="/allbalances">{{__('app.See_all_balances')}}</a> | <a href="/addbonusbalance">{{__('app.Add_bonus_balance')}}</a>
                @endif
              </div>
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
