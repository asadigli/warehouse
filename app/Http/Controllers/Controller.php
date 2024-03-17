<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Balance;
use Auth;
use DB;
use App\Products;
use Image;
use App\Category;
use App\User;
use GuzzleHttp\Client;
use App\Payment;
use App\Soldpro;
use App\Gallery;
use App\Returnback;
use Lang;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test_glob(){
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

      // Encrypt the string `Hello, Universe`
      $encrypted = $encrypter->encrypt('caaaan');
      echo $encrypted;
    }

    public function addcategorypage(){return view('addcategory');}

    public function get_monthly_stat(){
      $stats = DB::select("SELECT
                              DATE_FORMAT(created_at, '%Y-%m') AS m, created_at as date,
                              SUM(sold_price*quantity) AS p
                          FROM
                              soldpro
                          WHERE
                              verified = 1 AND DATE_FORMAT(created_at, '%Y-%m') BETWEEN '2019-02' AND '".date("Y-m")."'
                          GROUP BY
                              m ORDER BY date DESC");
      $res1 = DB::select("SELECT SUM(sold_price) FROM soldpro GROUP BY DATE_FORMAT(created_at, '%Y-%m')");
      // print_r(json_encode($stats));
      return $stats;
    }
    public function getmyprods(Request $req){
      $mypros = [];
      $pros = Soldpro::where('verified',1)->get();
      foreach ($pros as $key => $pro) {
        if ($req->token == md5($pro->contact_number.date("d-M-Y"))) {
          $mypros[] = [
            'id' => $pro->invoice_id,
            'number' => $pro->contact_number,
            'date' => $pro->date->format('d-m-Y H:i:s'),
            'quantity' => $pro->quantity,
            'real_price' => $pro->first_price,
            'sold_price' => $pro->sold_price,
            'product_id' => $pro->product_id,
            'ss_point' => $pro->ss_point,
            'buyer_name' => $pro->buyer
          ];
        }
      }
      print_r(json_encode($mypros));
    }
    public function returnsale(Request $req,$token){
      $sp = Soldpro::where('token', $token)->first();
      $reb = new Returnback;
      $reb->number = $req->c_number;
      $reb->quantity = $req->q_return;
      $reb->return_price = $req->price_return;
      $reb->sale_id = $sp->id;
      $reb->return_date = $req->return_date;
      $reb->availability = $req->availability;
      $reb->status = 0;
      $reb->reason = $req->reason;
      $reb->save();
      return redirect()->back()->with('success','Əlavə edildi');
    }
    public function confirmreturn(Request $req, $id){
      $sp = Soldpro::find($id);
      $rets = Returnback::where('sale_id',$sp->id)->get();
      foreach ($rets as $key => $ret) {
        $ret = Returnback::find($ret->id);
        $ret->status = 1;
        $ret->update();
        if ($ret->availability == 'useful') {
          $pro = Products::where('product_id',$sp->product_id)->first();
          if (!empty($pro)) {
            $pro->quantity += $ret->quantity;
            $pro->update();
          }
        }
        $py = new Payment;
        $py->amount = $sp->sold_price - $sp->first_price;
        $py->token = md5(microtime());
        $py->user_id = $sp->seller;
        $py->pay_date = date('Y-m-d H:i:s');
        $py->save();
      }
      $sp->verified = 2;
      $sp->update();
      return redirect()->back()->with('success','Təsdiqləndi!');
    }
    public function editpopup($id = null){
      if ($id != null) {
        $prod = Products::find($id);
        $loop = "";
        for ($i=0; $i < 50; $i++) {
          if ($prod->quantity == $i) {
            $loop .= "<option value=".$i." selected>".$i."</option>";
          }else{
            $loop .= "<option value=".$i.">".$i."</option>";
          }
        }
        $loop2 = "";
        for ($i=0; $i < 50; $i++) {
          if ($prod->shipping_quantity == $i) {
            $loop2 .= "<option value=".$i." selected>".$i."</option>";
          }else{
            $loop2 .= "<option value=".$i.">".$i."</option>";
          }
        }
        echo "<div class='modal-dialog'><div class='modal-content'><div class='modal-header'> <button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>".Lang::get('app.Edit')."</h4></div><span id='loading".$id."'></span><div class='modal-body'>".Lang::get('app.First_price')."<br><input class='form-control' type='number' id='first_price".$id."' value='".$prod->first_price."' step='0.01' required><br>".Lang::get('app.Price')."<br><input class='form-control'  type='number' id='price".$id."' value='".$prod->price."' step='0.01' required><br>".Lang::get('app.Quantity')." <br><div class='form-group'><select class='form-control' display='block' id='quantity".$id."' required>".$loop."</select></div> ".Lang::get('app.Quantity_on_the_way')."<br><select class='form-control' display='block' id='shipping_quantity".$id."' required>".$loop2."</select></div><div class='modal-footer'><a class='btn btn-primary' href='/producteditpage/".$id."'> ".Lang::get('app.More')."</a><button type='submit' class='btn btn-success' onclick='editpro(".$id.")' name='submit'> ".Lang::get('app.Edit')."</button></div></div></div>";
      }
    }
    // <input type='hidden' name='_token' value='".csrf_token()."'>
    public function getdataforpopup($id = nulll){
      if ($id != null) {
        $prod = Products::find($id);
        $gall = Gallery::where('product_id',$id)->get();
        // if($words != null){$ws = serialize($words);}else{$ws="";}
        if(count($gall) != 0){$data = "<a class='btn btn-primary' href='/gallery/".$id."'>Şəkillər</a>";}else{$data = "";}
         echo "<div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>".Lang::get('app.More')."</h4></div><div class='modal-body'><img src='/uploads/products/".$prod->product_image."' class='more-image' alt='no photo'/><br><br><ul class='list-group'><li class='list-group-item'><b>ID:</b> ".$prod->product_id."</li><li class='list-group-item'><b>Ad:</b> ".$prod->product_name."</li><li class='list-group-item'><b>".Lang::get('app.Quantity').": </b> ".$prod->quantity."</li><li class='list-group-item'><b>".Lang::get('app.Quantity_on_the_way').":</b> ".$prod->shipping_quantity."</li><li class='list-group-item'><b>".Lang::get('app.First_price').": </b> ".$prod->first_price."AZN</li><li class='list-group-item'><b>Qiymət:</b> ".$prod->price."AZN</li><li class='list-group-item'><b>Köhnə qiymət:</b><strong style='color:red;text-decoration: line-through;'> ".$prod->old_price."AZN</strong> <i>(".($prod->old_price - $prod->price)."AZN endirim)</i></li><li class='list-group-item'><b>".Lang::get('app.About').":</b> ".$prod->about."</li><li class='list-group-item'><b>".Lang::get('app.Keywords').":</b> ".$prod->keywords."</li><li class='list-group-item'><b>Barcode: </b> <img src='data:image/png;base64,".DNS1D::getBarcodePNG($prod->product_id, 'C39')."' alt='barcode' /></li><li class='list-group-item'><b>QR Kod: </b> <img src='data:image/png;base64,".DNS2D::getBarcodePNG($prod->product_id, 'QRCODE')."' alt='QRcode' /></li></ul></div><div class='modal-footer'> ".$data."<button type='button' class='btn btn-danger' data-dismiss='modal'>".Lang::get('app.Close')."</button></div></div>";
        }
    }
    public function allcodes($type){
      $prods = Products::all();
      return view('pages.allcodes',compact('prods','type'));
    }
    public function getdeletepopup($id = null){
      if ($id != null) {
        $prod = Products::find($id);
        echo "<div class='modal-dialog'><div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title'>".Lang::get('app.Delete')."</h4></div><div class='modal-body'><p>".$prod->product_id.", bu məhsulu silməkdə əminsinizmi?</p></div><div class='modal-footer'><a href='/deleteproduct/".$id."' class='btn btn-danger'>".Lang::get('app.Yes')."</a><button type='button' class='btn btn-success' data-dismiss='modal'>".Lang::get('app.No')."</button></div></div></div>";
      }
    }
    public function getproprice($id = null){
      if ($id != null) {
        $pro = Products::where('product_id',$id)->first();
        if (!empty($pro)) {
          echo $pro->price;
        }
      }
    }
    public function invoicedetails(Request $req,$invoice_id,$number,$token){
      $cnumb = "+".preg_replace('/[^\p{L}\p{N}\s]/u', '', $number);
      $sps = Soldpro::where('invoice_id',$invoice_id)->where('contact_number',$cnumb)->where('verified',1)->get();
      $arr = [];
      foreach ($sps as $i => $sp) {
        $pros = Products::where('product_id',$sp->product_id)->get();
        $repa = Returnback::where('sale_id',$sp->id)->first();
        if (empty($repa)) {$stat = 0; $reason = "";
        }else{$stat = 1;$reason = $repa->reason;}
          foreach ($pros as $key => $pro) {
            $arr[] = [
            'invoice_id' => $sp->invoice_id,
            'pro_id' => $sp->product_id,
            'quantity' => $sp->quantity,
            'date' => $sp->date,
            'buyer' => $sp->buyer,
            'contact_number' => $sp->contact_number,
            'price' => $sp->sold_price,
            'original_price' => $pro->old_price,
            'discount' => $pro->old_price - $sp->sold_price,
            'status' => $stat,
            'reason' => $reason,
            ];
          }
      }
      if ($token == md5(date("d-M-Y")."999").md5(date("Y-m-d")."111")) {
        return $arr;
      }else{
        echo md5(date("d-M-Y")."999").md5(date("Y-m-d")."111");
      }
    }
    public function getprodet($token){
      $prods = Products::all();
      $arr = [];
      foreach ($prods as $i => $prod) {
        $arr[] = [
        'pro_id' => $prod->product_id,
        'price' => $prod->price,
        'quantity' => $prod->quantity - $prod->shipping_quantity,
        ];
      }
      if ($token == md5(date("d-M-Y")."999").md5(date("Y-m-d")."111")) {
        return $arr;
      }else{
        echo "Not permitted!";
      }
    }
    public function getdt(){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://sade.asgro.org/api/get-product-details/8733271eb7e98adcdc94001150535ff8",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "accept: application/json"
        ),
      ));
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $res = curl_exec($curl);
      $response = json_decode($res,true);
      $err = curl_error($curl);
      curl_close($curl);
      $prods = Products::all();
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        foreach ($prods as $k => $prod) {
          foreach ($response as $key => $value) {
            if ($prod->product_id == $value['pro_id']) {
              print_r($value['pro_id']);
              $pro = Products::where('product_id',$prod->product_id)->first();
              $pro->quantity = $value['quantity'];
              // $pro->update()
            }
          }
        }
      }

    }
    public function showbalance(){
      $balance = Balance::orderBy('created_at', 'desc')->where('user_id',Auth::user()->id)->get();
      $paidbal = Payment::where('user_id',Auth::user()->id)->get();
      $sum_left = 0;
      $sum_paid = 0;
      foreach ($balance as $key => $b) {
        $sum_left += $b->amount;
      }
      foreach ($paidbal as $key => $pb) {
        $sum_paid += $pb->amount;
      }
      $sum = $sum_left - $sum_paid;
      return view('balance',compact('balance','paidbal','sum','sum_paid'));
    }
    public function usersbalance(){
      $bals = Balance::orderBy('created_at', 'desc')->get();
      return view('usersbalance',compact('bals'));
    }
    public function userbalance($id){
      $user = User::where('id',$id)->first();
      $bals = Balance::where('user_id',$id)->orderBy('created_at', 'desc')->get();
      return view('usersbalance',compact('bals','user'));
    }
    public function paid_amounts(){
      $bals = Balance::orderBy('created_at', 'desc')->where('status', 1)->get();
      return view('usersbalance',compact('bals','user'));
    }
    public function totalbalances(){
      $balance = Balance::orderBy('created_at', 'desc')->where('status', 0)->get();
      $user = User::all();
      return view('totalbalances',compact('balance','user'));
    }
    public function showallbalances(){
      $balance = Balance::orderBy('created_at', 'desc')->where('user_id',Auth::user()->id)->get();
      return view('allbalances',compact('balance'));
    }
    public function addbonusbalance(){
      return view('addbonusbalance');
    }
    public function paybalance(Request $req){
      $py = new Payment;
      $py->amount = $req->amount;
      $py->token = md5(microtime());
      $py->user_id = $req->user_id;
      $py->pay_date = $req->date;
      $py->save();
      return redirect()->back()->with('success','Paid.');
    }
    public function oldbalance(){
      $balance = Balance::where('status', 1)->where('user_id',Auth::user()->id)->get();
      return view('oldbalance',compact('balance'));
    }
    public function addproductpage(){
      return view('addproduct');
    }
    public function addbalancepage(){
      return view('addbalance');
    }
    public function finishedproducts(){
      $prod = Products::orderBy('created_at','desc')->where('quantity',0)->get();
      return view('productlist',compact('prod'));
    }
    public function productlist($id){
      $cat = Category::find($id);
      $prod = Products::orderBy('created_at','desc')->where('cat_id',$id)->where('quantity','!=',0)->get();
      return view('productlist',compact('prod','cat'));
    }
    public function allprods(){
      $prod = Products::all();
      return view('productlist',compact('prod'));
    }
    public function onthewaylist(){
      $prod = Products::orderBy('created_at','desc')->where('shipping_quantity','!=', 0)->get();
      return view('productlist',compact('prod'));
    }
    public function deletebalance($id){
     DB::table('balance')->where('id',$id)->delete();
     return redirect()->back()->with('danger',Lang::get('app.Balance_removed'));
   }
   public function redirect(){
     return redirect('/');
   }
   public function producteditpage($id){
     $prod = Products::find($id);
     return view('editproduct', compact('prod'));
   }
   public function changeproductsettings(Request $request, $id){
       $products = Products::find($id);
       $products->product_name = $request->product_name;
       $products->about = $request->about;
       $products->cat_id = $request->cat_id;
       $products->product_id = $request->product_id;
       $products->first_price = $request->first_price;
       $products->price = $request->price;
       $products->shipping_quantity = $request->shipping_quantity;
       $products->quantity = $request->quantity;
       $products->keywords = $request->keywords;
       $products->old_price = $request->old_price;
       if($request->hasFile('product_image')){
         $product_image = $request->file('product_image');
         $filename = time() . '.' . $product_image->getClientOriginalExtension();
         Image::make($product_image)->save(public_path('/uploads/products/' . $filename));
         $products->product_image = $filename;
       }
       $products->update();
       return Redirect()->back()->with('primary',Lang::get('app.Product_updated'));
   }
}
