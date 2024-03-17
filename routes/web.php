<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/testing','DataController@testing')->middleware('mainadmin');
Route::get('/get-monthly-stat','Controller@get_monthly_stat');
Route::get('/get-count-list','UserController@count_list');
Route::get('/check-pro-id-availablity','DataController@checkava');

Route::get('/all-codes/{type}', 'Controller@allcodes')->middleware('admin');

Route::get('/statistics','DataController@statistics');
Route::get('/getstat_ss','DataController@getstat_ss');
Route::get('/add-comment','HomeController@addcommentpage')->middleware('admin');
Route::post('/add-new-comment','HomeController@addcomment')->middleware('admin');

Route::get('/ok','Controller@getdt')->middleware('mainadmin');
Route::get('/check/{token}','HomeController@getcheckdetails')->middleware('admin');
Route::get('/return-sale/{token}','HomeController@getcheckdetails')->middleware('admin');
Route::get('/get-pro-image/{id?}','Controller@getdataforpopup')->middleware('admin');
Route::get('/get-edit-popup/{id?}','Controller@editpopup')->middleware('admin');
Route::get('/get-pro-price/{id?}','Controller@getproprice')->middleware('admin');
Route::get('/get-delete-popup/{id?}','Controller@getdeletepopup')->middleware('mainadmin');
Route::post('/return/sale/{token}', 'Controller@returnsale')->middleware('admin');
Route::post('/confirm/return/{id}','Controller@confirmreturn')->middleware('admin');

Route::get('/get-customer-name-by-number/{phone?}','UserController@getcustnamebyphone')->middleware('admin');


Route::get('/home', 'Controller@redirect')->name('main');
Route::get('/welcome', 'AdverController@joblist')->middleware('mainadmin');
Route::get('/', 'UserController@mainpage')->middleware('admin');

Route::get('/add-sold-product','UserController@soldproducts')->middleware('admin');
Route::post('/add-new-sale','UserController@productsold')->middleware('admin');
Route::get('/sold-product-list/{day?}/{month?}/{year?}','UserController@soldprolist')->middleware('admin')->name('spl');
Route::post('/search-sold-products','UserController@soldpro_filter')->middleware('admin');
Route::post('/confirm-sale/{token}','UserController@confirmsale')->middleware('mainadmin');
Route::get('/edit-sale/{token}','UserController@editsale')->middleware('admin');
Route::post('/editsale/{token}','UserController@toeditsale')->middleware('admin');
Route::get('/delete-sale/{token}','UserController@deletesale')->middleware('admin');

Route::get('/loyal-customers','DataController@customers')->middleware('admin');
Route::get('/check-creation','DataController@checkcreation')->middleware('admin');
Route::post('/add-check','DataController@addcheck')->middleware('admin');

Route::get('/list/{id}', 'Controller@productlist')->middleware('admin')->name('list');
Route::get('/allproducts', 'Controller@allprods')->middleware('admin')->name('allprods');
Route::get('/onthewaylist', 'Controller@onthewaylist')->middleware('admin');
Route::get('/finishedproducts', 'Controller@finishedproducts')->name('finishedproducts')->middleware('admin');
Route::get('/gallery/{id}', 'DataController@gallery')->middleware('admin');
Route::get('/gallery-control', 'DataController@gallerycontrol')->middleware('mainadmin');
Route::post('/addgallery', 'DataController@addgallery')->middleware('mainadmin');

Route::get('/error-404', function(){
    return view('pages.errors.404');
})->name('error404')->middleware('admin');
Route::get('/error-500', function(){
    return view('pages.errors.500');
})->name('error500')->middleware('admin');

Route::get('/addproduct', 'Controller@addproductpage')->middleware('admin');
Route::get('/deleteproduct/{id}', 'UserController@deleteproduct')->middleware('admin');
Route::get('/deletecategory/{id}', 'UserController@deletecategory')->middleware('mainadmin');
Route::get('/addcategory', 'Controller@addcategorypage')->middleware('mainadmin');


Route::get('/balance', 'Controller@showbalance')->middleware('admin');
Route::get('/usersbalance', 'Controller@usersbalance')->middleware('mainadmin');
Route::get('/usersbalance/user={id}', 'Controller@userbalance')->middleware('mainadmin');
Route::get('/paid-amounts', 'Controller@paid_amounts')->middleware('mainadmin');
Route::get('/totalbalances', 'Controller@totalbalances')->middleware('mainadmin');
// Route::get('/oldbalance', 'Controller@oldbalance')->middleware('admin');
Route::get('/addbalance', 'Controller@addbalancepage')->middleware('mainadmin');
Route::get('/allbalances', 'Controller@showallbalances')->middleware('mainadmin');
Route::get('/unpaidbalances', 'Controller@unpaidbalances')->middleware('mainadmin');
Route::get('/addbonusbalance', 'Controller@addbonusbalance')->middleware('mainadmin');
Route::get('/pay-balance', 'Controller@addbonusbalance')->middleware('mainadmin');
Route::post('/pay-balance-now','Controller@paybalance')->middleware('mainadmin');

Route::get('/users','UserController@getusers')->middleware('mainadmin');
Route::get('/deleteuser/{id}', 'UserController@deleteuser')->middleware('mainadmin');
Route::get('/deletebalance/{id}', 'Controller@deletebalance')->middleware('mainadmin');
Route::post('/assignuser/{id}','UserController@assignuser')->middleware('mainadmin');
Route::post('/addbalance', 'UserController@addbalance')->middleware('mainadmin');
Route::post('/changebalance/{id}', 'UserController@changebalance')->middleware('mainadmin');
Route::post('/addcat', 'UserController@addcat')->middleware('mainadmin');
Route::post('/addproduct', 'UserController@addproduct')->middleware('admin');
Route::post('/changeprice/{id}', 'UserController@changeprice')->middleware('admin');
Route::post('changeprofilesettings/{id}', 'HomeController@changeprofilesettings')->middleware('auth');
Route::get('/booking', 'BookingController@showbookings')->middleware('admin');
Route::get('/takenbooking', 'BookingController@takenbookings')->middleware('admin');
Route::get('/addbooking', 'BookingController@addbooking')->middleware('admin');
Route::post('addbooking', 'BookingController@addbk')->middleware('admin');
Route::get('/deletebooking/{id}', 'BookingController@deletebooking')->middleware('admin');
Route::post('/editbooking/{id}','BookingController@editbooking')->middleware('admin');
Route::get('/producteditpage/{id}','Controller@producteditpage')->middleware('admin');
Route::post('/changeproductsettings/{id}', 'Controller@changeproductsettings')->middleware('admin');
Route::get('/profile', 'HomeController@index')->name('home');

Route::get('/adduser', 'HomeController@adduser')->middleware('mainadmin');
Route::post('/adduser', 'HomeController@toadduser')->middleware('mainadmin');

// Route::get('inbox', 'MessageController@inbox')->middleware('mainadmin');
// Route::get('inbox_sent', 'MessageController@sentbox')->middleware('mainadmin');
// Route::post('/addItem', 'MessageController@addItem');

Route::get('information', 'MessageController@information')->middleware('admin');
Route::get('/deleteinfo/{id}', 'MessageController@deleteinfo')->middleware('mainadmin');
Route::post('adddetail','MessageController@adddetail');


// adver tables
// Route::get('adverhome', 'AdverController@adverhome')->middleware('mainadmin');
// Route::get('adverlist', 'AdverController@list')->middleware('mainadmin');
// Route::get('businessprofile', 'AdverController@businessprofile')->middleware('mainadmin');
// Route::get('businessprofiles', 'AdverController@businessprofiles')->middleware('mainadmin');
// Register URL
Route::get('auth/login',function(){
    return redirect('login');
});
Route::post('/changepassword/{id}', 'UserController@changepassword')->middleware('admin');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
