@extends('layouts.master')
@section('css')
@if(Request::is('check-creation'))
<title>Çek əlavə et</title>
@elseif(Request::is('add-comment'))
<title>{{__('app.Add_comment')}}</title>
@endif
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      @if(Request::is('add-comment'))
      <h1>{{__('app.Add_comment')}}</h1>
      @else
      <h1>Çek əlavə et</h1>
      @endif
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="#">Çek əlavə et</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                @if(Request::is('check-creation'))
                <h3 class="box-title">Çek əlavə et</h3>
                @include('layouts.alerts')
                <div class="box-body">
                  <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                              <form class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="/add-check">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label class="col-xs-2 control-label">Çek ID-si </label>
                                  <div class="col-xs-10">
                                    <input class="form-control" value="{{ old('check_id') }}" placeholder="Çek ID-si..." type="text" name="check_id" required>
                                    @if ($errors->has('check_id'))
                                        <span class="help-block red">
                                            <strong>{{ $errors->first('check_id') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label">Məbləğ </label>
                                  <div class="col-xs-10">
                                    <input class="form-control" type="text" placeholder="Amount..." name="amount" step="0.01" value="{{ old('amount') }}" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label">Tarix </label>
                                  <div class="col-xs-10">
                                    <input class="form-control" value="{{ old('pay_date') }}" type="date" name="pay_date" required>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label" for="">Əlavə rəy</label>
                                  <div class="col-xs-10">
                                    <textarea name="comment" rows="5" placeholder="Məlumat əlavə et...">{{ old('comment') }}</textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-xs-2 control-label"></label>
                                  <div class="col-xs-10">
                                    <input type="submit" name="submit" value="Əlavə et" class="btn btn-primary pull-right">
                                  </div>
                                </div>
                                <br>
                              </form>
                            </div>
                         </div>
                      </div>
                    </div>
                  @elseif(Request::is('add-comment'))
                  <h3 class="box-title"> {{__('app.Add_comment')}}</h3>
                  @include('layouts.alerts')
                  <div class="box-body">
                    <div class="row">
                          <div class="col-md-9">
                              <div class="form-group">
                                <form class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="/add-new-comment">
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                    <label class="col-xs-2 control-label" for="">{{__('app.Customers')}}</label>
                                    <div class="col-xs-10">
                                      <select class="form-control selectpicker" name="customer" data-placeholder="Select product" id="customer_id" data-show-subtext="true" data-live-search="true" required onchange="getproprice()">
                                        <option>{{__('app.Customers')}}..</option>
                                        @php($sps = App\Soldpro::distinct()->get(['contact_number']))
                                        @foreach($sps as $sp)
                                        @php($sp2 = App\Soldpro::where('contact_number',$sp->contact_number)->where('buyer','!=','Qeyd edilməyib')->get())
                                        <option value="{{$sp->contact_number}}" @foreach($sp2 as $sp22) data-subtext="{{$sp22->buyer}}" @endforeach>{{$sp->contact_number}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-xs-2 control-label">Tarix </label>
                                    <div class="col-xs-10">
                                      <input class="form-control" value="{{date('Y-m-d')}}" type="date" name="issue_date" required>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-xs-2 control-label" for="">Əlavə rəy</label>
                                    <div class="col-xs-10">
                                      <textarea name="comment" class="form-control" rows="5" placeholder="Məlumat əlavə et..." required></textarea>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-xs-2 control-label"></label>
                                    <div class="col-xs-10">
                                      <input type="submit" name="submit" value="Əlavə et" class="btn btn-primary pull-right">
                                    </div>
                                  </div>
                                  <br>
                                </form>
                              </div>
                           </div>
                        </div>
                      </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
@endsection
@section('js')
<!-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script> -->
<!-- <script src="/js/tinymce.js"></script> -->
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
