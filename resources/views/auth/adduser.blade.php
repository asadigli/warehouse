@extends('master')

@section('body')

<div class="module">
    <div class="module-head">
        <h3>
            Add New User</h3>
    </div>
    <div class="module-body table">
      @if(Session::has('user_added'))
				<center>
					<div class="col-md-4" style="width:90%;">
						<div class="alert alert-success">
							{{Session::get('user_added')}}
						</div>
					</div>
				</center>
			@endif
    <form class="form-horizontal row-fluid"  method="POST" action="/adduser">
        {{ csrf_field() }}

      <div class="control-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label class="control-label" >Name</label>
        <div class="controls">
          <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="name..." class="span8" required>
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
          <input type="text" id="surname" name="surname" value="{{ old('surname') }}" placeholder="surname..." class="span8" required>
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
          <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="email..." class="span8" required>
          @if ($errors->has('email'))
              <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </div>
      </div>
      <div class="control-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label" >Password</label>
        <div class="controls">
          <input type="password" id="password" name="password" placeholder="password..." class="span8" required>
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
          <input type="password" id="password-confirm" name="password_confirmation" placeholder="confirm password..." class="span8" required>

        </div>
      </div>
      <input type="hidden" name="role_id" value="2"><br>
      <div class="control-group">
        <div class="controls">
          <input type="submit" name="submit" value="Add New User" class="btn btn-primary">
        </div>
      </div>
      <br>
    </form>
    </div>
</div>

@endsection
