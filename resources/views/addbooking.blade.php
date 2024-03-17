@extends('layouts.master')
@section('css')
@if(Request::is('addbooking'))
<title>Sifariş əlavə et</title>
@elseif(Request::is('sold-product-list') | Request::is('sold-product-list/*'))
<title>{{__('app.Add_selling_product')}}</title>
@else
<title>{{__('app.Add_selling_product')}}</title>
@endif
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection
@section('body')
<div class="content-wrapper">
    @if(Request::is('addbooking'))
    <section class="content-header">
      <h1>{{__('app.Add_booking')}} <small> {{__('app.bookings')}}</small></h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.Add_booking')}}</a></li>
      </ol>
    </section>
    @elseif(Request::is('sold-product-list') | Request::is('sold-product-list/*'))
    <section class="content-header">
      <h1>{{__('app.Sold_products')}} <small> {{__('app.Product_list')}}</small></h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.Sold_products')}} </a></li>
      </ol>
    </section>
    @else
    <section class="content-header">
      <h1>{{__('app.Add_selling_product')}}<small>{{__('app.Sold_list')}}</small></h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">{{__('app.Add_selling_product')}}</a></li>
      </ol>
    </section>
    @endif
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                @if(Request::is('addbooking'))
                <h3 class="box-title">{{__('app.Add_booking')}} - <small><a href="/booking">Sifariş siyahısı</a></small></h3>
                @elseif(Request::is('sold-product-list') | Request::is('sold-product-list/*'))
                <h3 class="box-title">{{__('app.Sold_list')}} - <small><a href="/add-sold-product">{{__('app.Sold')}}</a></small></h3>
                @else
                <h3 class="box-title">{{__('app.Add_selling_product')}} -<small><a href="/sold-product-list"> {{__('app.Sold_list')}}</a></small></h3>
                @endif
                @include('layouts.alerts')
              <div class="box-body">
                <div class="row">
                     @if(Request::is('addbooking'))
                        <div class="col-md-9">
                          <div class="form-group">
                            <form class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="/addbooking">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <label class="col-xs-2 control-label" for="">{{__('app.Product')}}</label>
                                <div class="col-xs-10">
                                  <select class="form-control selectpicker" name="prod_name" data-placeholder="Select category" required  data-show-subtext="true" data-live-search="true">
                                    <option value="">{{__('app.Product')}}..</option>
                                    @foreach($product = App\Products::orderBy('product_name', 'asc')->get() as $prod)
                                    <option value="{{$prod->product_name}}" data-subtext="{{$prod->product_id}}">{{$prod->product_name}}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-2 control-label" for="">Ödəniş</label>
                                <div class="col-xs-10">
                                  <select class="form-control" tabindex="1" name="paid_status" data-placeholder="Select category" required>
                                    <option value="0">Ödənməyib</option>
                                    <option value="1">Ödənib</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-2 control-label" >Sifariş tarixi </label>
                                <div class="col-xs-10">
                                  <input class="form-control" type="date" name="booking_date" value="{{ date('Y-m-d') }}" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-2 control-label">Alıcı</label>
                                <div class="col-xs-10">
                                  <input class="form-control" type="text" name="user_name" id="" placeholder="Alıcı əlavə et..." required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-2 control-label" for="">Əlaqə nömrəsi</label>
                                <div class="col-xs-10">
                                  <input class="form-control" type="text" name="user_number" id="" placeholder="Əlaqə nörməsi əlavə et..." required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-xs-2 control-label" for="">Daha ətraflı</label>
                                <div class="col-xs-10">
                                  <textarea name="detail" rows="5" placeholder="Məlumat əlavə et..."></textarea>
                                </div>
                              </div>
                            <br>
                              <div class="form-group">
                                <label class="col-xs-2 control-label"></label>
                                <div class="col-xs-10">
                                  <input type="submit" name="submit" value="Əlavə et" class="btn btn-primary pull-right">
                                  <a class="btn btn-danger pull-right" href="{{ URL::previous() }}" style="margin-right:10px;">Geri dön</a>
                                </div>
                              </div>
                              <br>
                            </form>
                          </div>
                        </div>
                     @elseif(Request::is('sold-product-list') | Request::is('sold-product-list/*'))
                        <form class="form-group" action="/search-sold-products" method="post">
                          {{csrf_field()}}
                            <div class="col-xs-2">
                              <select class="form-control" name="day">
                                <option value="all">{{__('app.All')}}</option>
                                @for($d = 1; $d < 32; $d++)
                                <option value="{{$d}}" @if(!empty($da)) @if($d == $da) selected @endif @endif>{{$d}}</option>
                                @endfor
                              </select>
                            </div>
                            <div class="col-xs-4">
                              <select class="form-control" name="month">
                                <option value="all">{{__('app.All')}}</option>
                                <option value="1" @if(!empty($mo)) @if($mo == 1) selected @endif @endif>{{__('app.January')}}</option>
                                <option value="2" @if(!empty($mo)) @if($mo == 2) selected @endif @endif>{{__('app.February')}}</option>
                                <option value="3" @if(!empty($mo)) @if($mo == 3) selected @endif @endif>{{__('app.March')}}</option>
                                <option value="4" @if(!empty($mo)) @if($mo == 4) selected @endif @endif>{{__('app.April')}}</option>
                                <option value="5" @if(!empty($mo)) @if($mo == 5) selected @endif @endif>{{__('app.May')}}</option>
                                <option value="6" @if(!empty($mo)) @if($mo == 6) selected @endif @endif>{{__('app.June')}}</option>
                                <option value="7" @if(!empty($mo)) @if($mo == 7) selected @endif @endif>{{__('app.July')}}</option>
                                <option value="8" @if(!empty($mo)) @if($mo == 8) selected @endif @endif>{{__('app.August')}}</option>
                                <option value="9" @if(!empty($mo)) @if($mo == 9) selected @endif @endif>{{__('app.September')}}</option>
                                <option value="10" @if(!empty($mo)) @if($mo == 10) selected @endif @endif>{{__('app.October')}}</option>
                                <option value="11" @if(!empty($mo)) @if($mo == 11) selected @endif @endif>{{__('app.November')}}</option>
                                <option value="12" @if(!empty($mo)) @if($mo == 12) selected @endif @endif>{{__('app.December')}}</option>
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <select class="form-control" name="year">
                                <option value="all">{{__('app.All')}}</option>
                                @for($u = 2010; $u < 2022; $u++)
                                <option value="{{$u}}" @if(!empty($ye)) @if($u == $ye) selected @endif @endif>{{$u}}</option>
                                @endfor
                              </select>
                            </div>
                            <div class="col-xs-3">
                              <button class="btn btn-success" type="submit"><b class="fa fa-search"></b></button>
                            </div>
                        </form><br><br>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>{{__('app.Product')}}</th>
                              <th>{{__('app.Seller')}}</th>
                              <th>{{__('app.Date')}}</th>
                              <th>{{__('app.Sum_price')}}</th>
                              <th>#</th>
                            </tr>
                          </thead>
                        <tbody>
                        @foreach($sps as $sp)
                            <tr @if($sp->verified == 2) class='red' @endif>
                              @php($pro = App\Products::where('product_id',$sp->product_id)->first())
                              <td title="{{$pro->product_name}}">{{$sp->product_id}}</td>
                              <td>@foreach($users = App\User::where('id',$sp->seller)->get() as $user)
                                 {{$user->name}} {{$user->surname}}
                                 @endforeach</td>
                              <td>{{$sp->date->diffForHumans()}} ({{$sp->date->format('d, M Y')}})</td>
                              <td>{{($sp->sold_price) * ($sp->quantity)}}AZN</td>
                              <td>
                                @php($chre = App\Returnback::where('sale_id',$sp->id)->where('status',0)->first())
                                @if(Auth::user()->role_id == 3 && !empty($chre))
                                <a class="btn btn-primary" data-toggle="modal" data-target="#confirm_return{{$sp->id}}"><b class="fa fa-exclamation"></b></a>
                                @endif
                                @if(Auth::user()->role_id == 3 && $sp->verified == 0)
                                <a class="btn btn-success" data-toggle="modal" data-target="#confirm{{$sp->id}}"><b class="fa fa-check"></b></a>
                                @endif
                                @if(Auth::user()->role_id == 3 | (Auth::user()->id == $sp->seller && $sp->verified == 0))
                                <a class="btn btn-danger" data-toggle="modal" data-target="#delete{{$sp->id}}"><b class="fa fa-trash"></b></a>
                                <a class="btn btn-default" href="/edit-sale/{{$sp->token}}"><b class="fa fa-pencil-square-o"></b></a>
                                @endif
                                <a class="btn btn-primary" data-toggle="modal" data-target="#more{{$sp->id}}"><b class="fa fa-eye"></b></a>
                              </td>
                              <div id="more{{$sp->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">{{__('app.More')}}</h4>
                                    </div>
                                    <div class="modal-body">
                                      <ul class="list-group">
                                          <li class="list-group-item"><b>Qəbzin ID-si:</b> {{$sp->invoice_id}}</li>
                                          <li class="list-group-item"><b>Məhsulun ID-si:</b> {{$sp->product_id}}</li>
                                          <li class="list-group-item"><b>{{__('app.Product')}}:</b> @foreach($pros = App\Products::where('product_id',$sp->product_id)->get() as $pro)
                                            {{$pro->product_name}}
                                            @endforeach</li>
                                          <li class="list-group-item"><b>{{__('app.Seller')}}: </b>
                                            @foreach($users = App\User::where('id',$sp->seller)->get() as $user)
                                            {{$user->name}} {{$user->surname}}
                                            @endforeach
                                          </li>
                                          <li class="list-group-item"><b>{{__('app.Date')}}: </b>{{$sp->date}}</li>
                                          <li class="list-group-item"><b>{{__('app.Buyer')}}: </b>{{$sp->buyer}} / {{$sp->contact_number}}</li>
                                          <li class="list-group-item"><b>{{__('app.Quantity')}}: </b>{{$sp->quantity}}</li>
                                          <li class="list-group-item"><b>{{__('app.First_price')}}:</b> {{$sp->first_price}}AZN</li>
                                          <li class="list-group-item"><b>{{__('app.Price')}}: </b>{{$sp->sold_price}}AZN</li>
                                          <li class="list-group-item"><b>{{__('app.Earned')}}: </b>{{($sp->sold_price - $sp->first_price)*$sp->quantity}}AZN</li>
                                          <li class="list-group-item"><b>{{__('app.Sum_price')}}:</b>{{($sp->sold_price) * ($sp->quantity)}}AZN</li>
                                          <li class="list-group-item"><b>{{__('app.Comment')}}:</b> {!! ($sp->comment) !!}</li>
                                     </ul>
                                    </div>
                                    <div class="modal-footer">
                                      <a href="/return-sale/{{$sp->token}}" class="btn btn-primary pull-left">Geri qaytarma</a>
                                      <a href="/check/{{$sp->token}}" class="btn btn-success">Çek</a>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('app.Close')}}</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @if(Auth::user()->role_id == 3 && $sp->verified == 0)
                              <div id="confirm{{$sp->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">{{__('app.Confirm')}}</h4>
                                    </div>
                                    <form action="/confirm-sale/{{$sp->token}}" method="post">
                                    <div class="modal-body">
                                      {{__('app.Are_you_sure_to_confirm_sale')}}?
                                      <hr>
                                      <div>
                                        <label>{{__('app.Earned')}}</label>
                                        <input class="form-control" type="text" name="earning" value="{{($sp->sold_price - $sp->first_price)*$sp->quantity}}" required>
                                      </div>
                                      {{csrf_field()}}
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('app.Close')}}</button>
                                      <button type="submit" class="btn btn-primary">{{__('app.Confirm')}}</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              @endif
                              @if(Auth::user()->role_id == 3 | (Auth::user()->id == $sp->seller && $sp->verified == 0))
                              <div id="confirm_return{{$sp->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Təsdiqlə</h4>
                                    </div>
                                    <form method="post" action="/confirm/return/{{$sp->id}}">
                                      {{csrf_field()}}
                                      <div class="modal-body">Geri qaytarmanı təsdiqlə
                                        <p><b></b></p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('app.Close')}}</button>
                                        <button type="submit" class="btn btn-danger">{{__('app.Confirm')}}</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <div id="delete{{$sp->id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">{{__('app.Delete')}}</h4>
                                    </div>
                                    <div class="modal-body">
                                      {{__('app.Are_you_sure_to_delete_sale')}}?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">{{__('app.Close')}}</button>
                                      <a href="/delete-sale/{{$sp->token}}" class="btn btn-danger">{{__('app.Delete')}}</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @endif
                            </tr>
                        @endforeach
                            @if(empty($da) && empty($mo) && empty($ye))
                              <tr><td style="font-weight: bold;">{{__('app.Sum_in_last_7_days')}}:</td><td style="color: red;">{{$sumw}}AZN</td><td style="background: gray;"></td>
                                  <td style="font-weight: bold;">{{__('app.Sum_in_last_30_days')}}: </td>
                                  <td style="color: red;">{{$sum}}AZN</td>
                              </tr>
                             @else
                              <tr><td style="background: gray;"></td><td style="background: gray;"></td><td style="background: gray;"></td>
                                    <td style="font-weight: bold;">{{__('app.Sale')}}: </td>
                                    <td style="color: red;">{{$sumgiven}}AZN</td>
                            @endif
                          </tbody>
                        </table>
                        <center>{{$sps->links()}}</center>
                     @else
                        <div class="col-md-9">
                          <div class="form-group">
                              <form class="form-horizontal row-fluid" method="POST" @if(Request::is('edit-sale/*')) action="/editsale/{{$sp->token}}" @else action="/add-new-sale" @endif>
                                {{csrf_field()}}
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" for="">{{__('app.Product')}} </label>
                                  <div class="col-xs-10">
                                    <select class="form-control selectpicker" name="product_id" data-placeholder="Select product" id="product_id" data-show-subtext="true" data-live-search="true" required onchange="getproprice()">
                                      <option>{{__('app.Product')}}..</option>
                                      @foreach($product = App\Products::orderBy('product_name', 'asc')->get() as $prod)
                                      <option value="{{$prod->product_id}}" data-subtext="{{$prod->product_id}}" @if(Request::is('edit-sale/*')) @if($sp->product_id == $prod->product_id) selected @endif @endif>{{$prod->product_name}}: {{$prod->price}}AZN</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                @if(Auth::user()->role_id == 3)
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" for="seller">{{__('app.Seller')}}</label>
                                  <div class="col-xs-10">
                                    <select class="form-control selectpicker" name="seller" data-placeholder="Select seller" data-show-subtext="true" data-live-search="true" required>
                                      <option value="0">{{__('app.Seller')}}..</option>
                                      @foreach($user = App\User::all() as $user)
                                      <option value="{{$user->id}}" @if(Request::is('edit-sale/*')) @if($sp->seller == $user->id) selected @endif @endif>{{$user->name}} {{$user->surname}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                @else
                                <input type="hidden" name="seller" value="{{Auth::user()->id}}">
                                @endif
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" >{{__('app.Sold_date')}}</label>
                                  <div class="col-xs-10">
                                    <input class="form-control" type="date" name="date" required @if(Request::is('edit-sale/*')) value="{{ $sp->date->format('Y-m-d') }}" @else value="{{ date('Y-m-d') }}" @endif>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label">{{__('app.Buyer')}}</label>
                                  <div class="col-xs-5">
                                    <input class="form-control" type="text" name="phone_number" placeholder="{{__('app.Buyer_phone_number')}}..." @if(Request::is('edit-sale/*')) value="{{ $sp->contact_number }}" @else value="+994" @endif id="custnumb" oninput="getcustname()" required>
                                  </div>
                                  <div class="col-xs-5">
                                    <input class="form-control" type="text" id="custbuyer" name="buyer" placeholder="{{__('app.Buyer_name')}}..." @if(Request::is('edit-sale/*')) value="{{ $sp->buyer }}" @endif required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" >{{__('app.Sold_price')}}</label>
                                  <div class="col-xs-7">
                                    <input id="pro_price" class="form-control" type="number" name="sold_price" placeholder="{{__('app.Sold_price')}}" min="0" required @if(Request::is('edit-sale/*')) value="{{ $sp->sold_price }}" @endif step="0.01">
                                  </div>
                                  <div class="col-xs-3">
                                    <input class="form-control" type="number" name="quantity" placeholder="{{__('app.Quantity')}}" min="0" required @if(Request::is('edit-sale/*')) value="{{ $sp->quantity }}" @endif>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" for="comment">{{__('app.Comment')}}</label>
                                  <div class="col-xs-10">
                                    <textarea name="comment" rows="5">@if(Request::is('edit-sale/*')) {{ $sp->comment }} @endif</textarea>
                                  </div>
                                </div>
                                <br>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" for=""></label>
                                  <div class="col-xs-10">
                                    <input type="submit" name="submit" value="Əlavə et" class="btn btn-primary pull-right">
                                    <a class="btn btn-danger pull-right" href="{{ URL::previous() }}" style="margin-right:10px;">Geri dön</a>
                                  </div>
                                </div>
                              <br>
                            </form>
                          </div>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- </div> -->
    </section>
  </div>
@endsection
@section('js')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="/js/tinymce.js"></script>
<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <!-- <script src="plugins/daterangepicker/daterangepicker.js"></script> -->
  <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="/plugins/iCheck/icheck.min.js?v={{md5(uniqid())}}"></script>
  <script src="/plugins/fastclick/fastclick.js?v={{md5(uniqid())}}"></script>
  <script src="/dist/js/app.min.js?v={{md5(uniqid())}}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection
