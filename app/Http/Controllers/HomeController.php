<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Exception;
use App\Soldpro;
use App\Cmt;
use Lang;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }
    public function getcheckdetails($token){
      $sp = Soldpro::where('token',$token)->first();
      return view('pages.check',compact('sp'));
    }
    public function addcommentpage(){
      return view('pages.addcheck');
    }
    public function addcomment(Request $req){
      $cmt = new Cmt;
      $cmt->cust_phone = $req->customer;
      $cmt->date = $req->issue_date;
      $cmt->comment = $req->comment;
      $cmt->save();
      return redirect()->back()->with('success',Lang::get('app.Comment_added'));
    }
    public function changeprofilesettings(Request $req, $id){
      $user = User::find($id);
      // $user->username = $req->username;
      $user->surname = $req->surname;
      $user->email = $req->email;
      $user->name = $req->name;
      if($req->hasFile('user_image')){
        $user_image = $req->file('user_image');
        $filename = time() . '.' . $user_image->getClientOriginalExtension();
        Image::make($user_image)->resize(500, 500)->save(public_path('/uploads/profilephotos/' . $filename));
        $user->user_image = $filename;
      }
      $user->update();
      return Redirect()->back()->with('primary',Lang::get('app.Profile_updated'));
    }
    public function adduser(){
      return view('adduser');
    }
    public function toadduser(Request $req){
      $user = new User;
      $user->name = $req->name;
      $user->surname = $req->surname;
      $user->role_id = $req->role_id;
      $user->email = $req->email;
      $user->password = bcrypt($req->password);
      $user->save();
      return Redirect()->back()->with('success',Lang::get('app.User_added'));
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'role_id' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
