@extends('layouts.master')
@section('css')
<title>{{__('app.My_balance')}}</title>
<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{__('app.My_balance')}}
        <small>Amount is in AZN</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.My_balance')}}</a></li>
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
                  <th>{{__('app.Product_name')}}</th>
                  <th>{{__('app.Date')}}</th>
                  <th>{{__('app.Earned_money')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($paidbal as $pbl)
                    <tr>
                      <td class="red">{{__('app.Paid')}}</td>
                      <td>{{$pbl->pay_date->format('d M, y')}}</td>
                      <td style="color: red;">-{{$pbl->amount}}AZN</td>
                    </tr>
                  @endforeach
                  @foreach($balance as $bal)
                    <tr>
                      @if($bal->prod_id == 1)
                      @else
                      @foreach($prod = App\Products::where('id',$bal->prod_id)->get() as $prod)
                        <td>{{$prod->product_name}}</td>
                      @endforeach
                      @endif
                      @if($bal->prod_id == 0 && $bal->amount < 50)
                      <td><span style="color:blue;">BONUS</span></td>
                      @elseif($bal->prod_id == 0 && $bal->amount >= 50)
                      <td><span style="color:blue;">{{__('app.Salary')}}</span></td>
                      @elseif($bal->prod_id == 1)
                      <td><span style="color:blue;">{{__('app.For_shipping')}}</span></td>
                      @endif
                      <td>{{$bal->created_at->format('d M, y')}}</td>
                      <td style="color: blue;">+{{$bal->amount}}AZN</td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>{{__('app.Product_name')}}</th>
                  <th>{{__('app.Date')}}</th>
                  <th>{{__('app.Earned_money')}}</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <table class="table table-hover">
                  <tr>
                    <th>
                      <h4><strong>{{__('app.Total_left_balance')}}</strong>: {{number_format($sum,2)}}AZN</h4>
                      <h4 style="color: red;"><strong>{{__('app.Total_taken')}}</strong>: {{number_format($sum_paid,2)}}AZN<h4>
                      @if(1==3)
                      <p><strong><a href="/oldbalance">{{__('app.Go_to_see_old_balance')}}</a></strong></p>
                      @endif
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
    $('#example1').DataTable({
        "order": [[ 1, "asc" ]], //or asc
        "columnDefs" : [{"targets":1, "type":"date-eu"}],
    });
  </script>
@endsection
