@extends('layouts.master')
@section('css')
<title>Statistics</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
<style media="screen">
  a{cursor: pointer;color: gray;}
  a.active{
    color: #14bfb1;
   font-weight: bold;
  }
  h3 img{
    height: 20px;
  }
</style>
@endsection
@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Statistika
      <small>Sade Store İdarə paneli</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i> Statistika</a></li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Sade Store saytı üzərində olan statistika</h3>
              </div>
              <div class="box-body" id="stat-page">
                <h3><a class="active">Ümumi</a> | <a>Məhsullar</a> | <a>Rəylər</a> <img src="/images/ldng.gif" alt=""></h3>
                <table class="table table-bordered table-striped"></table>
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
