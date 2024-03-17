@extends('layouts.master')
@section('css')
<title>{{Auth::user()->name}}</title>
@endsection
@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>{{trans('app.someones_profile',['name' => Auth::user()->name])}}  </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> {{__('app.Home')}}</a></li>
      <li class=""> <i class="fa fa-user"></i> {{__('app.Profile')}}</li>
      <li class="active"> {{Auth::user()->name}}</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="/uploads/profilephotos/{{Auth::user()->user_image}}" alt="{{Auth::user()->name}}">
            <h3 class="profile-username text-center" style="text-transform:capitalize;">{{Auth::user()->name}} {{Auth::user()->surname}}</h3>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Permission</b> <a class="pull-right">
                @if(Auth::user()->role_id == 3) Main Admin @elseif(Auth::user()->role_id == 2) Admin @else User @endif
              </a>
              </li>
              <li class="list-group-item">
                <b>{{__('app.My_IP')}}</b> <a class="pull-right">
                {{Request::ip()}}
              </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">{{__('app.Settings')}}</a></li>
            <li><a href="#password" data-toggle="tab">{{__('app.Change_password')}}</a></li> 
          </ul>
          <div class="tab-content">
            @include('layouts.alerts')
            <div class="active tab-pane" id="settings">
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/changeprofilesettings/{{Auth::user()->id}}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">{{__('app.Name')}}</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputSurname" class="col-sm-2 control-label">{{__('app.Surname')}}</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="surname" value="{{Auth::user()->surname}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">{{__('app.Email')}}</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">{{__('app.Profile_photo')}}</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="user_image" value="{{Auth::user()->user_image}}" placeholder="Type something here...">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">{{__('app.Change')}}</button>
                  </div>
                </div>
              </form>
            </div>
            <!--pass reset section-->
            <div class="tab-pane" id="password">
              <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="/changepassword/{{Auth::user()->id}}">
                {{ csrf_field() }}
                <br>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">{{__('app.New_password')}}</label>

                  <div class="col-sm-10">
                    <input id="mypass" type="password" minlength="6" class="form-control" name="password" placeholder="New password here..." required>
                    <br>
                    <input type="checkbox" onclick="myFunction()"> {{__('app.Show_password')}}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary pull-right">{{__('app.Change')}}</button>
                  </div>
                </div>
              </form>
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
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/plugins/fastclick/fastclick.js"></script>
<script src="/dist/js/app.min.js"></script>
<script>
    function myFunction() {
    var x = document.getElementById("mypass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
@endsection
