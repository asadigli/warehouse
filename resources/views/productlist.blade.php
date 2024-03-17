@extends('layouts.master')
@section('css')
  <title>@if(Request::is('list/*')) {{$cat->cat_name}} @elseif(Request::is('allproducts')) Bütün məhsullar @elseif(Request::is('finishedproducts')) Bitmiş məhsullar @elseif(Request::is('onthewaylist')) Yolda olanlar @endif</title>
  <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
  <style>
    .more-image{width:220px !important;height:220px !important;border: 1px solid #ddd;border-radius: 4px;}
    .actions{float: right;}
    td.times:after
    {
    content: "dəfə ";
    }
    td.currency:before
    {
    content: "₼ ";
    }
    .success-message{
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #15adf5;
      border-radius: 5px;
      font-weight: bold;
      padding: 25px 50px 24px 50px;
      color: white;
      z-index:100;
      -webkit-box-shadow: 0px 0px 21px 0px rgba(156,156,156,1);
-moz-box-shadow: 0px 0px 21px 0px rgba(156,156,156,1);
box-shadow: 0px 0px 21px 0px rgba(156,156,156,1);
    }
    .success-message a{
      position: absolute;
      color: white;
      cursor: pointer;
      right: 6px;
      top: 4px;
    }
</style>
@endsection
@section('body')
<div id="alert"></div>
  <div class="content-wrapper">
    <section class="content-header">
      <h1 style="text-transform:capitalize;">
        @if(Request::is('list/*')) {{$cat->cat_name}} məhsulları @elseif(Request::is('allproducts')) Bütün məhsullar @elseif(Request::is('finishedproducts')) Bitmiş məhsullar @elseif(Request::is('onthewaylist')) Yolda olanlar @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-home"></i> Əsas səhifə</a> </li>
        @if(Request::is('list/*')) <li><a href="/list/{{$cat->id}}"> Kateqoriya</a></li> @endif
        <li><a class="active" href="">@if(Request::is('list/*')) {{$cat->cat_name}} @elseif(Request::is('allproducts')) Bütün məhsullar @elseif(Request::is('finishedproducts')) Bitmiş məhsullar @elseif(Request::is('onthewaylist')) Yolda olanlar @endif</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            @include('layouts.alerts')
            <div class="box-body" onload="mytask();">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('app.ID')}}</th>
                  <th>{{__('app.Name')}}</th>
                  <th class="expart">{{__('app.Price')}}</th>
                  <th class="expart">{{__('app.Quantity')}}</th>
                  <th class="expart">{{__('app.Sold_times')}}</th>
                  <th class="actions">{{__('app.Action')}}</th>
                </tr>
                </thead>
                <tbody id="pross">
                  @foreach($prod as $key => $prod)
                  <tr class="even gradeC">
                    <td>{{$prod->product_id}}</td>
                    <td>
                      @if($prod->quantity == 0)
                      <span style="color:red">{{$prod->product_name}}</span>
                      @elseif($prod->quantity != 0 && $prod->quantity == $prod->shipping_quantity)
                      <span style="color:green;">{{$prod->product_name}} <i style="color:red">*</i> </span>
                      @elseif($prod->quantity != 0 && $prod->quantity != $prod->shipping_quantity)
                      <span style="color:black;">{{$prod->product_name}}</span>
                      @endif
                    </td>
                    <td class="currency expart" id="curr{{$prod->id}}">{{$prod->price}}</td>
                    <td class="quantity expart" id="quant{{$prod->id}}">{{$prod->quantity}}</td>
                    <td class="times expart">
                      @php($soldpro = App\Soldpro::where('product_id',$prod->product_id)->get())
                      @php($times = 0)
                      @foreach($soldpro as $sp)
                      @php($times += $sp->quantity)
                      @endforeach
                      {{$times}}
                    </td>
                    <td class="actions">
                      <div class="btn-group-vertical acts">
                        @if(Auth::user()->role_id == 3)
                        <button data-toggle="modal" data-target="#delete{{$prod->id}}" type="button" class="btn btn-danger" title="{{__('app.Delete')}}" value="{{$prod->id}}" onclick="getdeletepopup(this)"><b class="fa fa-trash"></b></button>
                        @endif
                        <button data-toggle="modal" data-target="#edit{{$prod->id}}" type="button" class="btn btn-success" title="{{__('app.Edit')}}" value="{{$prod->id}}" onclick="geteditpopup(this)"><b class="fa fa-pencil-square-o"></b></button>
                        <button type="button" data-toggle="modal" data-target="#more{{$prod->id}}" type="button" class="btn btn-primary" title="{{__('app.More')}}" value="{{$prod->id}}" onclick="getproimage(this)"><b class="fa fa-eye"></b></button>
                      </div>
                    </td>
                  </tr>
                  @if(Auth::user()->role_id == 3)
                  <div class="modal fade" id="delete{{$prod->id}}" role="dialog"></div>
                  @endif
                  <div class="modal fade" id="more{{$prod->id}}" role="dialog"><div class="modal-dialog" id="promorepop{{$prod->id}}"></div></div>
                  <div class="modal fade" id="edit{{$prod->id}}" role="dialog"></div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>{{__('app.ID')}}</th>
                  <th>{{__('app.Name')}}</th>
                  <th class="expart">{{__('app.Price')}}</th>
                  <th class="expart">{{__('app.Quantity')}}</th>
                  <th class="expart">{{__('app.Sold_times')}}</th>
                  <th class="actions">{{__('app.Action')}}</th>
                </tr>
                </tfoot>
              </table>
              <hr>
              <div class="">
                <a href="/all-codes/C39" class="btn btn-warning">Barkodlar</a>
                <a href="/all-codes/QRCODE" class="btn btn-info">QR kodlar</a>
                <div class="btn-group pull-right">
                  <a href="/allproducts" class="btn btn-primary">{{__('app.All_products')}} </a>
                <a href="/onthewaylist" class="btn btn-success">{{__('app.On_the_way_list')}}</a>
                  <a href="/finishedproducts" class="btn btn-danger"> {{__('app.Finished_products')}} </a>
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
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="/plugins/fastclick/fastclick.js"></script>
  <script src="/dist/js/app.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "stateSave": true
      });
    });
  </script>
 @endsection
