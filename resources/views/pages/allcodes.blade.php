@extends('layouts.master')
@section('css')
<title>Bütün @if($type == 'QRCODE') QR kodlar @else Barkodlar @endif</title>
<style>
  th{
    text-align: center;
    width: 50%;
  }
  @media print {
    body * {
      visibility: hidden;
      font-size: 12px;
    }
    #section-to-print, #section-to-print * {
      visibility: visible;
    }
    #section-to-print {
      position: absolute;
      left: 0;
      top: 0;
    }
    .btn{
      display: none;
    }
    table {
        border: solid #000 !important;
        border-width: 1px 0 0 1px !important;
    }
    th, td {
        border: solid #000 !important;
        border-width: 0 1px 1px 0 !important;
    }
  }
  @page {
    size: auto;
    margin: 0;
}
</style>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Bütün @if($type == 'QRCODE') QR kodlar @else Barkodlar @endif
          <small> @if($type == 'QRCODE') QR kodlar @else Barkodlar @endif</small>
        </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Əsas səhifə</a></li>
        <li class="active"><a>Bütün @if($type == 'QRCODE') QR kodlar @else Barkodlar @endif</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body" id="section-to-print">
              @include('layouts.alerts')
              <table class="table">
                <tbody>
                  @foreach($prods as $key => $prod)
                  @if($key == 0 | $key % 2 == 1) <tr> @endif
                    <td><img @if($type == 'QRCODE') src="data:image/png;base64,{{DNS2D::getBarcodePNG($prod->product_id, 'QRCODE')}}" @else src="data:image/png;base64,{{DNS1D::getBarcodePNG($prod->product_id, 'C39')}}" @endif alt='barcode' />
                      @if($type == 'QRCODE') @else <br><br><p>{{$prod->product_id}}</p>@endif
                    </td>
                  @if($key % 2 == 0) </tr> @endif
                  @endforeach
                </tbody>
              </table>
              <br>
              <br>
              <button onClick="window.print()" class="btn btn-primary pull-right">Print</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@section('js')
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
@endsection
