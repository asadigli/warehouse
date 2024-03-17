/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($, AdminLTE) {

  "use strict";

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
  ];

  //Create the new tab
  var tab_pane = $("<div />", {
    "id": "control-sidebar-theme-demo-options-tab",
    "class": "tab-pane active"
  });

  //Create the tab button
  var tab_button = $("<li />", {"class": "active"})
      .html("<a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'>"
      + "<i class='fa fa-wrench'></i>"
      + "</a>");

  //Add the tab button to the right sidebar tabs
  $("[href='#control-sidebar-home-tab']")
      .parent()
      .before(tab_button);

  //Create the menu
  var demo_settings = $("<div />");

  //Layout options
  demo_settings.append(
      "<h4 class='control-sidebar-heading'>"
      + "Layout Options"
      + "</h4>"
        //Fixed layout
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='fixed' class='pull-right'/> "
      + "Fixed layout"
      + "</label>"
      + "<p>Activate the fixed layout. You can't use fixed and boxed layouts together</p>"
      + "</div>"
        //Boxed layout
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='layout-boxed'class='pull-right'/> "
      + "Boxed Layout"
      + "</label>"
      + "<p>Activate the boxed layout</p>"
      + "</div>"
        //Sidebar Toggle
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-layout='sidebar-collapse' class='pull-right'/> "
      + "Toggle Sidebar"
      + "</label>"
      + "<p>Toggle the left sidebar's state (open or collapse)</p>"
      + "</div>"
        //Sidebar mini expand on hover toggle
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-enable='expandOnHover' class='pull-right'/> "
      + "Sidebar Expand on Hover"
      + "</label>"
      + "<p>Let the sidebar mini expand on hover</p>"
      + "</div>"
        //Control Sidebar Toggle
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-controlsidebar='control-sidebar-open' class='pull-right'/> "
      + "Toggle Right Sidebar Slide"
      + "</label>"
      + "<p>Toggle between slide over content and push content effects</p>"
      + "</div>"
        //Control Sidebar Skin Toggle
      + "<div class='form-group'>"
      + "<label class='control-sidebar-subheading'>"
      + "<input type='checkbox' data-sidebarskin='toggle' class='pull-right'/> "
      + "Toggle Right Sidebar Skin"
      + "</label>"
      + "<p>Toggle between dark and light skins for the right sidebar</p>"
      + "</div>"
  );
  var skins_list = $("<ul />", {"class": 'list-unstyled clearfix'});

  //Dark sidebar skins
  var skin_blue =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #20AB9F;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Blue</p>");
  skins_list.append(skin_blue);
  var skin_black =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-black' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Black</p>");
  skins_list.append(skin_black);
  var skin_purple =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-purple' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Purple</p>");
  skins_list.append(skin_purple);
  var skin_green =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-green' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Green</p>");
  skins_list.append(skin_green);
  var skin_red =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-red' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Red</p>");
  skins_list.append(skin_red);
  var skin_yellow =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-yellow' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin'>Yellow</p>");
  skins_list.append(skin_yellow);

  //Light sidebar skins
  var skin_blue_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-blue-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #20AB9F;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px'>Blue Light</p>");
  skins_list.append(skin_blue_light);
  var skin_black_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-black-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div style='box-shadow: 0 0 2px rgba(0,0,0,0.1)' class='clearfix'><span style='display:block; width: 20%; float: left; height: 7px; background: #fefefe;'></span><span style='display:block; width: 80%; float: left; height: 7px; background: #fefefe;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px'>Black Light</p>");
  skins_list.append(skin_black_light);
  var skin_purple_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-purple-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-purple-active'></span><span class='bg-purple' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px'>Purple Light</p>");
  skins_list.append(skin_purple_light);
  var skin_green_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-green-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-green-active'></span><span class='bg-green' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px'>Green Light</p>");
  skins_list.append(skin_green_light);
  var skin_red_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-red-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-red-active'></span><span class='bg-red' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px'>Red Light</p>");
  skins_list.append(skin_red_light);
  var skin_yellow_light =
      $("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
          .append("<a href='javascript:void(0);' data-skin='skin-yellow-light' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
          + "<div><span style='display:block; width: 20%; float: left; height: 7px;' class='bg-yellow-active'></span><span class='bg-yellow' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
          + "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #f9fafc;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
          + "</a>"
          + "<p class='text-center no-margin' style='font-size: 12px;'>Yellow Light</p>");
  skins_list.append(skin_yellow_light);

  demo_settings.append("<h4 class='control-sidebar-heading'>Skins</h4>");
  demo_settings.append(skins_list);

  tab_pane.append(demo_settings);
  $("#control-sidebar-home-tab").after(tab_pane);

  setup();

  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function change_layout(cls) {
    $("body").toggleClass(cls);
    AdminLTE.layout.fixSidebar();
    //Fix the problem with right sidebar and layout boxed
    if (cls == "layout-boxed")
      AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
    if ($('body').hasClass('fixed') && cls == 'fixed') {
      AdminLTE.pushMenu.expandOnHover();
      AdminLTE.layout.activate();
    }
    AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
    AdminLTE.controlSidebar._fix($(".control-sidebar"));
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function change_skin(cls) {
    $.each(my_skins, function (i) {
      $("body").removeClass(my_skins[i]);
    });

    $("body").addClass(cls);
    store('skin', cls);
    return false;
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== "undefined") {
      localStorage.setItem(name, val);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin');
    if (tmp && $.inArray(tmp, my_skins))
      change_skin(tmp);

    //Add the change skin listener
    $("[data-skin]").on('click', function (e) {
      if($(this).hasClass('knob'))
        return;
      e.preventDefault();
      change_skin($(this).data('skin'));
    });

    //Add the layout manager
    $("[data-layout]").on('click', function () {
      change_layout($(this).data('layout'));
    });

    $("[data-controlsidebar]").on('click', function () {
      change_layout($(this).data('controlsidebar'));
      var slide = !AdminLTE.options.controlSidebarOptions.slide;
      AdminLTE.options.controlSidebarOptions.slide = slide;
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open');
    });

    $("[data-sidebarskin='toggle']").on('click', function () {
      var sidebar = $(".control-sidebar");
      if (sidebar.hasClass("control-sidebar-dark")) {
        sidebar.removeClass("control-sidebar-dark")
        sidebar.addClass("control-sidebar-light")
      } else {
        sidebar.removeClass("control-sidebar-light")
        sidebar.addClass("control-sidebar-dark")
      }
    });

    $("[data-enable='expandOnHover']").on('click', function () {
      $(this).attr('disabled', true);
      AdminLTE.pushMenu.expandOnHover();
      if (!$('body').hasClass('sidebar-collapse'))
        $("[data-layout='sidebar-collapse']").click();
    });

    // Reset options
    if ($('body').hasClass('fixed')) {
      $("[data-layout='fixed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('layout-boxed')) {
      $("[data-layout='layout-boxed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $("[data-layout='sidebar-collapse']").attr('checked', 'checked');
    }

  }
})(jQuery, $.AdminLTE);


function getproimage(objButton){
  var id = objButton.value;
  if (id != '') {
    const Http = new XMLHttpRequest();
        const url = '/get-pro-image/' + id;
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange=(e)=>{
          document.getElementById("promorepop" + id).innerHTML = Http.responseText;
        }
  }
}
function getdeletepopup(objButton){
  var id = objButton.value;
  if (id != '') {
    const Http = new XMLHttpRequest();
        const url = '/get-delete-popup/' + id;
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange=(e)=>{
          if (Http.responseText != null) {
           document.getElementById("delete" + id).innerHTML = Http.responseText;
          }
        }
  }
}
function geteditpopup(objButton){
  var id = objButton.value;
  if (id != '') {
    const Http = new XMLHttpRequest();
        const url = '/get-edit-popup/' + id;
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange=(e)=>{
          document.getElementById("edit" + id).innerHTML = Http.responseText;
        }
  }
}
// $(document).ready(function(){
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//     if (!document.getElementById("editid")) {}else{
//     var id = document.getElementById("editid").value;
//       $("#postbutton").click(function(){
//           $.ajax({
//              url: '/changeprice/' + id,
//              type: 'POST',
//              data: {_token: CSRF_TOKEN, first_price:$("#first_price").val(),price:$("#price").val(),shipping_quantity:$("#shipping_quantity").val(),quantity:$("#quantity").val()},
//              dataType: 'JSON',
//              success: function (data) {
//                $(".writeinfo").append(data.msg);
//                console.log("success");
//              }
//           });
//       });
//     }
// });
function getproprice(){
  var id = document.getElementById("product_id").value;
  if (id != '') {
    const Http = new XMLHttpRequest();
        const url = '/get-pro-price/' + id;
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange=(e)=>{
          document.getElementById("pro_price").value = Http.responseText;
        }
  }
}
if (!document.getElementById("your-id")){}else{
  var form = document.getElementById("form-id");
  document.getElementById("your-id").addEventListener("click", function () {
    form.submit();
  });
}
function getcustname(){
  var phone = document.getElementById("custnumb").value.replace("+","");
  if (phone != '') {
    const Http = new XMLHttpRequest();
        const url = '/get-customer-name-by-number/' + phone;
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange=(e)=>{
          document.getElementById("custbuyer").value = Http.responseText;
        }
  }
}
$(document).ready(function(){
  $("#mysearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myNav li").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
   });
  });
});
function editpro(id){
      $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      document.getElementById("loading"+id).innerHTML = "<center><img id='loading-image"+id+"' src='https://www.motorcoachjobs.com/Images/LoaderGIF/blue-original-loading-animation-large.gif' style='height:100px;display:none;'></center>"
      $('#loading-image'+id).show();
      $('.modal-body').hide();
      $('.modal-footer').hide();
      jQuery.ajax({
        url: "/changeprice/" + id,
        method: 'POST',
        data: {
          first_price: $('#first_price' + id).val(),
          price: $('#price' + id).val(),
          quantity: $('#quantity' + id).val(),
          shipping_quantity: $('#shipping_quantity' + id).val(),
        },
        error: function(result){
            // if(!$('#word').val()){$('#first_price').css('border','1px solid red');}
            console.log("error");
        },
        success: function(result){
            var q = $('#quantity'+id).val();
            var p = $('#price'+id).val();
            $("#curr" + id).html(p);
            document.getElementById("quant" + id).innerHTML = q;
            $("#edit" + id).modal("toggle");
            document.getElementById("alert").innerHTML = "";
            $("#alert").html("<div class='success-message'>"+result.success+"<a onclick='sbclose()' style='cursor:pointer'>X</a></div>");
        },
        complete: function(){
          $('#loading-image'+id).hide();
          $('.modal-body').show();
          $('.modal-footer').show();
          document.getElementById("loading"+id).innerHTML = "";
        }
      });
}
function sbclose(){
  $("#alert").html("");
}
setInterval(function() {
  sbclose();
}, 1000);
$(".sidebar-toggle").on("click",function(){
  console.log($("body").attr("class"));
  var a = "skin-blue sidebar-mini sidebar-collapse";
  var b = "skin-blue sidebar-mini";
  if ($("body").attr("class") === a) {
    setCookie("menu_type",b,1000);
  }else{
    setCookie("menu_type",a,1000);
  }
});
$(document).ready(function(){
  $("body").attr("class",getCookie("menu_type"));
});
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {document.cookie = name+'=; Max-Age=-99999999;';}
// $(document.body).on("click",".datepicker-days > table > tbody > tr > td",function(){
//   console.log($(this).index());
// });
$("#stat-page > table").html("<thead><tr><th>ID</th><th>Ad</th></tr></thead><tbody id='statsection'></tbody><tfoot><tr><th>ID</th><th>Ad</th></tr></tfoot>");
gen_stat();
$("#stat-page > h3 > a").on("click",function(){
  $("#stat-page > h3").append("<img src='/images/ldng.gif'>");
  var i = $(this).index();
  $(this).addClass("active");
  $("#stat-page > h3 > a:not(:eq("+i+"))").removeClass("active");
  if (i === 0) {
    $("#stat-page > table").html("<thead><tr><th>ID</th><th>Ad</th></tr></thead><tbody id='statsection'></tbody><tfoot><tr><th>ID</th><th>Ad</th></tr></tfoot>");
    gen_stat();
  }else if (i === 1){
    $("#stat-page > table").html("<thead><tr><th>ID</th><th>Məhsul</th><th>Baxış</th></tr></thead><tbody id='pro_statsection'></tbody><tfoot><tr><th>ID</th><th>Məhsul</th><th>Baxış</th></tr></tfoot>");
    get_pro_stat();
  }else{
    $("#stat-page > table").html("<thead><tr><th>ID</th><th>Rəy</th></tr></thead><tbody id='comments_section'></tbody><tfoot><tr><th>ID</th><th>Rəy</th></tr></tfoot>");
    get_comm_stat();
  }
});
function gen_stat(){
  $.ajax({url: "/getstat_ss",method: "GET",success:function(data){$("img[src='/images/ldng.gif']").remove();
        $("#statsection").html("<tr class='odd gradeX'><td>Sade Store-da məhsullar </td><td>"+data[0]["pro_count"]+"</td></tr><tr class='even gradeX'><td>İstifadəçi sayı </td><td>"+data[0]["user_count"]+"</td></tr><tr class='odd gradeX'><td>İstək qutusu say </td><td>"+data[0]["wishlist"]+"</td></tr><tr class='even gradeX'><td>Abunəlik sayı </td><td>"+data[0]["subscription"]+"</td></tr><tr class='odd gradeX'><td>Rəy sayı </td><td>"+data[0]["comments"]+"</td></tr>");}});
}
function get_pro_stat(){
  $.ajax({
      url: "/getstat_ss",
      method: "GET",
      data: {type:"prods"},
      success:function(data){
        var html = "";
        for (var i = 0; i < data.length; i++) {
          html += "<tr class='odd gradeX'><td><a href='https://sade.store/product-details/"+data[i]["slug"]+"' target='_blank'>"+data[i]["main_id"]+"</a></td><td><a href='https://sade.store/product-details/"+data[i]["slug"]+"' target='_blank'>"+data[i]["product_name"]+"</a></td><td>"+data[i]["view"]+"</td></tr>";
        }
        $("#pro_statsection").html(html);
        $("img[src='/images/ldng.gif']").remove();
      }
  });
}
function get_comm_stat(){
  $.ajax({
      url: "/getstat_ss",
      method: "GET",
      data: {type:"comments"},
      success:function(data){
        var html = "";
        for (var i = 0; i < data.length; i++) {
          html += "<tr class='odd gradeX'><td>"+data[i]["id"]+"</td><td><a href='https://sade.store/p/"+data[i]["product"]+"' target='_blank'>"+data[i]["body"]+"</a></td></tr>";
        }
        $("#comments_section").html(html);
        $("img[src='/images/ldng.gif']").remove();
      }
  });
}
$(document).ready(function(){
  var usc = 0;var t = "head > title";var t_text = $(t).text();let ncs = ".not-confirmed-sales";
  function getc(t){
    $.ajax({url: "/get-count-list",method: "GET",data: {type:t},
        success:function(r){usc = r.data;},error:function(r){usc = 0;}});}
  setInterval(function(){getc(1);},10000);getc(1);
  setInterval(function(){
    if ($(".not-confirmed-sales").length > 0) {
      let list = [t_text,usc,$(ncs).data("name")];
      if (list[1] > 0) {
        $(ncs).addClass("label label-danger").html(list[1]);
          if ($(t).text() === list[0]) {$(t).html("("+list[1]+") " + list[2]);
          }else{$(t).html(t_text);}
      }else{
        $(ncs).removeClass("label label-danger").html("");$(t).html(t_text);
      }
    }
  },2000);
});
function validate_id(){
  var bc = "border-color";var bs = "box-shadow";
  if ($("#valid").val().length < 7 || $("#valid").val().length > 11) {
    $("#valid").css(bc,"red").css(bs,"0px 0px 6px 0px rgba(255,0,0,0.5)");
  }else{
    $("#valid").css(bc,"#19bfb1").css(bs,"");
    $.ajax({
      url: "/check-pro-id-availablity",
      method: "GET",
      data: {pid:$("#valid").val()},
      success:function(r){
        if (r.status == 1) {
          $("#valid").css(bc,"#19bfb1").css(bs,"");
        }else{
          $("#valid").css(bc,"red").css(bs,"0px 0px 6px 0px rgba(255,0,0,0.5)");
        }
      }
    });
  }
}
