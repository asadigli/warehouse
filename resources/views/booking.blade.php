@extends('layouts.master')
@section('css')
<title>Sifarişlər</title>
<link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('body')
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Sifariş siyahısı
        <small>aktiv sifarişlər</small>
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
            <div class="box-header">
              <h3 class="box-title">Sifarişlər -
                <small><a href="/takenbooking">Götürülənlər</a>  | <a href="/addbooking">Sifariş əlavə et</a></small>
              </h3>
              <br>
              @include('layouts.alerts')
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Alıcı</th>
                  <th>Məhsul</th>
                  <th>Əməliyyat</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($booking as $bk)
                    <tr>
                      <td>{{$bk->user_name}}</td>
                      <td>{{$bk->prod_name}}</td>
                      <td>
                      <div class="btn-group">
                        @if(Auth::user()->role_id == 3)
                        <button data-toggle="modal" data-target="#delete{{$bk->id}}" type="button" class="btn btn-danger">Sil</button>
                        @endif
                        <button data-toggle="modal" data-target="#edit{{$bk->id}}" type="button" class="btn btn-success">Dəyiş</button>
                        <button data-toggle="modal" data-target="#more{{$bk->id}}" type="button" class="btn btn-primary">Daha çox</button>
                      </div>
                      </td>
                    </tr>
                    <div class="modal fade" id="delete{{$bk->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Sil</h4>
                          </div>
                          <div class="modal-body">
                            <p>Sifarişi silməkdə əminsinizmi?</p>
                          </div>
                          <div class="modal-footer">
                            <a href="/deletebooking/{{$bk->id}}"  class="btn btn-danger">Bəli</a>
                            <button type="button" class="btn btn-success" data-dismiss="modal">Xeyr</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="edit{{$bk->id}}" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Düzəliş et</h4>
                          </div>
                          <form class="form-group" action="/editbooking/{{$bk->id}}" method="post">
                            {{ csrf_field() }}
                            <div class="modal-body">
                              Alıcı: <br>
                              <input class="form-control" type="text" name="user_name" value="{{$bk->user_name}}" required><br>
                              Əlaqə nömrəsi: <br>
                              <input class="form-control" type="text" name="user_number" value="{{$bk->user_number}}"><br>
                              Ödəniş statusu: <br>
                              <select class="form-control" display="paid_status" name="paid_status" required>
                                <option value="{{$bk->paid_status}}">
                                  @if($bk->paid_status == 0)
                                  Ödənilməyib
                                  @elseif($bk->paid_status == 1)
                                  Ödənib
                                  @endif
                                </option>
                                <option value="0">Ödənilməyib</option>
                                <option value="1">Ödənib</option>
                              </select> <br>
                              Statusu: <br>
                              <select class="form-control" display="block" name="taken_status" required>
                                <option value="{{$bk->taken_status}}" selected>
                                  @if($bk->taken_status == 0)
                                  Götürülməyib
                                  @elseif($bk->taken_status ==1)
                                  Götürülüb
                                  @elseif($bk->taken_status ==2)
                                  <span style="color:red;">Ləğv et</span>
                                  @endif
                                </option>
                                <option value="0">Götürülməyib</option>
                                <option value="1">Götürülüb</option>
                                <option value="2">Ləğv et</option>
                              </select><br>
                              Details: <br>
                              <textarea class="form-control" name="detail"  rows="5">
                                {{$bk->detail}}
                              </textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-success" name="submit">Dəyiş</button>
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
                                    <h4 class="modal-title">Ətraflı məlumat</h4>
                                </div>
                                  <div class="modal-body">
                                      <ul class="list-group">
                                        <li class="list-group-item"><b>ID:</b> {{$bk->id}}</li>
                                        <li class="list-group-item"><b>Alıcı:</b> {{$bk->user_name}}</li>
                                        <li class="list-group-item"><b>Məhsullar: </b>{{$bk->prod_name}}</li>
                                        <li class="list-group-item"><b>Sifariş tarixi: </b>{{$bk->booking_date}}</li>
                                        <li class="list-group-item"><b>Əlaqə nömrəsi: </b>{{$bk->user_number}}</li>
                                        <li class="list-group-item"><b>Məlumatlar:</b> {{$bk->detail}}</li>
                                        <li class="list-group-item"><b>Statusu:</b>
                                          @if($bk->taken_status == 0)
                                          <span style="color:green;">Götürülməyib</span>
                                          @elseif($bk->taken_status == 1)
                                          <span style="color:red;">Götürülüb</span>
                                          @endif
                                        </li>
                                        <li class="list-group-item"><b>Ödəniş statusu:</b>
                                          @if($bk->paid_status == 0)
                                          <span style="color:green;">Ödənilməyib</span>
                                          @elseif($bk->paid_status == 1)
                                          <span style="color:red;">Ödənib</span>
                                          @endif
                                        </li>
                                      </ul>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Bağla</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Alıcı</th>
                  <th>Məhsul</th>
                  <th>Əməliyyat</th>
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/tinymce.js')}}"></script>
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
