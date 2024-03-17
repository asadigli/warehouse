@extends('layouts.master')
@section('css')
<title>Employee List</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Employee List
      <small>employee list</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">User List</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          @include('layouts.alerts')
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>ID</th>
                <th>Name Surname</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @php
                $user = App\User::all()
                @endphp
                @foreach($user as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td style="text-transform:capitalize;">{{$user->name}} {{$user->surname}}</td>
                    <td>
                        @if($user->isOnline())
                            <span style="color:green"> online</span>
                        @else
                            <span style="color:red"> offline</span>
                        @endif
                    </td>
                    <td>
                    @if($user->id == [Auth::user()->id])
                    it is you!
                    @else
                    <div class="btn-group">
                      <button data-toggle="modal" data-target="#more{{$user->id}}" class="btn btn-success">More</button>
                      <button data-toggle="modal" data-target="#delete{{$user->id}}"  class="btn btn-danger">Delete</button>
                      <button data-toggle="modal" data-target="#assign{{$user->id}}"  class="btn btn-primary">Assign</button>
                    </div>
                    @endif
                    </td>
                  </tr>
                  <!-- user delete popup start -->
                  <div class="modal fade" id="delete{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Assign</h4>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure to <b style="text-transform:uppercase;">{{$user->name}} {{$user->surname}}</b>?</p>
                          <br>
                        </div>
                        <div class="modal-footer">
                          <a href="/deleteuser/{{$user->id}}" class="btn btn-danger">Yes</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- user deletion popup ends -->
                  <div class="modal fade" id="assign{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Assign</h4>
                        </div>
                        <form class="" action="/assignuser/{{$user->id}}" method="post">
                          {{ csrf_field() }}
                          <div class="modal-body">
                            <p>User: {{$user->name}} {{$user->surname}}</b></p>
                            <br>
                            <select class="form-control" name="role_id">
                              @if($user->role_id == 1)
                              <option value="" selected disabled>Simple User</option>
                              @elseif($user->role_id == 2)
                              <option value="" selected disabled>Admin</option>
                              @elseif($user->role_id == 3)
                              <option value="" selected disabled>Main Admin</option>
                              @endif
                              <option value="1">Simple User</option>
                              <option value="2">Admin</option>
                              <option value="3">Main Admin</option>
                            </select>
                          </div>
                          <div class="modal-footer">
                              <button type="submit" name="submit" class="btn btn-success">Assign</button>
                              <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">No</button> -->
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="more{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Details</h4>
                        </div>
                        <div class="modal-body">
                              <img class="profile-user-img img-circle" src="/uploads/profilephotos/{{$user->user_image}}" alt="User profile picture">
                              <br><br>
                              <ul class="list-group">
                                  <li class="list-group-item"><b>User ID:</b> {{$user->id}}</li>
                                  <li class="list-group-item"><b>Name:</b> {{$user->name}}</li>
                                  <li class="list-group-item"><b>Surname: </b>{{$user->surname}}</li>
                                  <li class="list-group-item"><b>Email: </b>{{$user->email}}</li>
                                  <li class="list-group-item"><b>Role: </b>
                                    @if($user->role_id == 1)
                                    <span style="color:red;">Simple User</span>
                                    @elseif($user->role_id == 2)
                                    <span style="color:red;">Admin</span>
                                    @elseif($user->role_id == 3)
                                    <span style="color:red;">Main Admin</span>
                                    @endif
                                  </li>
                              </ul>
                        </div>
                        <div class="modal-footer">
                          <button data-toggle="modal" data-dismiss="modal" data-target="#reset{{$user->id}}" class="btn btn-success">Reset User Password</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end here -->
                  <!--reset pass-->
                   <div class="modal fade" id="reset{{$user->id}}" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Reset User Password</h4>
                        </div>
                        <form class="" action="/changepassword/{{$user->id}}" method="post">
                          {{ csrf_field() }}
                          <div class="modal-body">
                            <p>User: {{$user->name}} {{$user->surname}}</b></p>
                            
                            <label for="password"> New Password</label><br>
                            <input id="userpass" type="password" minlength="6" class="form-control" name="password" placeholder="New password here..." required>
                            <input type="checkbox" onclick="myFunction()"> Show Password
                            <br>
                            
                          </div>
                          <div class="modal-footer">
                              <button type="submit" name="submit" class="btn btn-success">Change</button>
                               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> 
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>ID</th>
                <th>Name Surname</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@section('js')
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
    function myFunction() {
    var x = document.getElementById("userpass");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
@endsection