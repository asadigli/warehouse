<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Products;
use Image;
use DB;
use App\Balance;
use App\User;
use App\Soldpro;
use Auth;
use Redirect;
use Carbon\Carbon;
use Lang;
class UserController extends Controller
{
    public function addproduct(Request $request){
        $products = new Products;
        $products->product_name = $request->name;
        $products->about = $request->about;
        $products->cat_id = $request->cat_id;
        $products->product_id = $request->product_id;
        $products->first_price = $request->first_price;
        $products->price = $request->price;
        $products->old_price = $request->old_price;
        $products->keywords = $request->keywords;
        $products->shipping_quantity = $request->shipping_quantity;
        $products->quantity = $request->quantity;
        if($request->hasFile('product_image')){
          $product_image = $request->file('product_image');
          $filename = time() . '.' . $product_image->getClientOriginalExtension();
          Image::make($product_image)->save(public_path('/uploads/products/' . $filename));
          $products->product_image = $filename;
        }
        $products->save();
        return Redirect()->back()->with('success',Lang::get('app.Product_added'));
    }
    public function addcat(Request $req){
      $cat = new Category;
      $cat->cat_name = $req->cat_name;
      $cat->about = $req->about;
      $cat->save();
      return Redirect()->back()->with('success',Lang::get('app.Category_added'));
    }
    public function addbalance(Request $req){
      $balance = new Balance;
      $balance->user_id = $req->user_id;
      $balance->prod_id = $req->prod_id;
      $balance->amount = $req->amount;
      $balance->save();
      return Redirect()->back()->with('success',Lang::get('app.Balance_added'));
    }
    public function changebalance(Request $req, $id){
      $balance = Balance::find($id);
      $balance->user_id = $req->user_id;
      $balance->status = $req->status;
      $balance->update();
      return Redirect()->back()->with('primary',Lang::get('app.Balance_updated'));
    }
    public function deleteproduct($id){
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back()->with('danger',Lang::get('app.Product_removed'));
    }
    public function deletecategory($id){
      DB::table('categories')->where('id',$id)->delete();
      return redirect()->back()->with('danger',Lang::get('app.Category_removed'));
    }

    public function editproduct(Request $request, $id){
            $products = Products::find($id);
            $products->product_name = $request->name;
            $products->about = $request->about;
            $products->cat_id = $request->cat_id;
            $products->product_id = $request->product_id;
            $products->first_price = $request->first_price;
            $products->price = $request->price;
            $products->shipping_quantity = $request->shipping_quantity;
            $products->quantity = $request->quantity;
            $products->update();
            return redirect()->back()->with('primary',Lang::get('Product_updated'));
    }
    public function getusers(){return view('users');}
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
          }
    }
      public function deleteuser($id){
           DB::table('users')->where('id',$id)->delete();
           return redirect()->back()->with('danger','User removed!');
       }
       public function assignuser(Request $req, $id){
         $user = User::find($id);
         $user->role_id = $req->role_id;
         $user->update();
         return Redirect()->back()->with('primary','Employee role changed');
       }
       public function mainpage(){
          $prod = Products::orderBy('created_at', 'desc')->take(10)->get();
          $cat = Category::orderBy('id','asc')->get();
          $user = User::orderBy('created_at','desc')->get();
          return view('main',compact('prod','cat','user'));
      }
      public function changeprice(Request $req, $id){
        $prod = Products::find($id);
        $prod->price = floatval($req->price);
        $prod->quantity = $req->quantity;
        $prod->first_price = floatval($req->first_price);
        $prod->shipping_quantity = $req->shipping_quantity;
        $prod->update();
        return response()->json(['success' => Lang::get('app.Product_updated')]);
        // return Redirect()->back()->with('primary',Lang::get('app.Product_updated'));
      }

    public function changepassword(Request $request, $id){
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->update();
        return redirect()->back()->with('primary',Lang::get('app.User_password_updated'));
    }
    public function soldproducts(){
        return view('addbooking');
    }
    public function soldprolist($day = null,$month = null,$year = null){
        $fss = Soldpro::where('verified',1)->whereDate('date', '>', Carbon::now()->subDays(30))->get();
        $fds = Soldpro::where('verified',1)->whereDate('date', '>', Carbon::now()->subDays(7))->get();
        $sum = 0;
        $sumw = 0;
        foreach ($fss as $key => $fs) {
          $sum += $fs->sold_price * $fs->quantity;
        }
        foreach ($fds as $key => $fs) {
          $sumw += $fs->sold_price * $fs->quantity;
        }
        if ($day == null && $month == null && $year == null) {
          if (Auth::user()->role_id == 3) {
            $sps = Soldpro::orderBy('date','desc')->paginate(10);
          }else{
            $sps = Soldpro::orderBy('date','desc')->where('verified',1)->orWhere('seller',Auth::user()->id)->paginate(10);
          }
        }else{
          $sps = Soldpro::where(function($query) use ($day)  {
                            if(isset($day) && $day != 'all') {
                                    $query->whereDay('date', $day);
                                }
                           })->where(function($query) use ($month)  {
                              if(isset($month) && $month != 'all') {
                                  $query->whereMonth('date',$month);
                              }
                           })->where(function($query) use ($year)  {
                              if(isset($year) && $year != 'all') {
                                  $query->whereYear('date',$year);
                              }
                           })->paginate(10);
          $sps_for_cal = Soldpro::where('verified',1)->where(function($query) use ($day){ if(isset($day) && $day != 'all'){ $query->whereDay('date', $day);}})->where(function($query) use ($month){ if(isset($month) && $month != 'all'){ $query->whereMonth('date',$month);}})->where(function($query) use ($year){ if(isset($year) && $year != 'all'){ $query->whereYear('date',$year);}})->get();
          $sumgiven = 0;
          foreach ($sps_for_cal as $key => $fs) {
            $sumgiven += $fs->sold_price * $fs->quantity;
          }
          $da = $day;
          $mo = $month;
          $ye = $year;
        }
        if ($day == 'all' && $month == 'all' && $year == 'all') {
          return redirect()->route('spl');
        }elseif($day == null && $month == null && $year == null){
          return view('addbooking',compact('sps','sum','sumw'));
        }else{
          return view('addbooking',compact('sps','da','mo','ye','sumgiven'));
        }
    }
    public function soldpro_filter(Request $req){
        $year = $req->year;
        $month = $req->month;
        $day = $req->day;
        return redirect()->route('spl',[$day,$month,$year]);
    }
    public function productsold(Request $req){
      $this->validate($req,[
        'invoice_id' => 'unique:soldpro',
      ]);
      $sp = new Soldpro;
      $sp->seller = $req->seller;
      $sp->product_id = $req->product_id;
      $sp->date = $req->date;
      $sp->contact_number = rms($req->phone_number);
      $sp->buyer = $req->buyer;
      $sp->quantity = $req->quantity;
      $sp->sold_price = rms($req->sold_price);
      $p = Products::where('product_id',$req->product_id)->first();
      $sp->first_price = ($req->sold_price - ($p->price - $p->first_price));
      $sp->token = md5(microtime());
      $sp->verified = 0;
      $sp->invoice_id = get_id();
      $sp->comment = $req->comment;
      $sp->save();
      return redirect()->back()->with('success',Lang::get('app.Sale_added'));
    }
    public function editsale($token){
      $sp = Soldpro::where('token',$token)->first();
      return view('addbooking',compact('sp'));
    }
    public function getcustnamebyphone($phone = null){
      if ($phone != null) {
        $sp = Soldpro::where('contact_number','LIKE', '%'.$phone.'%')->first();
        if (!empty($sp)) {return $sp->buyer;}else{echo "Qeyd edilməyib";}
      }else{echo "Qeyd edilməyib";}
    }
    public function toeditsale(Request $req,$token){
      $sp = Soldpro::where('token',$token)->first();
      $sp->seller = $req->seller;
      $sp->product_id = $req->product_id;
      $sp->date = $req->date;
      $sp->contact_number = $req->phone_number;
      $sp->buyer = $req->buyer;
      $sp->quantity = $req->quantity;
      $sp->sold_price = $req->sold_price;
      $prods = Products::where('product_id',$req->product_id)->first();
      $sp->first_price = ($req->sold_price - ($prods->price - $prods->first_price));
      $sp->comment = $req->comment;
      $sp->update();
      return redirect('/sold-product-list')->with('success',Lang::get('app.Sale_updated'));
    }
    public function confirmsale(Request $req, $token){
      $sp = Soldpro::where('token', $token)->first();
      $sp->first_price = ($sp->sold_price*$sp->quantity - $req->earning)/$sp->quantity;
      $sp->verified = 1;
      $sp->update();
      $pro = Products::where('product_id',$sp->product_id)->first();
      $pro->quantity = $pro->quantity - $sp->quantity;
      $pro->update();
      for ($i=0; $i < $sp->quantity; $i++) {
        $b = new Balance;
        $b->user_id = $sp->seller;
        $b->prod_id = $pro->id;
        $b->amount = $req->earning/$sp->quantity;
        $b->sale_id = $sp->id;
        $b->save();
      }
      return redirect()->back()->with('success',Lang::get('app.Sale_confirmed'));
    }
    public function deletesale($token){
      $sp = Soldpro::where('token',$token)->first();
      if ($sp->verified == 1) {
        $q1 = DB::select("DELETE FROM balance WHERE sale_id = ".$sp->id);
        $q2 = DB::select("UPDATE products SET quantity = (quantity + ".$sp->quantity.") WHERE product_id = '".$sp->product_id."'");
      }
      DB::select("DELETE FROM soldpro WHERE id = ".$sp->id);
      return redirect()->back()->with('danger',Lang::get('app.Sale_removed'));
    }
    public function count_list(Request $req){
      if (isset($req->type)) {
        $count = 0;
        if ($req->type == 1) {
          $count = Soldpro::where('verified',0)->count();
        }
        return response()->json(['data' => $count]);
      }else{
        return response()->json(['data' => "No data"]);
      }
    }
}
