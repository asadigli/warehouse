<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="robots" content="noindex">
  <meta name="robots" content="NOFOLLOW">
  <meta name="robots" content="NOARCHIVE ">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/plugins/iCheck/flat/blue.css">
  <!--<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">-->
  <link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="/images/logo.png" />
  <style type="text/css">
    .list-group-item b{
      color:#003399;
    }
  </style>
  @section('css')
  @show
    <style media="screen">
         .no-js #loader { display: none;  }
              .js #loader { display: block; position: absolute; left: 100px; top: 0; }
              .se-pre-con {
              position: fixed;
              left: 0px;
              top: 0px;
              width: 100%;
              height: 100%;
              z-index: 9999;
              background: url("/images/loading.gif") center no-repeat #fff;
          }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <!--<div class="se-pre-con"></div>-->
<div class="wrapper">
  <header class="main-header">
    <a href="/home" class="logo">
      <span class="logo-mini"><b>S</b>P</span>
      <span class="logo-lg"><b>Sade</b>Products</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">{{ trans('app.navigation')}}</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown messages-menu">
            @if(3==4)
            @include('layouts.messagepart')
            @endif
          </li>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-list-ul"></i>
            </a>
            <ul class="dropdown-menu">
              <li class="header">{{trans('app.control_panel')}}</li>
              <li>
                <ul class="menu">
                  <li><a href="/addbooking"><i class="fa fa-plus"></i> Sifariş əlavə et</a>
                      <a href="/addproduct"><i class="fa fa-plus"></i> Məhsul əlavə et</a></li>
                  @if(Auth::user()->role_id == 3)
                  <li>
                    <a href="/addbalance"><i class="fa fa-plus"></i> {{__('app.Add_balance')}}</a>
                  </li>
                  <li>
                    <a href="/addcategory"><i class="fa fa-plus"></i> Kateqoriya idarəsi
                      <b class="label orange pull-right">{{$cat = App\Category::all()->count()}}</b>
                    </a>
                  </li>
                  <li>
                    <a href="/users"><i class="fa fa-list-ul"></i> User Control
                      <b class="label green pull-right">{{$user = App\User::all()->count()}}</b>
                    </a>
                  </li>
                  <li>
                    <a href="/usersbalance"><i class="fa fa-list-ul"></i> Bütün balanslar
                    </a>
                  </li>
                  @else
                  <li>
                    <a href="/balance"><i class="fa fa-money"></i> My Balance
                    </a>
                  </li>
                  <li>
                    <a href="/allproducts"><i class="fa fa-list"></i> Products </a>
                  </li>
                  @endif
                </ul>
              </li>
            </ul>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/uploads/profilephotos/{{Auth::user()->user_image}}" class="user-image" alt="User Image">
              <span class="hidden-xs" style="text-transform: capitalize;">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/uploads/profilephotos/{{Auth::user()->user_image}}" class="img-circle" alt="User Image">
                <p>
                  <span style="text-transform:capitalize">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                  <br> Admin
                  <small>{{trans('app.employee_since',['dt' => Auth::user()->created_at->format('d M, Y')])}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">{{__('app.my_profile')}}</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      {{__('app.Log_out')}}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }} </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/uploads/profilephotos/{{Auth::user()->user_image}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="text-transform: capitalize;">{{Auth::user()->name}} {{Auth::user()->surname}} </p>
          <a href="#">
            @if(Auth::user()->isOnline()) <i class="fa fa-circle text-success"></i> @else <i class="fa fa-circle text-danger"></i> @endif
            @if(Auth::user()->role_id == 3) Əsas Admin @else(Auth::user()->role_id == 2) Admin @endif
          </a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" id="mysearch" class="form-control" placeholder="Search..." autocomplete="off">
              <span class="input-group-btn">
                <a disabled type="submit" name="search" class="btn btn-flat"><i class="fa fa-search"></i>
                </a>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu" id="myNav">
        <li class="header">Əsas naviqasiya</li>
        <li class="{{ Request::is('home')? 'active': '' }}">
          <a href="/home">
            <i class="fa fa-home"></i> <span>{{__('app.Home')}}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">{{__('app.main')}}</small>
            </span>
          </a>
        </li>

        <li class="treeview {{ Request::is('list/*')? 'active': '' }}">
          <a href="#">
            <i class="fa fa-list-ol"></i> <span>{{__('app.Categories')}}</span>
            <span class="pull-right-container">
              <span class="label label-warning pull-right">
            {{$cat_pro = App\Category::all()->count()}}
              </span>
            </span>
          </a>
          <ul class="treeview-menu">
            @foreach($cats = App\Category::all() as $cat)
            <li class="{{ Request::is('list/'.$cat->id)? 'active': '' }}">
              <a href="/list/{{$cat->id}}">
                <i class="menu-icon icon-inbox"></i>
                <i class="fa fa-circle-o"></i> {{$cat->cat_name}}
                <b class="label green pull-right">
                  {{$proddd = App\Products::where('cat_id',$cat->id)->where('quantity','!=',0)->count()}}
                </b>
              </a>
            </li>
            @endforeach
          </ul>
        </li>
        <li class=" {{ Request::is('allproducts')? 'active': '' }}">
        <a href="/allproducts">
          <i class="fa fa-list-alt"></i> <span>{{__('app.All_products')}}</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">
              {{$products = App\Products::all()->count()}}
            </span>
          </span>
          <span class="pull-right-container">
          </span>
        </a>
        </li>

        <li class="treevie {{ (Request::is('add-sold-product') | Request::is('sold-product-list'))? 'active': '' }}">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>{{__('app.Sold_part')}}</span>
            <span class="pull-right-container">
              <span class="not-confirmed-sales" data-name="Təsdiqlənməmiş satış"></span>
               <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('add-sold-product')? 'active': '' }}"><a href="/add-sold-product"><i class="fa fa-circle-o"></i>{{__('app.Sold')}}</a></li>
            <li class="{{ Request::is('sold-product-list')? 'active': '' }}"><a href="/sold-product-list"><i class="fa fa-circle-o"></i>{{__('app.Sold_list')}}
            @if($sp = App\Soldpro::where('verified',0)->count() != 0)
             <span class="pull-right-container">
              <span class="label label-danger pull-right">
                {{$sp = App\Soldpro::where('verified',0)->count()}}
              </span>
            </span>
            @endif
            </a></li>
          </ul>
        </li>

        <li class="treevie {{ (Request::is('addproduct') | Request::is('addbooking') | Request::is('addbalance') | Request::is('gallery-control') | Request::is('adduser'))? 'active': '' }}">
          <a href="#">
            <i class="fa fa-plus"></i> <span>Daha çox əlavə et</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('addproduct')? 'active': '' }}"><a href="/addproduct"><i class="fa fa-circle-o"></i> Məhsul əlavə et</a></li>
            <li class="{{ Request::is('addbooking')? 'active': '' }}"><a href="/addbooking"><i class="fa fa-circle-o"></i> Sifariş əlavə et</a></li>
            <li class="{{ Request::is('add-comment')? 'active': '' }}"><a href="/add-comment"><i class="fa fa-circle-o"></i> {{__('app.Add_comment')}}</a></li>
            <li class="{{ Request::is('check-creation')? 'active': '' }}"><a href="/check-creation"><i class="fa fa-circle-o"></i> Çek əlavə et</a></li>
            @if(Auth::user()->role_id == 3)
            <li class="{{ Request::is('addbalance')? 'active': '' }}"><a href="/addbalance"><i class="fa fa-circle-o"></i> Balans əlavə et</a></li>
            <li class="{{ Request::is('gallery-control')? 'active': '' }}"><a href="/gallery-control"><i class="fa fa-circle-o"></i> Məhsul şəkili əlavə et</a></li>
            <li class="{{ Request::is('adduser')? 'active': '' }}"><a href="/adduser"><i class="fa fa-circle-o"></i>   İdarəçi əlavə et</a></li>
            @endif
          </ul>
        </li>

        <li class="treeview {{ (Request::is('balance') | Request::is('usersbalance') | Request::is('totalbalances') | Request::is('pay-balance'))? 'active': '' }}">
          <a href="#">
            <i class="fa fa-money"></i> <span>Balans</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('balance')? 'active': '' }}">
              <a href="/balance">
                <i class="fa fa-circle-o"></i> <span>Mənim balansım</span>
                  <b class="label green pull-right">
                    @if($balance = App\Balance::where('user_id',Auth::user()->id)->where('status',0)->count() != 0)
                    <span class="label label-primary pull-right">
                      {{$balance = App\Balance::where('user_id',Auth::user()->id)->where('status',0)->count()}}
                     </span>
                    @else
                    <span class="label label-danger pull-right">
                      Boş
                     </span>
                    @endif
                  </b>
              </a>
            </li>
            @if(Auth::user()->role_id == 3)
            <li class="{{ Request::is('usersbalance')? 'active': '' }}"><a href="/usersbalance"><i class="fa fa-circle-o"></i> Balanslar</a></li>
            <li @if(Request::is('pay-balance')) class="active" @endif><a href="/pay-balance"><i class="fa fa-circle-o"></i> {{__('app.Pay_balance')}}</a></li>
            <li class="{{ Request::is('totalbalances')? 'active': '' }}"><a href="/totalbalances"><i class="fa fa-circle-o"></i> Ümumi balanslar</a></li>
            <li class="{{ Request::is('addbonusbalance')? 'active': '' }}"><a href="/addbonusbalance"><i class="fa fa-circle-o"></i> Balans əlavə et</a></li>
            @endif
          </ul>
        </li>
        <li class="{{ Request::is('statistics')? 'active': '' }}">
          <a href="/statistics">
            <i class="ion ion-stats-bars"></i> <span>Statistika</span>
          </a>
        </li>
        <li class="{{ Request::is('booking')? 'active': '' }}">
          <a href="/booking">
            <i class="fa fa-save"></i> <span>Sifarişlər</span>
             <span class="pull-right-container">
                    @if($booking = App\Booking::where('taken_status','=',0)->count() != 0)
                    <span class="label label-primary pull-right">
                      {{$booking = App\Booking::where('taken_status','=',0)->count()}}
                     </span>
                    @else
                    <span class="label label-danger pull-right">
                      {{__('app.empty')}}
                     </span>
                    @endif
                </span>
              </span>
          </a>
        </li>
        <li class="{{ Request::is('loyal-customers')? 'active': '' }}">
          <a href="/loyal-customers">
            <i class="fa fa-users"></i> <span>{{__('app.Loyal_customers')}}</span>
          </a>
        </li>
        <li class="{{ Request::is('information')? 'active': '' }}">
          <a href="/information">
            <i class="fa fa-info"></i> <span>Əlavə informasiya</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
  @section('body')
  @show
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b> <a href="https://sade.store" target="_blank">Sade Store</a> </b>
    </div>
    <strong> &copy; {{ date('Y')}}
       <a href="https://www.asgro.org" target="_blank">ASGRO</a></strong>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/plugins/jQuery/jquery-2.2.3.min.js"></script>
@section('js')
@show
<script src="/dist/js/demo.js?v={{md5(uniqid())}}"></script>
<script type="text/javascript">
function myFunction(x) {
  if (x.matches) {
    $(".acts").addClass("btn-group-vertical");
    $(".acts").removeClass("btn-group");
  } else {
    $(".acts").removeClass("btn-group-vertical");
    $(".acts").addClass("btn-group");
  }
}
var x = window.matchMedia("(max-width: 1200px)")
myFunction(x);
x.addListener(myFunction);
</script>
</body>
</html>
