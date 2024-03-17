@extends('layouts.master')
@section('css')
<title>Gallery</title>
<style media="screen">
.btn:focus, .btn:active, button:focus, button:active {
outline: none !important;
box-shadow: none !important;
}

#image-gallery .modal-footer{
display: block;
}

.thumb{
margin-top: 15px;
margin-bottom: 15px;
}
</style>
@endsection

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Gallery
        <small>more images can be added </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="#">Gallery</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{$pro->product_name}}
              </h3>
            </div>
            <div class="box-body">
              <div class="container">
              <div class="row">
                <div class="row" style="width:90%;">
                  @php
                  $gallery = App\Gallery::where('product_id','=',[$pro->id])->get()
                  @endphp
                  @foreach($gallery as $gall)
                  @php
                  $image1 = substr($gall->image1, strpos($gall->image1, '/uploads'));
                  $image2 = substr($gall->image2, strpos($gall->image2, '/uploads'));
                  $image3 = substr($gall->image3, strpos($gall->image3, '/uploads'));
                  $image4 = substr($gall->image4, strpos($gall->image4, '/uploads'));
                  $image5 = substr($gall->image5, strpos($gall->image5, '/uploads'));
                  $image6 = substr($gall->image6, strpos($gall->image6, '/uploads'));
                  $image7 = substr($gall->image7, strpos($gall->image7, '/uploads'));
                  $image8 = substr($gall->image8, strpos($gall->image8, '/uploads'));
                  $image9 = substr($gall->image9, strpos($gall->image9, '/uploads'));
                  $image10 = substr($gall->image10, strpos($gall->image10, '/uploads'));
                  @endphp
                  @if(!empty($gall->image1))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image1}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image1}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image2))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image2}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image2}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image3))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image3}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image3}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image4))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image4}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image4}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image5))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image5}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image5}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image6))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image6}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image6}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image7))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image7}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image7}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image8))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image8}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image8}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image9))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image9}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image9}}">
                      </a>
                  </div>
                  @endif
                  @if(!empty($gall->image10))
                  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                       data-image="{{$image10}}"
                       data-target="#image-gallery">
                       <img class="img-thumbnail"
                           src="{{$image10}}">
                      </a>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="image-gallery-title"></h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="Height:50%;" >
                                    <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                    </button>

                                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
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
<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<script type="text/javascript">
  let modalId = $('#image-gallery');

$(document)
.ready(function () {

  loadGallery(true, 'a.thumbnail');

  //This function disables buttons when needed
  function disableButtons(counter_max, counter_current) {
    $('#show-previous-image, #show-next-image')
      .show();
    if (counter_max === counter_current) {
      $('#show-next-image')
        .hide();
    } else if (counter_current === 1) {
      $('#show-previous-image')
        .hide();
    }
  }

  /**
   *
   * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
   * @param setClickAttr  Sets the attribute for the click handler.
   */

  function loadGallery(setIDs, setClickAttr) {
    let current_image,
      selector,
      counter = 0;

    $('#show-next-image, #show-previous-image')
      .click(function () {
        if ($(this)
          .attr('id') === 'show-previous-image') {
          current_image--;
        } else {
          current_image++;
        }

        selector = $('[data-image-id="' + current_image + '"]');
        updateGallery(selector);
      });

    function updateGallery(selector) {
      let $sel = selector;
      current_image = $sel.data('image-id');
      $('#image-gallery-title')
        .text($sel.data('title'));
      $('#image-gallery-image')
        .attr('src', $sel.data('image'));
      disableButtons(counter, $sel.data('image-id'));
    }

    if (setIDs == true) {
      $('[data-image-id]')
        .each(function () {
          counter++;
          $(this)
            .attr('data-image-id', counter);
        });
    }
    $(setClickAttr)
      .on('click', function () {
        updateGallery($(this));
      });
  }
});

// build key actions
$(document)
.keydown(function (e) {
  switch (e.which) {
    case 37: // left
      if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
        $('#show-previous-image')
          .click();
      }
      break;

    case 39: // right
      if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
        $('#show-next-image')
          .click();
      }
      break;

    default:
      return; // exit this handler for other keys
  }
  e.preventDefault(); // prevent the default action (scroll / move caret)
});

  </script>
@endsection