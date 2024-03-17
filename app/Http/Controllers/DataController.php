<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use App\Gallery;
use App\Products;
use App\Soldpro;
use App\Check;
use Lang;
use Crypt;
class DataController extends Controller
{
    public function checkava(Request $req){
      $pro = Products::where('product_id',$req->pid)->first();
      if (empty($pro)) {
        return response()->json(['status' => 1]);
      }else{
        return response()->json(['status' => 0]);
      }
    }
    public function gallery($id){
      $pro = Products::find($id);
      return view('pages.gallery',['pro' => $pro]);
    }
    public function getstat_ss(Request $req){
      $data = curl_init();
      curl_setopt_array($data, array(
        CURLOPT_URL => "https://sade.store/api/get-data-statistics",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"token\":\"".md5(date("d-M-Y")."999").md5(date("Y-m-d")."111")."\"}",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json",
          "content-type: application/json"
        ),
      ));
      $res = curl_exec($data);
      $result = json_decode($res,true);
      $err3 = curl_error($data);
      curl_close($data);
      if ($err3) {
        echo $err3;
      } else {
        $comments = [];
        for ($i=0; $i < count($result[7]); $i++) {
          $comments[] = ["id" => $result[7][$i]["id"],"body" => $result[7][$i]["body"],"product" => $result[7][$i]["product"]];}
        $array[] = [
          "pro_count" => $result[0],
          "user_count" => $result[1],
          "wishlist" => $result[2],
          "subscription" => $result[3],
          "comments" => $result[4],
          "pro_views" => $result[5],
          "post_count" => $result[6],
        ];
        if ($req->type == "comments") {
          return $comments;
        }else if($req->type == "prods"){
          return $result[8];
        }else{
          return $array;
        }
      }
    }
    public function statistics(){
      return view("statistics");
    }
    public function checkcreation(){
      return view('pages.addcheck');
    }
    public function addcheck(Request $req){
      $this->validate($req,['check_id'=> 'unique:check',]);
      $ch = new Check;
      $ch->check_id = $req->check_id;
      $ch->amount = $req->amount;
      $ch->pay_date = $req->pay_date;
      $ch->token = md5(microtime());
      $ch->comment = $req->comment;
      $ch->save();
      return redirect()->back()->with('success',Lang::get('app.Check_added'));
    }
    public function customers(){
      $sps = Soldpro::where('verified',1)->distinct()->get(['contact_number']);
      return view('pages.customers',compact('sps'));
    }
    public function gallerycontrol(){
      return view('pages.gallerycontrol');
    }
    public function addgallery(Request $request){
      $gallery = new Gallery;
      $gallery->product_id = $request->product_id;
      $imgArr=[];
      foreach ($request->pictures as $picture) {
        $ext=$picture->getClientOriginalExtension();
        if($ext=='jpg' || $ext=='png' || $ext=='jpeg' || $ext=='bmp')  {
            $filename=time()+random_int(1, 10000000).'.'.$picture->getClientOriginalExtension();
            $picture->move(public_path('/uploads/gallery/'),$filename);
            $path=public_path('/uploads/gallery/').$filename;
            array_push($imgArr,$path);
        }
      }
      // for ($i=1; $i < count($imgArr); $i++) {
      //   if($i == 10){
      //     $gallery->image1=$imgArr[0];
      //     $gallery->image2=$imgArr[1];
      //     $gallery->image3=$imgArr[2];
      //     $gallery->image4=$imgArr[3];
      //     $gallery->image5=$imgArr[4];
      //     $gallery->image6=$imgArr[5];
      //     $gallery->image7=$imgArr[6];
      //     $gallery->image8=$imgArr[7];
      //     $gallery->image9=$imgArr[8];
      //     $gallery->image10=$imgArr[9];
      //   }
      // }
      for ($i=0; $i < count($imgArr); $i++) {
        $gallery->image1=$imgArr[$i];
      }
      $gallery->save();
      return Redirect()->back()->with('success',Lang::get('app.Image_added'));

    }

    //testing starting here

    public function testing(){
      $this->test_glob();

    }
}
