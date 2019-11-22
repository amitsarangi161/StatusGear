<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\activity;
use App\userrequest;
use Session;
use Mail;
use App\complaint;
use Auth;
use App\complaintlog;
use DB;
use App\todo;
use Carbon\Carbon;
use App\notice;
use App\document;

class HrController extends Controller
{

  public function deletedocument($id)
  {
       document::find($id)->delete();

       Session::flash('msg','Document Deleted Successfully');
       return back();
  }

   public function savedocument(Request $request)
   {
        $document=new document();
        $document->docname=$request->docname;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/doc/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $document->attachment = $rarefilename;
        }
        $document->save();
        Session::flash('msg','Document saved Successfully');
        return back();

   }

   public function adddocuments()
   {
      $documents=document::all();
      return view('hr.adddocuments',compact('documents'));
   }

    public function viewnotice($id)
    {
        $notice=notice::find($id);

        return view('viewnotice',compact('notice'));
    }

    public function activenotice($id)
    {
        $notice=notice::find($id);
       $notice->status="ACTIVE";
       $notice->save();
       return back();
    }

     public function deactivenotice($id)
     {
       $notice=notice::find($id);
       $notice->status="DEACTIVE";
       $notice->save();

       return back();
     }  

     public function updatenotice(Request $request,$id)
     {
        $notice=notice::find($id);
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
       
        return redirect('/notices/viewallnotice');
     }
     public function editnotice($id)
     {
        $notice=notice::find($id);

        return view('editnotice',compact('notice'));
     }

     public function viewallnotice()
     {

          $notices=notice::all();
          return view('viewallnotice',compact('notices'));

     }
    
     public function savenotice(Request $request)
     {
        $notice=new notice();
        $notice->subject=$request->subject;
        $notice->description=$request->description;

        $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/notice/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $notice->attachment = $rarefilename;
        }
        $notice->save();
        Session::flash('msg','Notice Saved Successfully');
        return back();
       
     }
     public function createnotice()
    {
        return view('createnotice');
    }
    public function userviewallmytodo()
      {
           $todos=todo::where('userid',Auth::id())->get();

           return view('hr.userviewallmytodo',compact('todos'));
      }
     public function mymessages()
    {
        $users=User::all();
          $uid=Auth::id();
          
      /*    $messages =  chat::whereRaw("(sender, `reciver`, `created_at`) IN (
          SELECT   sender, `reciver`, MAX(`created_at`)
          FROM     chats
          WHERE     `reciver`=$uid
            or    `sender`=$uid
          GROUP BY convertationid)")
          ->orderBy('created_at','desc')
          ->get();
*/


            $messages=DB::table('chats')
                ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                        })
                     ->orderBy('created_at', 'desc')
                     ->get()
                     ->unique('convertationid');

  /*$sub = chat::orderBy('created_at','DESC');

    $messages = DB::table(DB::raw("({$sub->toSql()}) as sub"))
   ->where(function($query) use ($uid){
                      $query->where('sender',$uid);
                      $query->orWhere('reciver',$uid);
                  })
    ->groupBy('convertationid')
    ->get();
     */ 

        /* $messages=chat::select('chats.*','u1.name as sendername','u2.name as recivername')
             
             ->leftJoin('users as u1','chats.sender','=','u1.id')
             ->leftJoin('users as u2','chats.reciver','=','u2.id')
             ->where(function($query) use ($uid){
                      $query->where('chats.sender',$uid);
                      $query->orWhere('chats.reciver',$uid);
                  })
               ->groupBy('chats.sender','chats.reciver')
               
                ->get();*/

         
         return view('hr.mymessages',compact('messages','users'));
    }

       public function complainttoresolve(Request $request)
   {
     $statuses=complaint::groupBy('status')->get();
      complaint::where('active','1')->update(['active'=>'0']);

     if($request->has('type'))
      {

          $filterreq=$request->type;
          $uid=Auth::id();
          $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                  ->where('complaints.status',$request->type)
                 ->where(function($query) use ($uid){
                      $query->where('complaints.touserid',$uid);
                      $query->orWhere('complaints.cc',$uid);
                  })
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }
      else
      {
        $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                  ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.touserid',Auth::id())
                 ->orWhere('complaints.cc',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

    
                
  
                
    return view('hr.complainttoresolve',compact('complaints','statuses','filterreq'));
   }
      public function viewcomplaintdetails($id)
  {
       $complaint=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.id',$id)
                 ->first();

       $complaintlogs=complaintlog::select('complaintlogs.*','users.name')
                      ->leftJoin('users','complaintlogs.writerid','=','users.id')
                      ->where('complaintid',$id)
                      ->orderBy('complaintlogs.created_at','DESC')
                      ->get();
      return view('hr.viewcomplaintdetails',compact('complaint','complaintlogs'));
  }
     public function complaint(Request $request)
   {  
     if($request->has('type'))
      {
          $filterreq=$request->type;
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.status',$request->type)
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      }

      else
      {
         $filterreq="";
         $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.fromuserid',Auth::id())
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();

      }
     
      $statuses=complaint::groupBy('status')->get();
      $users=User::all();

      return view('hr.complaint',compact('users','complaints','filterreq','statuses'));

     
   }
    public function hrapproverequest(Request $request)
    {
       $user=new User();

    	  $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',
       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
        
       $user->save();
       $u=userrequest::find($request->uid);
       $u->status='0';
       $u->save();
        $email=$user->email;
        $uname=$request->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
       return back();
    Session::flash('msg','User Updated Successfully');
    }
	public function registerrequest()
	{
		$userrequests=userrequest::where('status','1')->get();
		return view('hr.registerrequest',compact('userrequests'));
	}
    public function home()
    {
        $todos=todo::where('userid',Auth::id())->whereDate('datetime', Carbon::today())->paginate(10);

    	return view('hr.home',compact('todos'));
    }
       public function adduser()
   {
     
      $users=User::select('users.*','activities.activityname')
             ->leftJoin('assignedactivities','assignedactivities.userid','=','users.id')
             ->leftJoin('activities','assignedactivities.activityassigned','=','activities.id')
             ->groupBy('users.id')
             ->get();
      $activities=activity::all();

      return view('hr.adduser',compact('users','activities'));
   }

    public function saveuser(Request $request)
   {
      
     $user=new User();
       $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'userpassword' => 'required|min:6',
            'usertype'=>'required|string',
            'username'=>'required|string|max:255|unique:users',
            'mobile'=>'required|string|max:10|min:10|unique:users',



       ]);
       $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->pass=$request->userpassword;
       $user->designation=$request->designation;
       $user->save();

        $email=$user->email;
        $uname=$user->username;
        $password=$user->pass;
        $name=$user->name;

        $mail= Mail::send('mail.mail', compact('email','uname','password','name'), function($message) use($email) {
     $message->to($email, 'Primary Client');
     $message->cc("info@stepltest.com",'Primary Client');
     $message->subject('Registration Confirmation');
         $message->from('subudhitechnoengineers@gmail.com','Subudhi Technoengineers');
        
      });
      
    Session::flash('msg','User Added Successfully');
         return back();
   }

       public function updateuser(Request $request)
       {
      $user=User::find($request->uid);
      $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->designation=$request->designation;
       $user->pass=$request->userpassword;
      
       $user->save();
    Session::flash('msg','User Updated Successfully');
    return back();
   }
}
