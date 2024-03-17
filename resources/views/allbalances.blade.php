@extends('layouts.master')
@section('css')
<title>All Balances</title>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        All Balances
        <small>Amount is in AZN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Balances</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><span style="text-transform:capitalize;">
                Balances -
                  <small><a href="/unpaidbalances">Unpaid Balances</a> </small>
              </h3>
              @include('layouts.alerts')
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>Name</th>
                  <th>Unpaid Balance</th>
                </tr>
                <tr>
                  @foreach($user as $user)
                    <tr>
                      <td>
                        {{$user->name}} {{$user->surname}}
                      </td>
                      @php($total = 0)
                      @foreach($bal = App\Balance::where('user_id',$user->id)->where('status',0)->get() as $bal)
                      @php($total += $bal->amount)
                      @endforeach
                      <td>
                      @if($total > 0)
                      <span style="color:red;">{{number_format($total,2)}}</span>
                      @elseif($total < 0)
                      <span style="color:blue;">{{number_format($total,2)}}</span>
                      @else
                      <span>{{$total}}</span>
                      @endif
                      </td>
                    </tr>
                  @endforeach
                  </tr>
                  <tr>
                    <th>
                      <strong>
                        <a href="/usersbalance">Refresh it</a>
                      </strong>
                    </th>
                  </tr>
              </table>
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
@endsection
