@extends('layouts.master')
@section('css')
<title>Add Employee</title>
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Add New Employee
        <small> adding new employee</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="/adduser">Add Employee</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-default">
              <div class="box-header with-border">
                <h3 class="box-title">Add Employee -
                  <small><a href="/users">User List</a></small>
                </h3>
                @include('layouts.alerts')
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <form class="form-horizontal row-fluid"  method="POST" action="/adduser">
                          {{ csrf_field() }}
                        <div class="control-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label class="control-label" >Name</label>
                          <div class="controls">
                            <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="name..." required>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                          <label class="control-label" >Surname</label>
                          <div class="controls">
                            <input class="form-control" type="text" id="surname" name="surname" value="{{ old('surname') }}" placeholder="surname..." required>
                            @if ($errors->has('surname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label class="control-label" >Email</label>
                          <div class="controls">
                            <input class="form-control" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email..." required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                          <label class="control-label" >Role</label>
                          <div class="controls">
                            <select class="form-control" name="role_id" id="role_id">
                              <option value="1">Simple User</option>
                              <option value="2">Admin</option>
                              <option value="3">Main Admin</option>
                            </select>
                            @if ($errors->has('role_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label class="control-label" >Password</label>
                          <div class="controls">
                            <input class="form-control" type="password" id="password" name="password" placeholder="password..." required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label" >Confirm Password</label>
                          <div class="controls">
                            <input class="form-control" type="password" id="password-confirm" name="password_confirmation" placeholder="confirm password..." required>
                          </div>
                        </div>
                        <br>
                        <div class="control-group">
                          <div class="controls">
                            <input type="submit" name="submit" value="Add New User" class="btn btn-primary pull-right">
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
  <script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
  <script src="{{ asset('dist/js/app.min.js')}}"></script>
@endsection