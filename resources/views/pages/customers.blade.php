@extends('layouts.master')
@section('css')
<title>{{__('app.Loyal_customers')}}</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<style media="screen">
td.currency:before
{
content: "₼ ";
}
</style>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        {{__('app.Customers')}}
        <small>{{__('app.Loyal_customers')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i>{{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.Loyal_customers')}}</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{__('app.Customers')}}
                <!-- <small><a href="/takenbooking">Götürülənlər</a>  | <a href="/addbooking">Sifariş əlavə et</a></small> -->
              </h3>
              <br>
              @include('layouts.alerts')
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('app.Buyer')}}</th>
                  <th>{{__('app.Phone_number')}}</th>
                  <th>{{__('app.Sale_times')}}</th>
                  <th>{{__('app.Sum_sale')}}</th>
                  <th>#</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($sps as $sp)
                    <tr>
                      <td>@php($sp_b = App\Soldpro::where('contact_number',$sp->contact_number)->distinct()->get(['buyer']))
                        @foreach($sp_b as $key => $spb)
                        @if($key != count($sp_b)-1)
                        {{$spb->buyer}}, <br>
                        @else {{$spb->buyer}}
                        @endif
                      @endforeach</td>
                      <td>{{$sp->contact_number}}</td>
                      <td>
                        {{$sls_count = App\Soldpro::where('verified',1)->where('contact_number', $sp->contact_number)->count()}} dəfə alış
                      </td>
                      <td class="currency">
                        @php($tot_sum = 0)
                        @foreach($sls = App\Soldpro::where('verified',1)->where('contact_number', $sp->contact_number)->get() as $sl)
                        @php($tot_sum += $sl->quantity* $sl->sold_price)
                        @endforeach
                        {{$tot_sum}}
                      </td>
                      <td>
                      <div class="btn-group">
                        <button data-toggle="modal" data-target="#more{{str_replace('+','',$sp->contact_number)}}" type="button" class="btn btn-primary" title="Ətraflı bax"><b class="fa fa-eye"></b></button>
                      </div>
                      </td>
                    </tr>
                    <div class="modal fade" id="more{{str_replace('+','',$sp->contact_number)}}" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{__('app.More_details')}}</h4>
                                </div>
                                  <div class="modal-body">
                                      <ul class="list-group">
                                        <li class="list-group-item"><b>Alıcı:</b> @php($sp_b = App\Soldpro::where('contact_number',$sp->contact_number)->distinct()->get(['buyer']))
                                          @foreach($sp_b as $key => $spb)
                                          @if($key != count($sp_b)-1)
                                          {{$spb->buyer}}, <br>
                                          @else {{$spb->buyer}}
                                          @endif
                                        @endforeach</li>
                                        <li class="list-group-item"><b>Məhsullar: </b>@php($sp_b = App\Soldpro::where('contact_number',$sp->contact_number)->distinct()->get()) <br>
                                          @foreach($sp_b as $key => $spb)
                                          {{ $loop->first ? '':','}}
                                          @php($pro = App\Products::where('product_id',$spb->product_id)->first())
                                          <u title="{{$pro->product_name}}">{{$spb->product_id}}</u>
                                          @endforeach
                                        </li>
                                        <li class="list-group-item"><b>Alış: </b>{{$sls_count = App\Soldpro::where('verified',1)->where('contact_number', $sp->contact_number)->count()}} dəfə alış</li>
                                        <li class="list-group-item"><b>Cəmi məhsul: </b>
                                          @php($slss = App\Soldpro::where('verified',1)->where('contact_number', $sp->contact_number)->get())
                                          @php($sum = 0)
                                          @foreach($slss as $sls)
                                          @php($sum += $sls->quantity)
                                          @endforeach
                                          {{$sum}} dəfə alış
                                        </li>
                                        <li class="list-group-item"><b>Rəylər: </b>
                                          @php($slss2 = App\Soldpro::where('verified',1)->where('contact_number', $sp->contact_number)->where('comment','!=','')->get())
                                          @foreach($slss2 as $sls)
                                           {!! $sls->comment !!} <hr>
                                          @endforeach
                                          @empty($sls)
                                          Rəy yoxdur
                                          @endempty
                                          @foreach($cmts = App\Cmt::where('cust_phone',$sp->contact_number)->get() as $cmt)
                                          <p>{{$cmt->comment}}: <i>{{$cmt->date->format('d M, Y')}}</i> </p>
                                          @endforeach
                                        </li>
                                      </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('app.Close')}}</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>{{__('app.Buyer')}}</th>
                  <th>{{__('app.Phone_number')}}</th>
                  <th>{{__('app.Sale_times')}}</th>
                  <th>{{__('app.Sum_sale')}}</th>
                  <th>#</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/js/tinymce.js"></script>
  <script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="/plugins/fastclick/fastclick.js"></script>
  <script src="/dist/js/app.min.js"></script>
  <script src="/dist/js/demo.js"></script>
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
