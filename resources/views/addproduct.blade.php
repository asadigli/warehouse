@extends('layouts.master')
@section('css')
<title>Məhsul əlavə et</title>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Məhsul əlavə et
        <small> yeni məhsul əlavə etmək</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Əsas səhifə</a></li>
        <li class="active"><a href="#">Sifariş əlavə et</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Məhsul əlavə et</h3>
                @include('layouts.alerts')
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="/addproduct">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label class="col-xs-2 control-label" for="">Category</label>
                          <div class="col-xs-10">
                            <select class="form-control"  tabindex="1" name="cat_id" data-placeholder="Select category" required>
                              <option value="" disabled selected>Select here..</option>
                              @foreach($cats = App\Category::all() as $cat)
                              <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                        <label class="col-xs-2 control-label" >Product Name</label>
                        <div class="col-xs-10">
                          <input class="form-control" type="text" name="name" id="" placeholder="Add a name..." required>
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="col-xs-2 control-label">Product ID</label>
                        <div class="col-xs-10">
                          <input class="form-control" type="text" name="product_id" id="valid" placeholder="Add ID here..." value="SS" required minlength="7" oninput="validate_id()" oninvalid="this.setCustomValidity('Səhvlik')"onvalid="this.setCustomValidity('')">
                        </div>
                      </div>
                        <div class="form-group">
                      <label class="col-xs-2 control-label" for="">Alış qiyməti</label>
                      <div class="col-xs-10">
                        <input class="form-control" type="number" name="first_price" id="" placeholder="Add buying price..." required step="0.01">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="">Satış qiyməti</label>
                        <div class="col-xs-10">
                          <input class="form-control" type="number" name="price" id="" placeholder="Add selling price..." required step="0.01">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label" for="">Köhnə qiymət</label>
                        <div class="col-xs-10">
                          <input class="form-control" type="number" name="old_price" id="" placeholder="Add old selling price..." required step="0.01">
                        </div>
                    </div>
                        <div class="form-group">
                        <label class="col-xs-2 control-label" for="">Quantity</label>
                        <div class="col-xs-10">
                          <select class="form-control" tabindex="1" name="quantity" data-placeholder="Select here..." required>
                            <option value="" disabled selected>Select here..</option>
                            @for ($k = 0; $k <= 100; $k++)
                            <option value="{{$k}}">{{$k}}</option>
                            @endfor
                          </select>
                            @if ($errors->has('quantity'))
                                <span class="help-block">
                                    <strong style="color:red;">{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                        <div class="form-group">
                        <label class="col-xs-2 control-label" for="">Quantity on the way</label>
                        <div class="col-xs-10">
                          <select class="form-control" tabindex="1" name="shipping_quantity" data-placeholder="Select here.." required>
                            <option value="" disabled selected>Select here..</option>
                            @for ($i = 0; $i <= 100; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-xs-2 control-label" for="about">About</label>
                        <div class="col-xs-10">
                            <textarea name="about" rows="5" placeholder="Add details here..."></textarea>
                        </div>
                      </div>
                       <div class="form-group">
                            <label class="col-xs-2 control-label" for="keywords">Açar sözlər</label>
                            <div class="col-xs-10">
                                <textarea name="keywords" rows="5"></textarea>
                            </div>
                          </div>
                        <div class="form-group">
                        <label class="col-xs-2 control-label" for="">Image</label>
                        <div class="col-xs-10">
                          <input class="form-control" type="file" name="product_image" placeholder="Type something here...">
                        </div>
                      </div>
                        <div class="form-group">
                         <label class="col-xs-2 control-label" for=""></label>
                        <div class="col-xs-10">
                          <input class="btn btn-primary pull-right" type="submit" name="submit" value="Add new product">
                        </div>
                      </div>
                      <br>
                    </form>
                    </div>
                  </div>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="/dist/js/demo.js"></script>
@endsection
