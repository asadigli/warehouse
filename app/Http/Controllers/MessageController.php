<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
// use App\Inbox;
use App\Message;
use App\Information;
use DB;
use Auth;
class MessageController extends Controller
{
    public function inbox(){
      return view('pages.inbox');
    }
    public function sentbox(){
      return view('pages.inbox_sent');
    }
    public function information(){
      $info = Information::all();
      return view('information',compact('info'));
    }
    public function adddetail(Request $req){
      $info = new Information;
      $info->name = $req->name;
      $info->details = $req->detail;
      $info->save();
      return Redirect()->back()->with('success','Information added successfully');
    }
    public function deleteinfo($id){
      DB::table('information')->where('id',$id)->delete();
      return redirect()->back()->with('danger','Information removed!');
    }

    // message post function Here
    public function addItem(Request $request) {
      $rules = array (
          'seller_id' => 'required',
          'receiver_id' => 'required',
          'cc_receiver_id' => 'integer',
          'message_title' => 'required',
          'message_body' => 'required',
      );
      $validator = Validator::make ( Input::all (), $rules );
      if ($validator->fails ())
          return Response::json ( array (
                  'errors' => $validator->getMessageBag ()->toArray ()
          ) );
          else {
              $mess = new Message();
              $mess->seller_id = $request->seller_id;
              $mess->receiver_id = $request->receiver_id;
              $mess->cc_receiver_id = $request->cc_receiver_id;
              $mess->message_title = $request->message_title;
              $mess->message_body = $request->message_body;
              $mess->save();
              return response()->json($mess);
          }
    }

}
