@extends('layouts.master')
@section('css')
<title>Əsas səhifə </title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<style>
.tooltiptext {
   visibility: hidden;
   width: 120px;
   background-color: #32b0fd;
   color: #fff;
   text-align: center;
   border-radius: 6px;
   padding: 5px 0;
   position: absolute;
   z-index: 1;
   top:110px;
   left: 0%;
}
.tooltip64:hover .tooltiptext {visibility: visible;}
.col-lg-3{min-height: 148px;}
#stat_section .box-header a{
  color: black;
  cursor: pointer;
}
#stat_section .box-header a.active{
  color: #19bfb1;
  font-weight: bold;
}
</style>
@endsection
@section('body')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Əsas səhifə
      <small>Sade Store İdarə paneli</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i> Əsas səhifə</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>
              {{$prodd = App\Products::all()->count()}}
            </h3>
            <p>Məhsul Çeşidi</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green tooltip64">
          <div class="inner">
            <h3>
              @php($total = 0)
              @foreach($prodd = App\Products::where('quantity','!=', 0)->get() as $prodd)
                @php($total += ($prodd->price)*($prodd->quantity))
              @endforeach
              @if($total < 1000)
                1k AZN <i class="fa fa-arrow-down"></i>
              @else
                {{floor($total/1000)}}k AZN <i class="fa fa-arrow-up"></i>
              @endif
            </h3>
            <p>Ümumi</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          @if(Auth::user()->role_id == 3)
          <a href="#" class="small-box-footer">Ətraflı <i class="fa fa-arrow-circle-right"></i></a>
          <span class="tooltiptext">{{$total}}AZN</span>
          @endif
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{$sps = App\Soldpro::where('verified',1)->count()}}</h3>
            <p>Satış sayı</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-purple">
          <div class="inner">
            <h3>{{App\Soldpro::distinct()->get(['contact_number'])->count()}}</h3>
            <p>Daimi müştəri sayı</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-blue tooltip64">
          <div class="inner">
            <h3>
              @php($ttl = 0)
              @foreach($solpro = App\Soldpro::where('verified',1)->get() as $sp)
                @php($ttl += ($sp->sold_price)*($sp->quantity))
              @endforeach
              @if($ttl < 1000)
                1k AZN <i class="fa fa-arrow-down"></i>
              @else
                {{floor($ttl/1000)}}k AZN <i class="fa fa-arrow-up"></i>
              @endif
            </h3>
            <p>Cəmi satış həcmi</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          @if(Auth::user()->role_id == 3)
          <a href="#" class="small-box-footer">Ətraflı <i class="fa fa-arrow-circle-right"></i></a>
          <span class="tooltiptext">{{$ttl}}AZN</span>
          @endif
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{count($user)}}</h3>
            <p>İdarəçilər</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          @if(Auth::user()->role_id == 3)
          <a href="/users" class="small-box-footer">Ətraflı <i class="fa fa-arrow-circle-right"></i></a>
          @endif
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{count($cat)}}</h3>
            <p>Kateqoriyalar</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <section class="col-lg-7 connectedSortable">
        @include('layouts.stat')
        @include('layouts.chat')
        <!-- <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Cəmi satış</h3>
          </div>

        </div> -->
      </section>
      <section class="col-lg-5 connectedSortable">
        <div class="box box-solid bg-green-gradient">
          <div class="box-header">
            <i class="fa fa-calendar"></i>
            <h3 class="box-title">Təqvim</h3>
            <div class="pull-right box-tools">
            </div>
          </div>
          <div class="box-body no-padding">
            <div id="calendar" style="width: 100%"></div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Ən son əlavə edilən məhsullar</h3>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Əlavə olunma tarixi</th>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Qiymət</th>
                    <th>Kəmiyyət</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($prod as $prod)
                      <tr class="odd gradeX">
                          <td> {{ $prod->created_at->diffForHumans()}}</td>
                          <td>{{$prod->product_id}}</td>
                          <td>{{$prod->product_name}}</td>
                          <td class="center">{{$prod->price}}</td>
                          <td class="center">{{$prod->quantity}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Əlavə olunma tarixi</th>
                    <th>ID</th>
                    <th>Ad</th>
                    <th>Qiymət</th>
                    <th>Kəmiyyət</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </section>
</div>
@endsection
@section('js')
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script> $.widget.bridge('uibutton', $.ui.button); </script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!--<script src="plugins/morris/morris.min.js"></script>-->
<script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/plugins/knob/jquery.knob.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/plugins/fastclick/fastclick.js"></script>
<script src="/dist/js/app.min.js?v={{md5(uniqid())}}"></script>
<script src="/dist/js/pages/dashboard.js?v={{md5(uniqid())}}"></script>
@endsection
