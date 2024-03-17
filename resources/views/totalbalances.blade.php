@extends('layouts.master')
@section('css')
<title>Total Balances</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        All Balances
        <small>Amount is in AZN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
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
                  <th>Unpaid Balance</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($user as $user)
                    <tr>
                      <td>
                        {{$user->name}} {{$user->surname}}
                      </td>
                      @php($total_bal = 0)
                      @foreach($bal = App\Balance::where('user_id',$user->id)->get() as $bal)
                      @php($total_bal += $bal->amount)
                      @endforeach
                      @php($total_pay = 0)
                      @foreach($bal = App\Payment::where('user_id',$user->id)->get() as $bal)
                      @php($total_pay += $bal->amount)
                      @endforeach
                      @php($total = $total_bal - $total_pay)
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
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Unpaid Balance</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <table class="table table-hover">
                <tr>
                  <th>
                    <strong>
                      <a href="/totalbalances">Refresh it</a>
                    </strong>
                    <b><a class="pull-right" href="/usersbalance"> Users' Balances</a> </b>
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
