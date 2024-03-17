@extends('layouts.master')
@section('css')
@if(Request::is('pay-balance'))
<title>{{__('app.Pay_balance')}}</title>
@else
<title>{{__('app.Add_balance')}}</title>
@endif
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        @if(Request::is('pay-balance'))
        {{__('app.Pay_balance')}}
        <small> {{__('app.Employee_earning')}}</small>
        @else
        {{__('app.Add_balance')}}
        <small> rewarding section</small>
        @endif
      </h1>
      <ol class="breadcrumb">
        @if(Request::is('pay-balance'))
        @else
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">Add Bonus Balance</a></li>
        @endif
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">
                  @if(Request::is('pay-balance'))
                  {{__('app.Pay_balance')}}
                  @else
                  {{__('app.Add_bonus_balance')}} -
                  <small><a href="/booking">{{__('app.Not_taken')}}</a>  | <a href="/addbooking">Add booking</a></small>
                  @endif
                </h3>
                <br>
                @include('layouts.alerts')
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      @if(Request::is('pay-balance'))
                       <form class="form-horizontal row-fluid" action="/pay-balance-now" method="POST">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <label class="col-xs-2 control-label">{{__('app.Employee')}}</label>
                              <div class="col-xs-10">
                                <select class="form-control" name="user_id">
                                  @foreach($users = App\User::all() as $user)
                                  <option value="{{$user->id}}" style="text-transform:capitalize;">{{$user->name}} {{$user->surname}}</option>
                                  @endforeach
                                </select> 
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-2 control-label">{{__('app.Amount')}}</label>
                              <div class="col-xs-10">
                                 <input class="form-control" type="text" name="amount"  placeholder="{{__('app.Amount')}}..." required>
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="col-xs-2 control-label">{{__('app.Date')}}</label>
                              <div class="col-xs-10">
                                <input class="form-control" type="date" name="date" required @if(Request::is('edit-payment/*')) value="{{ $sp->date->format('Y-m-d') }}" @else value="{{ date('Y-m-d') }}" @endif>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-2 control-label"></label>
                              <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-primary pull-right">{{__('app.Paid')}}</button>
                              </div>
                            </div>
                      </form>
                      @else
                        <form class="form-horizontal row-fluid" action="/addbalance" method="POST">
                          {{ csrf_field() }}
                            <div class="form-group">
                              <label class="col-xs-2 control-label">Seller</label>
                              <div class="col-xs-10">
                                <select class="form-control" name="user_id">
                                  @foreach($users = App\User::all() as $user)
                                  <option value="{{$user->id}}" style="text-transform:capitalize;">{{$user->name}} {{$user->surname}}</option>
                                  @endforeach
                                </select> 
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-2 control-label">Amount</label>
                              <div class="col-xs-10">
                                 <input class="form-control" type="text" name="amount"  placeholder="Amount...">
                              </div>
                            </div> 
                            <div class="form-group">
                              <label class="col-xs-2 control-label">Reason</label>
                              <div class="col-xs-10">
                                <select class="form-control" name="prod_id">
                                  <option value="0">{{__('app.No_reason')}}</option>
                                  <option value="1">{{__('app.For_shipping')}}</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-xs-2 control-label"></label>
                              <div class="col-xs-10">
                                <button type="submit" name="submit" class="btn btn-primary pull-right">{{__('app.Add_bonus_balance')}}</button>
                              </div>
                            </div>
                      </form>
                      @endif
                    </div>
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
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
@endsection
