<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdverController extends Controller
{
    public function joblist(){
      return view('welcome');
    }
    public function adverhome(){
      return view('adver.home');
    }
    public function list(){
      return view('adver.list');
    }
    public function businessprofile(){
      return view('adver.businessprofile');
    }
    public function businessprofiles(){
      return view('adver.businessprofilelist');
    }
}
