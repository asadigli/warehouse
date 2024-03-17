@extends('layouts.master')
@section('css')
@if(Request::is('return-sale/*'))
<title>Geri qaytarma</title>
@else
<title>Satış haqqında</title>
<style>
  .red{
    color: red;
  }
  .green{
    color: green;
    background-color: #f0f0f0;
  }
  th{
    text-align: center;
    width: 50%;
  }
  .info-th{
    font-weight: bold;
  }
  .website{
    display: none;
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
    .website{
      display: block;
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
@endif
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
        @if(Request::is('return-sale/*'))
        <h1> Geri qaytarma </h1>
        @else
        <h1>
          Satış haqqında
          <small>Faktura</small>
        </h1>
        @endif
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Əsas səhifə</a></li>
        @if(Request::is('return-sale/*'))
        <li class="active"><a>Geri qaytarma</a></li>
        @else
        <li class="active"><a>Satış haqqında</a></li>
        @endif
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body" id="section-to-print">
              @if(Request::is('return-sale/*'))
              @else
              <h4>
                Satış haqqında:
                <small>{{$sp->date->format('d/m/Y')}}</small>
                <strong class="pull-right">Sade Store</strong>
              </h4>
              @endif
              @include('layouts.alerts')
              @if(Request::is('return-sale/*'))
              <form action="/return/sale/{{$sp->token}}" method="POST">
                {{csrf_field()}}
              @else
              @endif
              <table class="table">
                <thead>
                <tr>
                  <th></th>
                  <th>Məlumat</th>
                </tr>
                </thead>
                @if(Request::is('return-sale/*'))
                <tbody>
                  <tr class="green">
                    <td class="info-th">Çekin kodu:</td>
                    <td class="check-val">{{$sp->invoice_id}}</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Məhsulun adı:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$pro->product_name}}
                      @endforeach
                    </td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Məhsulun kodu:</td>
                    <td class="check-val">{{$sp->product_id}}</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Müştərinin adı:</td>
                    <td class="check-val">{{$sp->buyer}}</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Müştərinin əlaqə nömrəsi:</td>
                    <td class="check-val"><input type="text" name="c_number" value="{{$sp->contact_number}}" readonly class="form-control"></td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Məhsulun qiyməti:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$sp->old_price}} AZN
                      @endforeach</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Sayı:</td>
                    <td class="check-val">{{$sp->quantity}} ədəd</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Endirim:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$pro->old_price - $sp->sold_price}} AZN
                      @endforeach</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Yekun məbləğ:</td>
                    <td class="check-val">
                      {{$sp->sold_price * $sp->quantity}} AZN</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Geri qaytarılan məhsul sayı:</td>
                    <td class="check-val">
                      <div class="input-group">
                        <input type="number" placeholder="Geri qaytarılan məhsul sayı..." class="form-control" value="{{$sp->quantity}}" name="q_return" required>
                        <div class="input-group-addon">ədəd</div>
                      </div></td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Geri qaytarılan qiyməti:</td>
                    <td class="check-val">
                      <div class="input-group">
                        <input type="number" placeholder="Geri qaytarılan qiyməti..." class="form-control" value="{{$sp->sold_price * $sp->quantity}}" min="0.00" step="0.05" name="price_return" required>
                        <div class="input-group-addon">AZN</div>
                      </div>
                    </td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Geri qaytarılma tarixi:</td>
                    <td class="check-val"><input type="date" class="form-control" name="return_date" value="{{ date('Y-m-d') }}" required></td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Yararlılığı:</td>
                    <td class="check-val">
                      <select class="form-control" name="availability" required>
                        <option value="useful">Yararlı</option>
                        <option value="useless">Yararsız</option>
                      </select>
                    </td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Geri qaytarılma səbəbi:</td>
                    <td class="check-val">
                      <textarea class="form-control" name="reason" placeholder="Geri qaytarılma səbəbi..." rows="10"></textarea>
                    </td>
                  </tr>
                </tbody>
                @else
                <tbody>
                  <tr class="green">
                    <td class="info-th">Çekin kodu:</td>
                    <td class="check-val">{{$sp->invoice_id}}</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Məhsulun adı:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$pro->product_name}}
                      @endforeach
                    </td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Məhsulun kodu:</td>
                    <td class="check-val">{{$sp->product_id}}</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Müştərinin adı:</td>
                    <td class="check-val">{{$sp->buyer}}</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Müştərinin əlaqə nömrəsi:</td>
                    <td class="check-val">{{$sp->contact_number}}</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Məhsulun qiyməti:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$pro->old_price}}AZN
                      @endforeach</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Sayı:</td>
                    <td class="check-val">{{$sp->quantity}} ədəd</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Endirim:</td>
                    <td class="check-val">
                      @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                      {{$pro->old_price - $sp->sold_price}}AZN
                      @endforeach</td>
                  </tr>
                  <tr class="green">
                    <td class="info-th">Yekun məbləğ:</td>
                    <td class="check-val">{{$sp->sold_price * $sp->quantity}}AZN</td>
                  </tr>
                  <tr class="red">
                    <td class="info-th">Əlavə:</td>
                    <td class="check-val">
                      Sade Store-dan alınan məhsullar müştəriyə təqdim olunduqdan sonra bir həftə ərzində dəyişdirilə bilər <br>
                      Çekin etibarlılığı sayt (https://sade.store/check) üzərindən yoxlanıla bilər
                    </td>
                  </tr>
                </tbody>
                @endif
              </table>
              <br>
              @if(Request::is('return-sale/*'))
              <button type="submit" class="btn btn-primary pull-right">Əlavə et</button>
              </form>
              @else
              <p class="website"><span>Əlaqə: +994708186601</span><span class="pull-right">Sayt: https://sade.store</span></p>
              <br>
              <button onClick="window.print()" class="btn btn-primary pull-right">Print</button>
              @endif
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
