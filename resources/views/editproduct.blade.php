@extends('layouts.master')
@section('css')
<title>{{$prod->product_name}}</title>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>{{__('app.Edit_product')}}
        <small>{{__('app.change_product_properties')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
        <li class="active"><a href="">{{__('app.Edit_product')}}</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('app.Edit_product')}} -
                <small><a href="{{ URL::previous() }}">{{__('app.Go_back')}} </a></small>
              </h3>
              <br>
             @include('layouts.alerts')
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <!-- <div class="box-body table-responsive no-padding"> -->
                      <form class="form-horizontal row-fluid" enctype="multipart/form-data" method="POST" action="/changeproductsettings/{{$prod->id}}">
                        {{ csrf_field() }}
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="cat_id">Category</label>
                            <div class="col-xs-10">
                              <select class="form-control" tabindex="1" name="cat_id" data-placeholder="Select category" required>
                                @foreach($cat = App\Category::all() as $cat)
                                <option value="{{$cat->id}}" @if($prod->cat_id == $cat->id) selected @endif>{{$cat->cat_name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="product_name">{{__('app.Product_name')}}</label>
                            <div class="col-xs-10">
                              <input class="form-control" type="text" name="product_name" value="{{$prod->product_name}}" id="" placeholder="Add a name..." required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="product_id">{{__('app.Product_ID')}}</label>
                            <div class="col-xs-10">
                              <input class="form-control" type="text" name="product_id" value="{{$prod->product_id}}" placeholder="Add ID here..." required>
                            </div>
                          </div>
                          <div class="form-group">
                          <label class="col-xs-2 control-label" for="first_price">{{__('app.First_price')}}</label>
                          <div class="col-xs-10">
                            <input class="form-control" type="number" name="first_price" value="{{$prod->first_price}}" placeholder="Add buying price..." required step="0.01">
                          </div>
                        </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="price">{{__('app.Price')}}</label>
                            <div class="col-xs-10">
                              <input class="form-control" type="number" name="price" value="{{$prod->price}}" placeholder="Add selling price..." required step="0.01">
        
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="price">Köhnə qiymət</label>
                            <div class="col-xs-10">
                              <input class="form-control" type="number" name="old_price" value="{{$prod->old_price}}" placeholder="Add selling price..." required step="0.01">
        
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="quantity">{{__('app.Quantity')}}</label>
                            <div class="col-xs-10">
                              <select class="form-control" tabindex="1" name="quantity" data-placeholder="Select here..." required>
                                <option value="{{$prod->quantity}}" selected>{{$prod->quantity}}</option>
                                @for ($k = 0; $k < 25; $k++)
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
                            <label class="col-xs-2 control-label" for="shipping_quantity">{{__('app.Quantity_on_the_way')}}</label>
                            <div class="col-xs-10">
                              <select class="form-control" tabindex="1" name="shipping_quantity" data-placeholder="Select here.." required>
                                <option value="{{$prod->shipping_quantity}}">{{$prod->shipping_quantity}}</option>
                                @for ($i = 0; $i < 25; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="about">{{__('app.About')}}</label>
                            <div class="col-xs-10">
                                <textarea name="about" rows="5" placeholder="Add details here..." required> {{$prod->about}}</textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="keywords">Açar sözlər</label>
                            <div class="col-xs-10">
                                <textarea name="keywords" rows="5"> {{$prod->keywords}}</textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-xs-2 control-label" for="">{{__('app.Image')}}</label>
                            <div class="col-xs-10">
                              <input class="form-control" type="file" name="product_image" value="{{$prod->product_image}}" placeholder="Type something here...">
                            </div>
                          </div>
                          <div class="form-group">
                          <div class="col-xs-12">
                            <input type="submit" name="submit" value="Change" class="pull-right btn btn-primary">
                            <a class="btn btn-danger pull-right" href="{{ URL::previous() }}" style="margin-right:10px;">Go back</a>
                          </div>
                        </div>
                        <br>
                      </form>
                    <!-- </div> -->
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
<script src="{{ asset('dist/js/app.min.js')}}"></script>
@endsection