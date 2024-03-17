@extends('new.master')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        500 Error Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">500</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-red">500</h2>

        <div class="error-content">
          <br>
          <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>

          <p>Error occured. Please inform Admin about the problem. <a href="/home">Go back to Home</a> </p>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/select2/select2.full.min.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
  <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="plugins/iCheck/icheck.min.js"></script>
  <script src="plugins/fastclick/fastclick.js"></script>
  <script src="dist/js/app.min.js"></script>
  <script src="dist/js/demo.js"></script>
@endsection
