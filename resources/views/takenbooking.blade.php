@extends('layouts.master')
@section('css')
<title>Təhvil verilmiş sifarişlər</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Sifariş siyahısı
        <small> taken booking list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Taken Booking List</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Taken Booking -
                <small><a href="/booking">Not Taken</a>  | <a href="/addbooking">Add booking</a></small>
              </h3>
              <br>
              @include('layouts.alerts')
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Buyer</th>
                  <th>Product</th>
                  <th>#</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($booking as $bk)
                    <tr>
                      <td>{{$bk->user_name}}</td>
                      <td>{{$bk->prod_name}}</td>

                      <td>
                        <a data-toggle="modal" data-target="#more{{$bk->id}}" class="btn btn-primary">More</a>
                        <a data-toggle="modal" data-target="#edit{{$bk->id}}" class="btn btn-success">Change</a>
                        <a data-toggle="modal" data-target="#delete{{$bk->id}}" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>

                    <div class="modal fade" id="delete{{$bk->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete</h4>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure to delete the product?</p>
                          </div>
                          <div class="modal-footer">
                            <a href="/deletebooking/{{$bk->id}}"  class="btn btn-danger">Yes</a>
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="edit{{$bk->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Edit</h4>
                          </div>
                          <form class="form-group" action="/editbooking/{{$bk->id}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                              Buyer: <br>
                              <input class="form-control" type="text" name="user_name" value="{{$bk->user_name}}" required><br>
                              Buyer phone number: <br>
                              <input class="form-control" type="text" name="user_number" value="{{$bk->user_number}}"><br>
                              Payment status: <br>
                              <select class="form-control" display="paid_status" name="paid_status" required>
                                <option value="{{$bk->paid_status}}">
                                  @if($bk->paid_status == 0)
                                  Unpaid
                                  @elseif($bk->paid_status == 1)
                                  Paid
                                  @endif
                                </option>
                                <option value="0">Unpaid</option>
                                <option value="1">Paid</option>
                              </select> <br>
                              Taken status: <br>
                              <select class="form-control" display="block" name="taken_status" required>
                                <option value="{{$bk->taken_status}}" selected>
                                  @if($bk->taken_status == 0)
                                  Not Taken
                                  @elseif($bk->taken_status ==1)
                                  Taken
                                  @endif
                                </option>
                                <option value="0">Not Taken</option>
                                <option value="1">Taken</option>
                              </select><br>
                              Details: <br>
                              <textarea class="form-control" name="detail"  rows="5" placeholder="Add details here..." required>
                                {{$bk->detail}}
                              </textarea>

                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success" name="submit">Change</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                            <div class="modal fade" id="more{{$bk->id}}" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Details</h4>
                                  </div>
                                  <div class="modal-body">
                                      <ul class="form-group">
                                        <li class="list-group-item"><b>Booking ID:</b> {{$bk->id}}</li>
                                        <li class="list-group-item"><b>Buyer:</b> {{$bk->user_name}}</li>
                                        <li class="list-group-item"><b>Product: </b>{{$bk->prod_name}}</li>
                                        <li class="list-group-item"><b>Booking Date: </b>{{$bk->booking_date}}</li>
                                        <li class="list-group-item"><b>Contact number: </b>{{$bk->user_number}}</li>
                                        <li class="list-group-item"><b>Details:</b> {{$bk->detail}}</li>
                                        <li class="list-group-item"><b>Taken Status:</b>
                                          @if($bk->taken_status == 0)
                                          <span style="color:red;">Not Taken</span>
                                          @elseif($bk->taken_status == 1)
                                          <span style="color:green;">Taken</span>
                                          @elseif($bk->taken_status == 2)
                                          <span style="color:red;">Canceled</span>
                                          @endif
                                        </li>
                                        <li class="list-group-item"><b>Payment Status:</b>
                                          @if($bk->paid_status == 0)
                                          <span style="color:red;">Unpaid</span>
                                          @elseif($bk->paid_status == 1)
                                          <span style="color:green;">Paid</span>
                                          @endif
                                        </li>
                                      </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Buyer</th>
                  <th>Product</th>
                  <th>#</th>
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
@endsection