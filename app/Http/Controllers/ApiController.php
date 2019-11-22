<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\project;
use App\location;
use App\travel;
use App\locationsetup;
use App\attendance;
class ApiController extends Controller
{  
   public function saveuser(Request $request)
   {
     header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
        $user=new User();
        $user->name=$request->name;
       $user->email=$request->email;
       $user->mobile=$request->mobile;
       $user->usertype=$request->usertype;
       $user->username=$request->username;
       $user->password= bcrypt($request->userpassword);
       $user->pass=$request->userpassword;
       $user->designation=$request->designation;
       $user->save();

       return response()->json($user);
   }
    public function getusers($id)
    {
        header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
          $users=User::find($id);

          return response()->json($users);
    }
     public function saveattendance(Request $request)
     {
        header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
        $attendance=new attendance();
        $attendance->userid=$request->userid;
        $attendance->latitude=$request->latitude;
        $attendance->longitude=$request->longitude;
        $attendance->present=$request->present;
        $attendance->battery=$request->battery;
        $attendance->deviceid=$request->deviceid;
        $attendance->time=$request->time;

        $attendance->save();
        

        return response()->json($attendance);

     }
     public function savetraveldetails(Request $request)
     {
         header('Access-Control-Allow-Origin: *');
         header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
         
         $travel=new travel();
         $travel->empid=$request->employeeid;
         $travel->fromplace=$request->fromplace;
         $travel->toplace=$request->toplace;
         $travel->description=$request->description;
         $travel->save();

         $intervalinminutes=locationsetup::find(1);

         $all=array('travelid'=>$travel->id,'intervalinminutes'=>$intervalinminutes->intervalinminutes);
         
         return response()->json($all);


     }



     

     public function saveuserlocation(Request $request)
     {
        header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type');
        $location=new location();
        $location->empid=$request->employeeid;
        $location->latitude=$request->latitude;
        $location->longitude=$request->longitude;
        $location->orginallocation=$request->orginallocation;
        $location->date=$request->date;
        $location->time=$request->time;
        $location->save();

        return response()->json($location);

     }
   
     public function authenticateuser(Request $request)
    {
    	header('Access-Control-Allow-Origin: *');
        header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
        $username=$request->username;
        $password=$request->password;

            $user=User::where(function ($query) use ($username,$password) {
                        $query->where('email', '=', $username)
                        ->orWhere('username', '=', $username);
                        })
                        ->where('pass','=',$password)
                        ->first();


            if(count($user)>0)
            {
                $auth='YES';
            }
            else
            {
                 $auth='NO';
            }

            $all=array('isauthenticated'=>$auth,'userdeatils'=>$user);


          return response()->json($all);
    }
}
