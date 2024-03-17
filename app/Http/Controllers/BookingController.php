<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use DB;
use Lang;
class BookingController extends Controller
{
    public function showbookings(){
        $booking = Booking::orderBy('created_at', 'desc')->where('taken_status', 0)->get();
        return view('booking',compact('booking'));
    }
    public function takenbookings(){
        $booking = Booking::where('taken_status', 1)->orWhere('taken_status',2)->orderBy('created_at', 'desc')->get();
        return view('takenbooking',compact('booking'));
    }
    public function deletebooking($id){
     DB::table('booking')->where('id',$id)->delete();
     return redirect()->back()->with('danger',Lang::get('app.Booking_removed'));
   }
   public function addbooking(){
     $booking = Booking::orderBy('created_at', 'desc')->get();
     return view('addbooking',compact('booking'));
   }
   public function addbk(Request $req){
     $booking = new Booking;
     $booking->prod_name = $req->prod_name;
     $booking->user_name = $req->user_name;
     $booking->user_number = $req->user_number;
     $booking->paid_status = $req->paid_status;
     $booking->booking_date = $req->booking_date;
     $booking->detail = $req->detail;
     $booking->save();
     return Redirect()->back()->with('success',Lang::get('app.Booking_added'));
   }
   public function editbooking(Request $req, $id){
     $booking = Booking::find($id);
     $booking->user_name = $req->user_name;
     $booking->user_number = $req->user_number;
     $booking->taken_status = $req->taken_status;
     $booking->paid_status = $req->paid_status;
     $booking->detail = $req->detail;
     $booking->update();
     return Redirect()->back()->with('primary',Lang::get('app.Booking_changed'));
   }
}
