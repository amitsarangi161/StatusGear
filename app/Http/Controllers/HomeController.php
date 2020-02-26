<?php

namespace App\Http\Controllers;
use Twilio\Rest\Client as Client1;
use Illuminate\Http\Request;
use App\activity;
use App\requisitionpayment;
use App\requisition;
use App\User;
use App\client;
use Session;
use App\useraccount;
use Auth;
use App\project;
use App\expenseentrylabour;
use App\expenseentrylabourimage;
use App\projectactivity;
use App\assignedactivity;
use App\projectreport;
use App\complaint;
use App\complaintlog;
use App\chat;
use DB;
use App\notice;
use App\document;
use App\wallet;
use App\debitvoucherheader;
use App\particular;
use App\todo;

use Carbon\Carbon;
use App\userrequest;
use Mail;
use App\vendor;
use App\expenseentry;
use App\expensehead;
use App\requisitionheader;
use App\notification;
use App\usernotification;
use App\labour;
use App\vehicle;
use App\location;
use App\tour;
use App\attendance;
use App\billheader;
use App\billitem;
use App\discount;
use App\hsncode;
use App\unit;
use App\crvoucherheader;
use App\crvoucheritem;
use App\invoiceno;
use App\userunderhod;
use App\dailylabour;
use App\engagedlabour;
use App\dailyvehicle;
use App\expenseentrydailylabour;
use App\expenseentrydailyvehicle;
use App\suggestion;
use App\testimage;
use DataTables;
//use Barryvdh\DomPDF\Facade as PDF;
class HomeController extends Controller
{

     public function previousapprovedreq()
     {
         $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname','userunderhods.hodid')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->leftJoin('userunderhods','requisitionheaders.employeeid','=','userunderhods.userid')
                      ->where('userunderhods.hodid',Auth::id())
                      ->get();
      
      return view('hodviewpreviousreq',compact('requisitions'));
     }

     public function changeuserstatus(Request $request)
     {
         $user=User::find($request->chid);
         $user->active=$request->status;
         $user->save();

         return back();
     }

     public function attendancereport(Request $request)
     {
         $users=User::where('active','1')->get();
         if ($request->has('user') && $request->has('fromdate') && $request->has('todate')) {
        $name=User::FindOrFail($request->user)->name;

        $datefrom = Carbon::parse($request->fromdate);
        $dateto = Carbon::parse($request->todate);
        $totalDuration =$datefrom->diffInDays($dateto);
        $all=array();
        
        for ($x = 0; $x <= $totalDuration; $x++) {
             if ($x==0) {
                $date=$datefrom;
                
             }
             else
             {
               $date = $datefrom->addDays(1);
               
             }

             
             $p=attendance::where('userid',$request->user)
                 ->where('created_at', '>=',$date)
                 ->where('created_at', '<=',$date->format('Y-m-d').' 23:59:59')
                 ->get();
            //dd($p);

              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }  

           $a=array('date'=>$date->format('Y-m-d'),'status'=>$present,'total'=>count($p),'locations'=>$p,'userid'=>$request->user);

             $all[]=$a;
             
             } 

             $count = 0;
foreach ($all as $type) {
    if($type['status']=='PRESENT'){
      ++$count;
    }
}
           
         }






         //return compact('users','all','totalDuration','count');
         return view('attendancereport',compact('users','all','totalDuration','count','name'));
     }
     public function datatable()
     {
         return view('datatable');
     }
         public function getPosts()
      {


        return DataTables::of(User::query())
               ->editColumn('name', function(User $user) {
                    if ($user->name != '') return 'My Name'.$user->name;
                    if ($user->name == 1) return 'NOT';
                    
                    
                })
               ->make(true);
       }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }
*/
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function testimage()
    {

         $images=testimage::paginate(12);
         $items=$images->items();
         

         return view('img',compact('images','items'));
    }
    public function singledocumentview($id)
    {
        $document=document::find($id);

        return view('singledocumentview',compact('document'));
    }

    public function viewsinglenotice($id)
    {
         $notice=notice::find($id);

         return view('viewsinglenotice',compact('notice'));
    }

    public function viewalldocumentshome()
    {
          $documents=document::orderBy('id','DESC')->paginate(15);
         return view('viewalldocumentshome',compact('documents'));
    }

    public function viewallnoticehome()
    {
         $notices=notice::where('status','ACTIVE')->orderBy('id','DESC')->paginate();

         return view('viewallnoticehome',compact('notices'));
    }

    public function impsuggestions()
    {
       $suggestions=suggestion::where('status','1')->get();
      return view('impsuggestions',compact('suggestions'));
    }

    public function viewallsuggestions()
    {
      $suggestions=suggestion::all();
      return view('viewallsuggestions',compact('suggestions'));
    }

    public function viewallassignedusertohod()
    {
         $hods=User::where('usertype','ADMIN')->get();
         $finalusershodsarray=array();
         foreach ($hods as $key => $hod) {
            $users=userunderhod::select('users.id as userid','users.name','userunderhods.id as unhid')
                  ->leftJoin('users','userunderhods.userid','=','users.id')
                   ->where('hodid',$hod->id)
                   ->get();
            $finalusershodsarray[]=[
              'hodid'=>$hod->id,
              'hodname'=>$hod->name,
              'users'=>$users

            ];
         }

         //return $finalusershodsarray;
         return view('viewallassignedusertohod',compact('finalusershodsarray'));
    }
    public function viewpaymentdetailsuser($uid)
    {
        $projects=requisitionpayment::select('projects.projectname','clients.orgname','projects.id as proid')
                          ->where('requisitionpayments.paymentstatus','PAID')
                          ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
                          ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                          ->leftJoin('clients','projects.clientid','=','clients.id')
                          ->where('requisitionheaders.employeeid',$uid)
                          ->groupBy('requisitionheaders.projectid')
                          ->get();

        return $projects;

        return view('viewpaymentdetailsuser');
    }
    public function dailylabourdetailsshow($id)
    {
            $labours=engagedlabour::select('labours.*')
                 ->leftJoin('labours','engagedlabours.labourid','=','labours.id')
                 ->where('dailylabourid',$id)
                 ->get();

            //return $labours;

          return view('dailylabourdetailsshow',compact('labours'));
    }

    public function vehicledetailsshow($id)
    {
       $vehicle=vehicle::find($id);

        return view('vehicledetailsshow',compact('vehicle'));
    }

    public function viewdailyvehicledetails($id)
    {
        $dailyvehicle=dailyvehicle::find($id);
        $project=project::find($dailyvehicle->projectid);
        $vehicle=vehicle::find($dailyvehicle->vehicleid);

        return view('viewdailyvehicledetails',compact('dailyvehicle','vehicle','project'));
    }

    public function viewallengagedailyvehicle()
    {
       $dailyvehicles=dailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno','projects.projectname')
                      ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                      ->leftJoin('projects','dailyvehicles.projectid','=','projects.id')
                      ->get();
       
       return view('viewallengagedailyvehicle',compact('dailyvehicles'));
    }
    public function savedailyengagedvehicle(Request $request)
    {

     

       $dailyvehicle=new dailyvehicle();
       $dailyvehicle->projectid=$request->projectid;
       $dailyvehicle->vehicleid=$request->vehicle;
       $dailyvehicle->date=$request->date;
       $dailyvehicle->starttime=$request->starttime;
       $dailyvehicle->endtime=$request->endtime;
       $dailyvehicle->userid=Auth::id();
       $dailyvehicle->description=$request->description;
       $dailyvehicle->startmeterreading=$request->startmeterreading;
       $dailyvehicle->endmeterreading=$request->endmeterreading;
        $rarefile = $request->file('image');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/dailyvehicle/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $dailyvehicle->image = $rarefilename;
        }
       $dailyvehicle->save();

       Session::flash('msg','Successfully Saved');
       return back();


    }
    public function engagedailyvehicle()
    {
        $vehicles=vehicle::where('userid',Auth::id())->get();
        $projects=project::all();
        return view('engagedailyvehicle',compact('vehicles','projects'));
    }
    public function viewengagedlabourdetails($id)
    {
        $engagedlaboursarr=array();
        $dailylabour=dailylabour::select('dailylabours.*','users.name','projects.projectname')
                      ->leftJoin('users','dailylabours.userid','=','users.id')
                      ->leftJoin('projects','dailylabours.projectid','=','projects.id')
                      ->where('dailylabours.id',$id)
                      ->first();
        
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr=[
              'id'=>$dailylabour->id,
              'projectname'=>$dailylabour->projectname,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
              'name'=>$dailylabour->name
            ];
        
        $labours=engagedlabour::select('labours.*')
                 ->leftJoin('labours','engagedlabours.labourid','=','labours.id')
                 ->where('dailylabourid',$dailylabour->id)
                 ->get();

        return  view('viewengagedlabourdetails',compact('engagedlaboursarr','labours'));   
    }
    
    public function viewallengagedlabours()
    {
        $engagedlaboursarr=array();
        $dailylabours=dailylabour::select('dailylabours.*','users.name','projects.projectname')
                      ->leftJoin('users','dailylabours.userid','=','users.id')
                      ->leftJoin('projects','dailylabours.projectid','=','projects.id')      
                      ->where('userid',Auth::id())
                      ->get();
        foreach ($dailylabours as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'projectname'=>$dailylabour->projectname,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
              'name'=>$dailylabour->name
            ];
        }
        return  view('viewallengagedlabours',compact('engagedlaboursarr'));
    }
    public function savedailylabour(Request $request)
    {

         $count=dailylabour::where('userid',Auth::id())->where('date',$request->date)->count();

         if ($count>0) {
          Session::flash('msg','Failed You have Already Engaged Labour for this Date');

          return back();
          
         }
         else
         {


         if(sizeof($request->labour)>0)
         {


         $dailylabour=new dailylabour();
         $dailylabour->projectid=$request->projectid;
         $dailylabour->date=$request->date;
         $dailylabour->userid=Auth::id();
         $dailylabour->description=$request->description;

           $rarefile = $request->file('workingimage');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/engagedlabourimg/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $dailylabour->workingimage = $rarefilename;
        }
        $dailylabour->save();

        $dailylabourid= $dailylabour->id;
        $count=sizeof($request->labour);
        for ($i=0; $i < $count ; $i++) { 
           $engagedlabour=new engagedlabour();
           $engagedlabour->dailylabourid=$dailylabourid;
           $engagedlabour->labourid=$request->labour[$i];
           $engagedlabour->save();
        }

        Session::flash('msg','succesfully saved');
       }
       else
       {
           Session::flash('msg','Faild No Labour Selected');
       }
        
      }
        return back();

    }

    public function dailylabour()
    {
         $labours=labour::where('userid',Auth::id())->get();
         $projects=project::all();

         return view('dailylabour',compact('labours','projects'));
    }

    public function showdetaillocations($uid,$date)
    {
         $addressarr=array();
         $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$date.' 00:00:00')
                 ->where('created_at', '<=',$date.' 23:59:59')
                 ->get();

       //return $p;
          foreach ($p as $key => $value) {
try{
$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($value->latitude).','.trim($value->longitude).'&key=AIzaSyAPpd5bBWsGyPvEBgmB_3-QjTQ8bP5yIW0';
     $json = @file_get_contents($url);
     $data=json_decode($json);
     $status = $data->status;
     if($status=="OK")
     {
       $fulladdress=$data->results[0]->formatted_address;
     }
     else
     {
       $fulladress="NOT FOUND";
     }
     $arr=array('userid'=>$value->userid,'latitude'=>$value->latitude,'longitude'=>$value->longitude,'deviceid'=>$value->deviceid,'battery'=>$value->battery,'address'=>$fulladdress,'created_at'=>$value->created_at,'time'=>$value->time,'mode'=>$value->mode,'status'=>$value->status,'version'=>$value->version);
     $addressarr[]=$arr;
     
    }
      catch (\Exception $e){
        
    }
    }
  
     
     $user=User::find($uid);
     $name=$user->name;

     return view('showdetaillocationuser',compact('addressarr','name','date'));
    }



    public function viewrejectbills()
    {
        $bills=billheader::where('status','REJECTED')->get();
       return view('viewrejectbills',compact('bills'));
    }
    public function userassigntohod()
    {

          $userids=userunderhod::select('userid')
                    ->get();
         $users=User::where('usertype','USER')->whereNotIn('id',$userids)->get();
         $hods=User::where('usertype','ADMIN')->get();
         return view('userassigntohod',compact('hods','users'));
    }
   public function viewrejectbillsacc()
    {
        $bills=billheader::where('status','REJECTED')->get();
       return view('accounts.viewrejectbills',compact('bills'));
    }

    public function rejectbill(Request $request)
    {
           $billheader=billheader::find($request->billid);
           $billheader->status="REJECTED";
           $billheader->remarks=$request->remarks;
           $billheader->save();

           return back();
    }

    public function viewapprovedbills(){
      $bills=billheader::where('status','APPROVED')->get();

      return view('approvedbills',compact('bills'));
    }

    public function viewapprovedbillsacc(){
      $bills=billheader::where('status','APPROVED')->get();

      return view('accounts.approvedbills',compact('bills'));
    }
    public function approvebill($id)
    {
        $billheader=billheader::find($id);

          $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
           $billyear1=substr( $invyear, -2).$year1;
           
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;
            $billyear1=substr( $year, -2).$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$billheader->company)->orderBy('invno','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }

      $num = $invno;
      $numlength = strlen((string)$num);
      if($numlength==1)
       {
          $fullinvno=$billheader->company.$billyear1."000".$invno;
       }
       elseif ($numlength==2) {
            $fullinvno=$billheader->company.$billyear1."00".$invno;
       }
       elseif ($numlength==3) {
           $fullinvno=$billheader->company.$billyear1."0".$invno;
       }
       else
       {
           $fullinvno=$billheader->company.$billyear1.$invno;
       }
      $billheader2=billheader::find($id);

     $billheader1=billheader::find($id);
      $billheader1->fullinvno=$fullinvno;
      $billheader1->invoicedate=$invoicedate;
      $billheader1->invyear=$billyear;
      $billheader1->invno=$invno;
      $billheader1->status="APPROVED";
      $billheader1->save();

      $invoiceno=new invoiceno();
      $invoiceno->billid=$id;
      $invoiceno->invyear=$billyear;
      $invoiceno->invno=$invno;
      $invoiceno->company=$billheader->company;
      $invoiceno->save();
     
      return back();

    }
    public function viewpendingbills()
    {
         $bills=billheader::where('status','PENDING')->get();

         return view('pendingbills',compact('bills'));
    }  
    public function viewpendingbillsacc()
    {
         $bills=billheader::where('status','PENDING')->get();

         return view('accounts.pendingbills',compact('bills'));
    }
    public function updatebill(Request $request,$id)
    {
       $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
           
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$request->company)->orderBy('id','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }
      $billheader2=billheader::find($id);
      $billheader=billheader::find($id);
      $billheader->projectid=$request->projectid;
      $billheader->clientname=$request->clientname;
      $billheader->email=$request->email;
      $billheader->gstno=$request->gstno;
      $billheader->panno=$request->panno;
      $billheader->contactno=$request->contactno;
      $billheader->fax=$request->fax;
      $billheader->nameofthework=$request->nameofthework;
      $billheader->address=$request->address;
      $billheader->bankid=$request->bankid;
      //$billheader->invoicedate=$invoicedate;
      $billheader->refno=$request->refno;
      $billheader->refdate=$request->refdate;
      if ($billheader2->fullinvno=='') {
        $billheader->status='PENDING';
      }
      

      $billheader->cgstrate=$request->cgstrate;
      $billheader->cgstvalue=$request->cgstvalue;
      $billheader->sgstrate=$request->sgstrate;
      $billheader->sgstvalue=$request->sgstvalue;
      $billheader->igstrate=$request->igstrate;
      $billheader->igstvalue=$request->igstvalue;
      $billheader->total=$request->total;
      $billheader->totalpayable=$request->totalpayable;
      $billheader->advancepayment=$request->advancepayment;
      $billheader->netpayable=$request->netpayable;
      //$billheader->invyear=$billyear;
      //$billheader->invno=$invno;
      //$billheader->company=$request->company;
      $billheader->claimedrate=$request->claimedrate;
      $billheader->claimedvalue=$request->claimedvalue;
      $billheader->discounttype=$request->discounttype;
      $billheader->discount=$request->discount;
      $billheader->discountvalue=$request->discountvalue;

      //return $billheader;
      $billheader->save();

      $crvoucherid=$billheader->id;
      $count=count($request->workdetails);
      billitem::where('headerid',$id)->delete();

      for ($i=0; $i <$count ; $i++) { 
        $billitem=new billitem();
        $billitem->headerid=$crvoucherid;
        $billitem->slno=$request->slno[$i];
        $billitem->workdetails=$request->workdetails[$i];
        $billitem->hsn=$request->hsn[$i];
        $billitem->unit=$request->unit[$i];
        $billitem->rate=$request->rate[$i];
        $billitem->quantity=$request->qty[$i];
        $billitem->amount=$request->amount[$i];
        $billitem->save();

      }
      return redirect('/bills/viewallbills');
    }
    public function editbills($id)
    {


       $billheader=billheader::find($id);

        $banks=useraccount::where('type','COMPANY')->get();
     $billitems=billitem::select('billitems.*','units.unitname')
                    ->leftJoin('units','billitems.unit','=','units.id')
                    ->where('headerid',$id)
                    ->get();
       $discounts=discount::all();
       $projects=project::select('clients.clientname','projects.*','clients.officeaddress','clients.gstn','clients.panno','clients.contact1 as contactno','clients.email')

                ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
       $hsncodes=hsncode::all();
       $units=unit::all();

      return view('editbills',compact('billheader','billitems','discounts','projects','hsncodes','units','banks'));
      //return view('editbills');
    }
    public function viewallbills(Request $request)
    {
      
       if (Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='ADMIN') {
         $bills=billheader::where('id','>',0);
          }
         else
          {
           $bills=billheader::where('userid',Auth::id());
          }
            if($request->has('company') && $request->has('status') && $request->has('year'))
             {
                  if ($request->company!='') {
                     $bills=$bills->where('company',$request->company);
                  }
                  if($request->status!='')
                  {
                       $bills=$bills->where('status',$request->status);
                  }
                  if($request->year!='')
                  {
                       $bills=$bills->where('invyear',$request->year);
                  }

             }
          $bills=$bills->get();
      
     
       return view('viewallbills',compact('bills'));
    }
   public function viewallbillsacc(Request $request)
    {

            $bills=billheader::where('id','>','0');
             if($request->has('company') && $request->has('status') && $request->has('year'))
             {
                  if ($request->company!='') {
                     $bills=$bills->where('company',$request->company);
                  }
                  if($request->status!='')
                  {
                       $bills=$bills->where('status',$request->status);
                  }
                    if($request->year!='')
                  {
                       $bills=$bills->where('invyear',$request->year);
                  }
             }
          $bills=$bills->get();
   
      

       return view('accounts.viewallbills',compact('bills'));
    }
    public function savebill(Request $request)
    {
           $invoicedate=date("Y-m-d");
       
      $invdate=$invoicedate." 00:00:00";
      $year =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->year;
      $month =Carbon::createFromFormat('Y-m-d H:i:s', $invdate)->month;

      if($month<4)
      {
           $invyear=$year-1;

           $year1 = substr( $year, -2);

           $billyear=$invyear."-".$year1;
           $billyear1=substr( $invyear, -2).$year1;
           
      }
      else
      {
            $invyear=$year+1;
            $year1=substr( $invyear, -2);
            $billyear=$year.'-'.$year1;
            $billyear1=substr( $year, -2).$year1;

      }
       // return $billyear;
      $chk=invoiceno::where('invyear',$billyear)->where('company',$request->company)->orderBy('id','DESC')->first();
      
      
      if($chk)
      {
         $invnoget=$chk->invno;
         $invno=$invnoget+1;
      }
      else
      {
          $invno=1;
      }

      $num = $invno;
      $numlength = strlen((string)$num);
      if($numlength==1)
       {
          $fullinvno=$request->company.$billyear1."000".$invno;
       }
       elseif ($numlength==2) {
            $fullinvno=$request->company.$billyear1."00".$invno;
       }
       elseif ($numlength==3) {
           $fullinvno=$request->company.$billyear1."0".$invno;
       }
       else
       {
           $fullinvno=$request->company.$billyear1.$invno;
       }

      $billheader=new billheader();
      $billheader->projectid=$request->projectid;
     // $billheader->fullinvno=$fullinvno;
      $billheader->clientname=$request->clientname;
      $billheader->email=$request->email;
      $billheader->gstno=$request->gstno;
      $billheader->panno=$request->panno;
      $billheader->contactno=$request->contactno;
      $billheader->fax=$request->fax;
      $billheader->bankid=$request->bankid;
      $billheader->nameofthework=$request->nameofthework;
      $billheader->address=$request->address;
      //$billheader->invoicedate=$invoicedate;
      $billheader->refno=$request->refno;
      $billheader->refdate=$request->refdate;
      $billheader->status='PENDING';
      $billheader->cgstrate=$request->cgstrate;
      $billheader->cgstvalue=$request->cgstvalue;
      $billheader->sgstrate=$request->sgstrate;
      $billheader->sgstvalue=$request->sgstvalue;
      $billheader->igstrate=$request->igstrate;
      $billheader->igstvalue=$request->igstvalue;
      $billheader->total=$request->total;
      $billheader->totalpayable=$request->totalpayable;
      $billheader->advancepayment=$request->advancepayment;
      $billheader->netpayable=$request->netpayable;
      //$billheader->invyear=$billyear;
      //$billheader->invno=$invno;
      $billheader->company=$request->company;
      $billheader->claimedrate=$request->claimedrate;
      $billheader->claimedvalue=$request->claimedvalue;
      $billheader->discounttype=$request->discounttype;
      $billheader->discount=$request->discount;
      $billheader->discountvalue=$request->discountvalue;
      $billheader->userid=Auth::id();

      $billheader->save();

      $billid=$billheader->id;

       /*$invoiceno=new invoiceno();
      $invoiceno->billid=$billid;
      $invoiceno->invyear=$billyear;
      $invoiceno->invno=$invno;
      $invoiceno->company=$request->company;
      $invoiceno->save();*/

      $count=count($request->workdetails);

      for ($i=0; $i <$count ; $i++) { 
        $billitem=new billitem();
        $billitem->headerid=$billid;
        $billitem->slno=$request->slno[$i];
        $billitem->workdetails=$request->workdetails[$i];
        $billitem->hsn=$request->hsn[$i];
        $billitem->unit=$request->unit[$i];
        $billitem->rate=$request->rate[$i];
        $billitem->quantity=$request->qty[$i];
        $billitem->amount=$request->amount[$i];
        $billitem->save();

      }


      return back();
    }

      public function pdf()
  {
      $pdf = PDF::loadView('mail.abc');

      return $pdf->download('invoice.pdf');
  }
    public function showattendance(Request $request)
    {
         if (Auth::user()->usertype=='MASTER ADMIN') {
             $users=User::all();
         }
         else
         {
             $auth=Auth::id();
                 $myusers=userunderhod::select('userunderhods.userid')->where('hodid',$auth)->get();
             $users=User::whereIn('id',$myusers)->get();
         }
          
           $all=array();
          foreach ($users as $key => $user) {
              $uid=$user->id;
              $uname=$user->name;
             
                $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$request->date.' 00:00:00')
                 ->where('created_at', '<=',$request->date.' 23:59:59')
                 ->get();
                 
                 
              
             
              
              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }
              $a=array('uid'=>$uid,'uname'=>$uname,'present'=>$present);
              $all[]=$a;
          }

          return response()->json($all);
    }
    public function viewattendance(Request $request)
    {

         $all=array();
         if ($request->has('date')) {
             if (Auth::user()->usertype=='MASTER ADMIN') {
             $users=User::where('active','1')->get();
         }
         else
         {
             $auth=Auth::id();
                 $myusers=userunderhod::select('userunderhods.userid')->where('hodid',$auth)->get();
             $users=User::whereIn('id',$myusers)
                       ->where('active','1')
                       ->get();
         }
          
           
          foreach ($users as $key => $user) {
              $uid=$user->id;
              $uname=$user->name;
             
                $p=attendance::where('userid',$uid)
                 ->where('created_at', '>=',$request->date.' 00:00:00')
                 ->where('created_at', '<=',$request->date.' 23:59:59')
                 ->get();
                 
                 
              
             
              
              if(count($p)>0)
              {
                $present='PRESENT';
              }
              else
              {
                 $present='ABSENT';
              }
              $a=array('uid'=>$uid,'uname'=>$uname,'present'=>$present);
              $all[]=$a;
          }
           
         }
         $dt=$request->date;
         return view('viewattendance',compact('all','dt'));
    }

    public function paidamounts()
    {
          $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','projects.projectname')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
             ->where('requisitionpayments.paymenttype','!=','WALLET')
              ->where('requisitionheaders.employeeid',Auth::id())
             ->get();
        
          return view('paidamounts',compact('requisitionpayments'));

    }

    public function expensereport(Request $request)
    {

                   $expenseentries=expenseentry::select('expenseentries.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name')
                         ->leftJoin('users','expenseentries.employeeid','=','users.id')
                         ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                         ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                         ->where('expenseentries.towallet','=','NO')
                         /*->where('expenseentries.status','!=','CANCELLED')*/
                         ->groupBy('expenseentries.id');
$searchcount=0;
  if($request->has('fromdate') && $request->has('todate') && $request->fromdate!='' && $request->todate!='')
  {

  $str= carbon::parse($request['fromdate']." 00:00:00");
  $end= carbon::parse($request['todate']." 23:59:59"); 

      $expenseentries->whereRaw("expenseentries.created_at >= ? AND expenseentries.created_at <= ?",array($str, $end));
       //return $str .'-----'.$end;
        $searchcount=$searchcount+1;
  }

 if ($request->has('user') && $request->user !='')
  {
        $expenseentries->where('expenseentries.employeeid', $request->user);
        $searchcount=$searchcount+1;
  }
if($request->has('projectname') && $request->projectname!='')
{
       $expenseentries->where('expenseentries.projectid', $request->projectname);
       $searchcount=$searchcount+1;
}
if($request->has('expenseheadname') && $request->expenseheadname!='')
{
       $expenseentries->where('expenseentries.expenseheadid', $request->expenseheadname);
       $searchcount=$searchcount+1;
}
if($request->has('status') && $request->status!='')
{
       $expenseentries->where('expenseentries.status', $request->status);
       $searchcount=$searchcount+1;
}

    $expenseentries = $expenseentries->get();
                        
        $users=User::all();
        $projects=project::all();
        $expenseheads=expensehead::all();
 //return $expenseentries;
   return view('expensereport',compact('expenseentries','users','projects','expenseheads','searchcount'));

    }

    public function transactionreport(Request $request)
    {
           $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','projects.projectname')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
             ->where('requisitionpayments.paymenttype','!=','WALLET');
           
      $searchcount=0;
  if($request->has('fromdate') && $request->has('todate') && $request->fromdate!='' && $request->todate!='')
  {

  $str= carbon::parse($request['fromdate']." 00:00:00");
  $end= carbon::parse($request['todate']." 23:59:59"); 

        $requisitionpayments->whereRaw("requisitionpayments.created_at >= ? AND requisitionpayments.created_at <= ?",array($str, $end));
       //return $str .'-----'.$end;
        $searchcount=$searchcount+1;
  }

 if ($request->has('user') && $request->user !='')
  {
        $requisitionpayments->where('requisitionheaders.employeeid', $request->user);
        $searchcount=$searchcount+1;
  }
if($request->has('projectname') && $request->projectname!='')
{
       $requisitionpayments->where('requisitionheaders.projectid', $request->projectname);
       $searchcount=$searchcount+1;
}

if($request->has('status') && $request->status!='')
{
       $requisitionpayments->where('requisitionpayments.paymentstatus', $request->status);
       $searchcount=$searchcount+1;
}

    $requisitionpayments = $requisitionpayments->get();
            

       $users=User::all();
       $projects=project::all();
    
        return view('transactionreport',compact('requisitionpayments','users','projects','searchcount'));
    }
    public function adminviewalltourapplications()
    {
        $tours=$tours=tour::select('tours.*','users.name')
                ->leftJoin('users','tours.empid','=','users.id')
                 ->get();
          return view('adminviewalltourapplications',compact('tours'));
    }
    public function cancelledtourapplications()
    {
          $tours=tour::select('tours.*','users.name')
              ->leftJoin('users','tours.empid','=','users.id')
                 ->where('status','CANCELLED')
                 ->get();
           return view('cancelledtourapplications',compact('tours'));
    }

    public function approvedtourapplications()
    {
        $tours=tour::select('tours.*','users.name')
              ->leftJoin('users','tours.empid','=','users.id')
              ->where('status','APPROVED')
              ->get();

        return view('approvedtourapplications',compact('tours'));
    }

    public function canceltour(Request $request)
    {
        $tour=tour::find($request->canceltid);
          $tour->remarks=$request->remarks;
          $tour->status='CANCELLED';
          $tour->cancelledby=Auth::id();
          $tour->save();

          return back();
    }
    
    public function approvetour(Request $request)
    {
          $tour=tour::find($request->approvetid);
          $tour->remarks=$request->remarks;
          $tour->status='APPROVED';
          $tour->approvedby=Auth::id();
          $tour->save();

          return back();
    }
    public function pendingtourapplications()
    {
            $tours=tour::select('tours.*','users.name')
                  ->leftJoin('users','tours.empid','=','users.id')
                  ->where('status','PENDING')
                  ->get();

            return view('pendingtourapplications',compact('tours'));
    }

    public function updatetourapplication(Request $request)
    {
          $tour=tour::find($request->tid);
          $tour->fromplace=$request->fromplace;
          $tour->toplace=$request->toplace;
          $tour->empid=Auth::id();
          $tour->fromdate=$request->fromdate;
          $tour->todate=$request->todate;
          $tour->description=$request->description;
          $tour->save();
          Session::flash('message','Your Application Updated Successfully');
          
          return back();
    }
    public function viewmytourapplications()
    {
          $tours=tour::where('empid',Auth::id())->get();

          return view('viewmytourapplication',compact('tours'));
    }
     public function savetourapplication(Request $request)
     {
          $tour=new tour();
          $tour->fromplace=$request->fromplace;
          $tour->toplace=$request->toplace;
          $tour->empid=Auth::id();
          $tour->fromdate=$request->fromdate;
          $tour->todate=$request->todate;
          $tour->description=$request->description;
          $tour->save();
          Session::flash('message','Your Application Submitted Successfully');

          return back();
     }
    public function userlocation($uid,$date)
    {

        $user=User::find($uid);
        $uname=$user->name;
        return view('userlocations',compact('uid','date','uname'));
    }

    public function getuserlocation(Request $request)
    {
         $userlocations=attendance::select('attendances.*','users.name')
                        ->leftJoin('users','attendances.userid','=','users.id')
                        ->where('attendances.userid',$request->uid)
                        ->where('attendances.created_at', '>=',$request->date.' 00:00:00')
                        ->where('attendances.created_at', '<=',$request->date.' 23:59:00')

                        ->get();
         
         return response()->json($userlocations);
    }
    public function projectwisepaymentreports()
    {
        $projectwisepaymentreports=array();
        $projects=project::all();
        foreach ($projects as $key => $project) {
               $requisitionheader=requisitionheader::where('projectid',$project->id)
                      
                        ->where(function($query){
                         $query->where('status','!=','PENDING');
                         $query->orWhere('status','!=','CANCELLED');
                         
                       })
                        ->get();
               $payment=$requisitionheader->sum('approvalamount');
                $workordervalue=$project->cost;

                $requisitionpayments=requisitionpayment::select('requisitionpayments.*','users.name','projects.projectname')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
             ->where('requisitionpayments.paymenttype','!=','WALLET')
             ->where('requisitionheaders.projectid',$project->id)
             ->get();
             $reqpayments=$requisitionpayments->sum('amount');

             $approamt=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name','requisitionheaders.datefrom','requisitionheaders.dateto')
                         ->leftJoin('requisitionheaders','requisitions.requisitionheaderid','=','requisitionheaders.id')
                         ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                         ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
                         ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                         ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                         ->where('requisitionpayments.paymentstatus','PAID')
                         ->where('requisitionpayments.paymenttype','!=','WALLET')
                         ->where('requisitions.approvestatus','!=','PENDING')
                         ->where('requisitions.approvestatus','!=','CANCELLED')
                         ->groupBy('requisitions.id')
                         ->where('projects.id', $project->id)
                         ->get();
           
              $totapprovalamt=$approamt->sum('approvedamount');
               $exp=expenseentry::select('expenseentries.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name')
                         ->leftJoin('users','expenseentries.employeeid','=','users.id')
                         ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                         ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                         ->where('expenseentries.towallet','=','NO')
                         ->where('expenseentries.status','!=','CANCELLED')
                         ->groupBy('expenseentries.id')
                         ->where('expenseentries.projectid', $project->id)
                         ->get();
                $expamt=$exp->sum('approvalamount');


               $all=array('projectid'=>$project->id,'projectname'=>$project->projectname,'clientname'=>$project->clientname,'amount'=>$payment,'workordervalue'=>$workordervalue,'paidamount'=>$reqpayments,'approvalamount'=>$totapprovalamt,'expamt'=>$expamt);

                $projectwisepaymentreports[]=$all;
               

        }
         $requisitionheader1=requisitionheader::where('projectid','OTHERS')
                         ->where(function($query){
                         $query->where('status','!=','PENDING');
                         $query->orWhere('status','!=','CANCELLED');
                         
                       })
                        ->get();
           $payment1=$requisitionheader1->sum('approvalamount');
           $requisitionpayments1=requisitionpayment::select('requisitionpayments.*','users.name','projects.projectname')
             ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
             ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
             ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
             ->where('requisitionpayments.paymenttype','!=','WALLET')
             ->where('requisitionheaders.projectid', 'OTHERS')
             ->get();
             $reqpayments1=$requisitionpayments1->sum('amount');
              $approamt1=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name','requisitionheaders.datefrom','requisitionheaders.dateto')
                         ->leftJoin('requisitionheaders','requisitions.requisitionheaderid','=','requisitionheaders.id')
                         ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                         ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
                         ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                         ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                         ->where('requisitionpayments.paymentstatus','PAID')
                         ->where('requisitionpayments.paymenttype','!=','WALLET')
                         ->where('requisitions.approvestatus','!=','PENDING')
                         ->where('requisitions.approvestatus','!=','CANCELLED')
                         ->groupBy('requisitions.id')
                         ->where('projects.id','OTHERS')
                         ->get();
              $totapprovalamt1=$approamt1->sum('approvedamount');

                $exp1=expenseentry::select('expenseentries.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name')
                         ->leftJoin('users','expenseentries.employeeid','=','users.id')
                         ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                         ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                         ->where('expenseentries.towallet','=','NO')
                         ->where('expenseentries.status','!=','CANCELLED')
                         ->groupBy('expenseentries.id')
                         ->where('expenseentries.projectid','OTHERS')
                         ->get();
                $expamt1=$exp1->sum('approvalamount');

           $all1=array('projectid'=>'0','projectname'=>'OTHERS','clientname'=>'OTHERS','amount'=>$payment1,'workordervalue'=>0,'paidamount'=>$reqpayments1,'approvalamount'=>$totapprovalamt1,'expamt'=>$expamt1);

            $projectwisepaymentreports[]=$all1;
      

        return view('projectwisepaymentreports',compact('projectwisepaymentreports'));
    }
    public function userwisepaymentreports()
    {

            $userwisepayments=array();
            $users=User::all();
            foreach ($users as $key => $user) {
                
                $name=$user->name;
                       $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',$user->id)
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',$user->id)
                ->where('towallet','!=','YES')
                ->get();
        $totalamtentry=$entries->sum('approvalamount');
        $wallet=wallet::where('employeeid',$user->id)
        ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;
         
          $bal=($totalamt-$totalamtentry)-$walletbalance;

        $all=array('id'=>$user->id,'name'=>$user->name,'totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal,'walletbalance'=>$walletbalance);
       $userwisepayments[]=$all;
            }

         
            return view('userwisepaymentreports',compact('userwisepayments'));
    }
    public function paymentreports(Request $request)
    {
          /*   $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->groupBy('requisitionpayments.id')
                      ->get();*/

             $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname','users.name','requisitionheaders.datefrom','requisitionheaders.dateto')
                         ->leftJoin('requisitionheaders','requisitions.requisitionheaderid','=','requisitionheaders.id')
                         ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                         ->leftJoin('users','requisitionheaders.employeeid','=','users.id')
                         ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                         ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                         ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                         ->where('requisitionpayments.paymentstatus','PAID')
                         ->where('requisitionpayments.paymenttype','!=','WALLET')
                         ->where('requisitions.approvestatus','!=','PENDING')
                         ->where('requisitions.approvestatus','!=','CANCELLED')
                         ->groupBy('requisitions.id');
$searchcount=0;
  if($request->has('fromdate') && $request->has('todate') && $request->fromdate!='' && $request->todate!='')
  {

  $str= carbon::parse($request['fromdate']." 00:00:00");
  $end= carbon::parse($request['todate']." 23:59:59"); 

        $requisitions->whereRaw("requisitions.created_at >= ? AND requisitions.created_at <= ?",array($str, $end));
       //return $str .'-----'.$end;
        $searchcount=$searchcount+1;
  }

 if ($request->has('user') && $request->user !='')
  {
        $requisitions->where('users.id', $request->user);
        $searchcount=$searchcount+1;
  }
if($request->has('projectname') && $request->projectname!='')
{
       $requisitions->where('projects.id', $request->projectname);
       $searchcount=$searchcount+1;
}
if($request->has('expenseheadname') && $request->expenseheadname!='')
{
       $requisitions->where('requisitions.expenseheadid', $request->expenseheadname);
       $searchcount=$searchcount+1;
}

    $requisitions = $requisitions->get();
                        
        $users=User::all();
        $projects=project::all();
        $expenseheads=expensehead::all();
 //return $requisitions;
   return view('paymentreports',compact('requisitions','users','projects','expenseheads','searchcount'));
       

    }


    public function viewwallet()
    {
            $wallets=wallet::where('employeeid',Auth::id())
                    ->get();

           return view('viewwallet',compact('wallets'));
    }
    public function changecomplaintlastdate(Request $request)
    {
         $complaint=complaint::find($request->cid);
         $complaint->lastdate=$request->approvaldate;
         $complaint->status='PENDING';
         $complaint->save();

         return back();
    }

    public function saverequisitionvendor(Request $request,$id)
    {
     $vendor=new vendor();
     $vendor->vendorname=$request->vendorname;
     $vendor->mobile=$request->mobile;
     $vendor->details=$request->details;
      $vendor->bankname=$request->bankname;
      $vendor->acno=$request->acno;
     $vendor->branchname=$request->branchname;
     $vendor->ifsccode=$request->ifsccode;
     $vendor->userid=Auth::id();
     
     
      $rarefile = $request->file('vendoridproof');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendor/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->vendoridproof = $rarefilename;
        }

         $rarefile1 = $request->file('photo');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendor/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->photo = $rarefilename1;
        }
        
        $vendor->save();

        $vid=$vendor->id;

        $requisition=requisition::find($id);
        $requisition->vendorid=$vid;
        $requisition->save();

        $reqid=$requisition->requisitionheaderid;

        $countreqvendor=requisition::where('requisitionheaderid',$reqid)
                       ->where('payto','TO VENDOR')
                       ->count();
        $countreqvendor1=requisition::where('requisitionheaderid',$reqid)
                       ->where('payto','TO VENDOR')
                       ->whereNotNull('vendorid')
                       ->count();
        $diff=$countreqvendor-$countreqvendor1;

        if($diff=='0')
        {
              $requisitionheader=requisitionheader::find($reqid);
              $requisitionheader->status='PENDING MGR';
              $requisitionheader->save();
        }
        
        
       return redirect('/useraccounts/requisitionvendors');
    }
    public function addexsitingvendor(Request $request,$id)
    {

      $vid=$request->existingvendorid;
      $requisition=requisition::find($id);
        $requisition->vendorid=$vid;
        $requisition->save();

        $reqid=$requisition->requisitionheaderid;

        $countreqvendor=requisition::where('requisitionheaderid',$reqid)
                       ->where('payto','TO VENDOR')
                       ->count();
        $countreqvendor1=requisition::where('requisitionheaderid',$reqid)
                       ->where('payto','TO VENDOR')
                       ->whereNotNull('vendorid')
                       ->count();
        $diff=$countreqvendor-$countreqvendor1;

        if($diff=='0')
        {
              $requisitionheader=requisitionheader::find($reqid);
              $requisitionheader->status='PENDING MGR';
              $requisitionheader->save();
        }

        return redirect('/useraccounts/requisitionvendors');
    }

    public function addvendordetails($id)
    { 

         $vendors=vendor::where('userid',Auth::id())->get();
         return view('addvendordetails',compact('id','vendors'));
    }
    public function requisitionvendors()
    {
            $requisitionvendors=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname')
                               ->where('requisitions.payto','TO VENDOR')
                               ->where('requisitions.userid',Auth::id())

                               ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                               ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                               ->leftJoin('requisitionheaders','requisitions.requisitionheaderid','=','requisitionheaders.id')

                                ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                                ->whereNull('vendorid')
                               
                                 ->get();
           // return $requisitionvendors;
          return view('requisitionvendors',compact('requisitionvendors'));
    }
   
    public function tourapprovalapplication()
     {
          return view('tourapprovalapplication');
     }


      public function upadtevehicledetails(Request $request)
      {
           $vehicle=vehicle::find($request->vid);
         $vehicle->vehicletype=$request->vehicletype;
         $vehicle->vehiclename=$request->vehiclename;
         $vehicle->vehicleno=$request->vehicleno;
         $vehicle->drivername=$request->drivername;
         $vehicle->drivermobile=$request->drivermobile;
         $vehicle->userid=Auth::id();
         $rarefile = $request->file('vehicleimage');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vehicle/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vehicle->vehicleimage = $rarefilename;
        }

         $rarefile1 = $request->file('rcimage');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vehicle/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vehicle->rcimage = $rarefilename1;
        }

        $vehicle->save();
         Session::flash('msg','Vehicle Detail Update Successfully');
        return back();
      }

     public function savevehicledetails(Request $request)
     {
         $vehicle=new vehicle();
         $vehicle->vehicletype=$request->vehicletype;
         $vehicle->vehiclename=$request->vehiclename;
         $vehicle->vehicleno=$request->vehicleno;
         $vehicle->drivername=$request->drivername;
         $vehicle->drivermobile=$request->drivermobile;
         $vehicle->userid=Auth::id();
         $rarefile = $request->file('vehicleimage');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vehicle/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vehicle->vehicleimage = $rarefilename;
        }
        $rarefile1 = $request->file('rcimage');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vehicle/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vehicle->rcimage = $rarefilename1;
        }

        $vehicle->save();
        Session::flash('msg','Vehicle Detail added Successfully');
        return back();

     }
     public function vehicles()
     {
         $vehicles=vehicle::where('userid',Auth::id())->get();
         return view('vehicles',compact('vehicles'));
     }
    public function updatelabour(Request $request)
    {
        $labour=labour::find($request->lid);
          $this->validate($request,[
            'labourname' => 'required|string|max:255',
           'mobile'=>'required|string|min:10|max:10',


       ]);
        $labour->labourname=$request->labourname;
        $labour->address=$request->address;
        $labour->mobile=$request->mobile;
       
        $labour->save();

        Session::flash('msg','Labour information Updated Successfully');
         return back();
    }
    public function savelabour(Request $request)
    {

        $labour=new labour();
         $user=new User();
       $this->validate($request,[
            'labourname' => 'required|string|max:255',
           


       ]);

        $labour->labourname=$request->labourname;
        $labour->address=$request->address;
        $labour->mobile=$request->mobile;
        $labour->userid=Auth::id();
        $labour->save();

        Session::flash('msg','Labour information saved Successfully');
         return back();
    }
    public function labours()
    {
        $labours=labour::where('userid',Auth::id())->get();
         return view('labours',compact('labours'));
    }
    public function updatesubrequisitions(Request $request)
    {
          $requisition=requisition::find($request->editid);
          $requisition->expenseheadid=$request->expid;
          $requisition->particularid=$request->partid;
          $requisition->description=$request->description2;
          $requisition->payto=$request->payto1;
          $requisition->amount=$request->amount2;
          $requisition->save();


          return back();

    }
    public function savenotification(Request $request)
    {
       $notification=new notification();
       $notification->description=$request->description;
       $notification->type=$request->type;
       $notification->paymentalert=$request->paymentalert;
       $notification->save();

       $nid=$notification->id;
       $count=count($request->users);
        for ($i=0; $i < $count ; $i++) { 
       $usernotification=new usernotification();
       $usernotification->nid=$nid;
       $usernotification->user=$request->users[$i];
       $usernotification->save();
        }
      
     return back();
       
    }
    public function createnotification()
    {

         $users=User::all();
         return view('createnotification',compact('users'));
    }
 public function updaterequisitions(Request $request,$id)
    {

        $requisitionheader=requisitionheader::find($id);
        $requisitionheader->description=$request->description1;
        $requisitionheader->employeeid=Auth::id();
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
         $requisitionheader->totalamount=$request->totalamt;
          $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->userid=Auth::id();
        $requisitionheader->save();
        $rid=$requisitionheader->id;

        requisition::where('requisitionheaderid',$id)->delete();
        $count=count($request->expenseheadid);

        for ($i=0; $i < $count ; $i++) { 
           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
           $requisition->save();
        }

        Session::flash('msg','Requisition Updated Successfully');

        return redirect('/useraccounts/viewapplicationform');

    }
     public function editrequisition($id)
   {
          $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

          $requisitionheader=requisitionheader::find($id);
          $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();

         return view('editrequisition',compact('users','expenseheads','particulars','projects','requisitionheader','requisitions'));
   }
     public function viewapplicationdetails($id)
     {
           $paidamounts=requisitionpayment::where('rid',$id)->get();
             $requisitionheader=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname','u4.name as cancelledbyname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                       ->leftJoin('users as u4','requisitionheaders.cancelledby','=','u4.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.id',$id)
                      ->first();
           
           $requisitions=requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','vendors.id as vendorid','vendors.vendorname','vendors.mobile','vendors.details','vendors.bankname','vendors.acno','vendors.branchname','vendors.ifsccode','vendors.photo','vendors.vendoridproof')
                       ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                       ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                       ->leftJoin('vendors','requisitions.vendorid','=','vendors.id')
                       ->where('requisitions.requisitionheaderid',$id)
                       ->get();


          return view('viewapplicationdetails',compact('requisitionheader','requisitions','paidamounts'));  
     }
     public function viewapplicationform(Request $request)
    {

        $requisitions=requisitionheader::select('requisitionheaders.*','u1.name as employee','u2.name as author','u3.name as approver','projects.projectname')
                      ->leftJoin('users as u1','requisitionheaders.employeeid','=','u1.id')
                      ->leftJoin('users as u2','requisitionheaders.userid','=','u2.id')
                      ->leftJoin('users as u3','requisitionheaders.approvedby','=','u3.id')
                      ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                      ->where('requisitionheaders.employeeid',Auth::id())
                      ->get();

        return view('viewapplicationform',compact('requisitions'));
    }
     public function saverequisitions(Request $request)
    {
        

        $requisitionheader=new requisitionheader();
        $requisitionheader->employeeid=Auth::id();
         $requisitionheader->description=$request->description1;
        $requisitionheader->projectid=$request->projectid;
        $requisitionheader->totalamount=$request->totalamt;
        $requisitionheader->datefrom=$request->datefrom;
        $requisitionheader->dateto=$request->dateto;
        $requisitionheader->userid=Auth::id();
        if(Auth::user()->usertype=='ADMIN')
        {
           $requisitionheader->status="PENDING MGR";
        }
        else
        {
            $requisitionheader->status="PENDING HOD";
        }
        $requisitionheader->save();
        $rid=$requisitionheader->id;
        $count=count($request->expenseheadid);
        $countvendor=0;
        for ($i=0; $i < $count ; $i++) { 

          if($request->payto[$i]=='TO VENDOR')
          {
               $countvendor=$countvendor+1;
          }
          else
          {
                 $countvendor=$countvendor+0;
          }


           $requisition=new requisition();
           $requisition->expenseheadid=$request->expenseheadid[$i];
           $requisition->particularid=$request->particularid[$i];
           $requisition->description=$request->description[$i];
           $requisition->payto=$request->payto[$i];
           $requisition->amount=$request->amount[$i];
           $requisition->requisitionheaderid=$rid;
            $requisition->userid=Auth::id();
           $requisition->save();


        }
           if($countvendor>0)
           {
             $requisitionheader1=requisitionheader::find($rid);
           $requisitionheader1->status='VENDOR PENDING';
           $requisitionheader1->save();
           }
          



        Session::flash('msg','Requisition Saved Successfully');

        return back();

    }
        public function applicationform()
    {
            

           $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',Auth::id())
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',Auth::id())
                ->where('towallet','!=','YES')
                ->get();
          $totalamtentry=$entries->sum('approvalamount');
           $wallet=wallet::where('employeeid',Auth::id())
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
          

        $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();

        $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();

        return view('applicationform',compact('users','projects','expenseheads','totalamt','bal','totalamtentry','walletbalance'));
    }
     public function viewallexpenseentry()
     {
       $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.employeeid',Auth::id())
                      ->groupBy('expenseentries.id')
                      ->get();
         $expenseentries1=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname','u3.name as approvedbyname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('users as u3','expenseentries.approvedby','=','u3.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.employeeid',Auth::id())
                       ->where('expenseentries.status','=','WALLET PAID')
                      ->groupBy('expenseentries.id')
                      ->get();
      return view('viewallexpenseentry',compact('expenseentries','expenseentries1'));
     }
     public function updateexpenseentry(Request $request,$id)
       {
       $expenseentry=expenseentry::find($id);
       $expenseentry->employeeid=Auth::id();
       $expenseentry->projectid=$request->projectid;
       $expenseentry->expenseheadid=$request->expenseheadid;
       $expenseentry->particularid=$request->particularid;
       $expenseentry->vendorid=$request->vendorid;
       $expenseentry->amount=$request->amount;
       $expenseentry->userid=Auth::id();
        $rarefile = $request->file('uploadedfile');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/expenseuploadedfile/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $expenseentry->uploadedfile = $rarefilename;
        }
       $expenseentry->save();
       Session::flash('msg','Expense Entry Updated Successfully');

       return redirect('/useraccounts/viewallexpenseentry');
       }
     public function editexpenseentry($id)
       {  
         $expenseentry=expenseentry::find($id);
            $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();
        $users=User::all();
        $expenseheads=expensehead::all();
        $particulars=particular::all();
         $vendors=vendor::all();

          return view('editexpenseentry',compact('projects','users','expenseheads','expenseentry','particulars','vendors'));
       }
       public function viewexpenseentrydetails($id)
      {   
           

          $expenseentry=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                       ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                       ->where('expenseentries.id',$id)
                      
                      ->groupBy('expenseentries.id')
                      ->first();
          //return $expenseentry;

          $vendor=vendor::select('vendors.*','users.name')
            ->leftJoin('users','vendors.userid','=','users.id')
            ->where('vendors.id',$expenseentry->vendorid)
            ->first();
      $engagedlaboursarr=array();
           if($expenseentry->type=='LABOUR PAYMENT' && $expenseentry->version=='NEW')
           {
                $expenseentrydailylabour=expenseentrydailylabour::select('dailylabours.*')
                                 ->leftJoin('dailylabours','expenseentrydailylabours.dailylabourid','=','dailylabours.id')
                                 ->where('expenseid',$expenseentry->id)
                                 ->get();
                     foreach ($expenseentrydailylabour as $key => $dailylabour) {
            $nooflabour=engagedlabour::where('dailylabourid',$dailylabour->id)->count();
            $engagedlaboursarr[]=[
              'id'=>$dailylabour->id,
              'date'=>$dailylabour->date,
              'description'=>$dailylabour->description,
              'labourimage'=>$dailylabour->workingimage,
              'nooflabour'=>$nooflabour,
            ];
        }

           }
           elseif ($expenseentry->type=='VEHICLE PAYMENT' && $expenseentry->version=='NEW') {

                  $expenseentrydailyvehicle=expenseentrydailyvehicle::select('dailyvehicles.*','vehicles.vehiclename','vehicles.vehicleno')
                                   ->leftJoin('dailyvehicles','expenseentrydailyvehicles.dailyvehicleid','=','dailyvehicles.id')
                                   ->leftJoin('vehicles','dailyvehicles.vehicleid','=','vehicles.id')
                                   ->where('expenseid',$expenseentry->id)
                                   ->get();
           }
           else
           {
               $expenseentrydailylabour=array();
               $expenseentrydailyvehicle=array();

           }
       
        
          //return $engagedlaboursarr;
          return view('viewexpenseentrydetails',compact('expenseentry','vendor','expenseentrydailylabour','expenseentrydailyvehicle','engagedlaboursarr'));
      }
      public function saveexpenseentry(Request $request)
     {

        
        if($request->bala1<0)
        {
             Session::flash('msg','Balance amount cant be negetive');
             return back();
        }
        else
        {

           if($request->type=='OTHERS')
           {
               $checkprvs=expenseentry::where('userid',Auth::id())
                        ->where('expenseheadid',$request->expenseheadid)
                        ->where('projectid',$request->projectid)
                        ->where('date',$request->date)
                        ->where('status','!=','CANCELLED')
                        ->count();
               if($checkprvs>0 && $request->towallet=='NO')
               {
                  Session::flash('msg','Failed  Expense entry for this Expensehead Already Exist');
                  return back();
               }
               else
               {
                  $expenseentry=new expenseentry();
                  $expenseentry->employeeid=Auth::id();
                  $expenseentry->projectid=$request->projectid;
                  $expenseentry->expenseheadid=$request->expenseheadid;
                  $expenseentry->particularid=$request->particularid;
                  $expenseentry->vendorid=$request->vendorid;
                  $expenseentry->amount=$request->amount;
                  $expenseentry->approvalamount=$request->amount;
                  $expenseentry->description=$request->description;
                  /*$expenseentry->fromdate=$request->fromdate;
                  $expenseentry->todate=$request->todate;*/
                  if (Auth::user()->usertype=='ADMIN') {
                     $expenseentry->status="PENDING";
                  }
                  $expenseentry->date=$request->date;
                  $expenseentry->version="NEW";
                  $expenseentry->type=$request->type;
                  $expenseentry->towallet=$request->towallet;
                  $expenseentry->userid=Auth::id();
                  $rarefile = $request->file('uploadedfile'); 
           
                   if($rarefile!=''){
                    $raupload = public_path() .'/img/expenseuploadedfile/';
                    $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                    $success=$rarefile->move($raupload,$rarefilename);
                    $expenseentry->uploadedfile = $rarefilename;
                     }
                 $expenseentry->save();
               }


           }
          elseif ($request->type=='LABOUR PAYMENT') {
               if (sizeof($request->dailylabour)>0) {
                       $expenseentry=new expenseentry();
                  $expenseentry->employeeid=Auth::id();
                  $expenseentry->projectid=$request->projectid;
                  $expenseentry->expenseheadid=$request->expenseheadid;
                  $expenseentry->particularid=$request->particularid;
                  $expenseentry->vendorid=$request->vendorid;
                  $expenseentry->amount=$request->amount;
                  $expenseentry->approvalamount=$request->amount;
                  $expenseentry->description=$request->description;
                  $expenseentry->fromdate=$request->fromdate;
                  $expenseentry->todate=$request->todate;
                 /* $expenseentry->date=$request->date;*/
                  if (Auth::user()->usertype=='ADMIN') {
                     $expenseentry->status="PENDING";
                  }
                  $expenseentry->version="NEW";
                  $expenseentry->type=$request->type;
                  $expenseentry->towallet=$request->towallet;
                  $expenseentry->userid=Auth::id();
                  $expenseentry->save();
                  $eid=$expenseentry->id;
                  for ($i=0; $i < sizeof($request->dailylabour); $i++) { 
                     $expenseentrydailylabour=new expenseentrydailylabour();
                     $expenseentrydailylabour->expenseid=$eid;
                     $expenseentrydailylabour->dailylabourid=$request->dailylabour[$i];
                     $expenseentrydailylabour->save();

                  }

               }
               else
               {
                   Session::flash('No LABOUR Selected');
                   return back();
               }

           
          }
           else{
               if (sizeof($request->dailyvehicles)>0) {
                       $expenseentry=new expenseentry();
                  $expenseentry->employeeid=Auth::id();
                  $expenseentry->projectid=$request->projectid;
                  $expenseentry->expenseheadid=$request->expenseheadid;
                  $expenseentry->particularid=$request->particularid;
                  $expenseentry->vendorid=$request->vendorid;
                  $expenseentry->amount=$request->amount;
                  $expenseentry->approvalamount=$request->amount;
                  $expenseentry->description=$request->description;
                  $expenseentry->fromdate=$request->fromdate;
                  $expenseentry->todate=$request->todate;
                 /* $expenseentry->date=$request->date;*/
                  if (Auth::user()->usertype=='ADMIN') {
                     $expenseentry->status="PENDING";
                  }
                  $expenseentry->version="NEW";
                  $expenseentry->type=$request->type;
                  $expenseentry->towallet=$request->towallet;
                  $expenseentry->userid=Auth::id();
                  $expenseentry->save();
                  $eid=$expenseentry->id;
                  for ($i=0; $i < sizeof($request->dailyvehicles); $i++) { 
                     $expenseentrydailyvehicle=new expenseentrydailyvehicle();
                     $expenseentrydailyvehicle->expenseid=$eid;
                     $expenseentrydailyvehicle->dailyvehicleid=$request->dailyvehicles[$i];
                     $expenseentrydailyvehicle->save();
                     
                  }

               }
               else
               {
                   Session::flash('No Vehicle Selected');
                   return back();
               }

           
          }

   
         $expid=$expenseentry->id;

         $towalletchk=$expenseentry->towallet;
         $employeeid=$expenseentry->employeeid;
         if($towalletchk=='YES')
         {
             $wallet=new wallet();
             $wallet->employeeid=$employeeid;
             $wallet->credit=$request->amount;
             $wallet->debit='0';
             $wallet->rid=$expid;
             $wallet->addedby=Auth::id();
             $wallet->save();
             $expenseentry1=expenseentry::find($expid);
             $expenseentry1->status="WALLET PAID";
             $expenseentry1->save();
         }



       Session::flash('msg','Expense Entry Saved Successfully');
       return back();
        }
      
     

       

     }
      public function expenseentry()
     {
         
          $requisition=requisitionheader::select('requisitions.*','requisitionheaders.employeeid','requisitionpayments.amount as paidamt')
                      ->leftJoin('requisitionpayments','requisitionpayments.rid','=','requisitionheaders.id')
                       ->leftJoin('requisitions','requisitions.requisitionheaderid','=','requisitionheaders.id')
                       ->where('requisitionpayments.paymentstatus','PAID')
                       ->where('requisitionpayments.paymenttype','!=','WALLET')
                      ->where('requisitionheaders.employeeid',Auth::id())
                      ->groupBy('requisitionpayments.id')
                      ->get();
         
          $totalamt=$requisition->sum('paidamt');
        
        $entries=expenseentry::where('employeeid',Auth::id())
                ->where('towallet','!=','YES')
                ->get();

                 $wallet=wallet::where('employeeid',Auth::id())
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;
          $totalamtentry=$entries->sum('approvalamount');
          $bal=($totalamt-$totalamtentry)-$walletbalance;

          $all=array('totalamt'=>$totalamt,'totalexpense'=>$totalamtentry,'balance'=>$bal);
        

        $projects=requisitionpayment::select('requisitionpayments.*','projects.projectname','clients.orgname','projects.id as proid')
                          ->where('requisitionpayments.paymentstatus','PAID')
                          ->leftJoin('requisitionheaders','requisitionpayments.rid','=','requisitionheaders.id')
                          ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                          ->leftJoin('clients','projects.clientid','=','clients.id')
                          ->where('requisitionheaders.employeeid',Auth::id())
                          ->groupBy('requisitionheaders.projectid')
                          ->get();
        $vehicles=vehicle::where('userid',Auth::id())->get();
        $labours=labour::where('userid',Auth::id())->get();

      /*  $projects=project::select('projects.*','clients.orgname')
                ->leftJoin('clients','projects.clientid','=','clients.id')
                ->get();*/
        $users=User::all();
        $expenseheads=expensehead::all();
        $vendors=vendor::all();
        $expenseentries=expenseentry::select('expenseentries.*','u1.name as for','u2.name as by','projects.projectname','clients.clientname','expenseheads.expenseheadname','particulars.particularname','vendors.vendorname')
                      ->leftJoin('users as u1','expenseentries.employeeid','=','u1.id')
                      ->leftJoin('users as u2','expenseentries.userid','=','u2.id')
                      ->leftJoin('projects','expenseentries.projectid','=','projects.id')
                      ->leftJoin('clients','projects.clientid','=','clients.id')
                      ->leftJoin('expenseheads','expenseentries.expenseheadid','=','expenseheads.id')
                      ->leftJoin('particulars','expenseentries.particularid','=','particulars.id')
                      ->leftJoin('vendors','expenseentries.vendorid','=','vendors.id')
                      ->where('expenseentries.employeeid',Auth::id())
                      ->groupBy('expenseentries.id')
                      ->get();
        return view('expenseentry',compact('users','projects','expenseheads','expenseentries','vendors','vehicles','labours','totalamtentry','bal','walletbalance','totalamt'));
     }

    public function updatevendor(Request $request,$id)
   {
       $vendor=vendor::find($id);
        $vendor->vendorname=$request->vendorname;
     $vendor->mobile=$request->mobile;
     $vendor->details=$request->details;
      $vendor->bankname=$request->bankname;
      $vendor->acno=$request->acno;
     $vendor->branchname=$request->branchname;
     $vendor->ifsccode=$request->ifsccode;
  
     
     
      $rarefile = $request->file('vendoridproof');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/vendor/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $vendor->vendoridproof = $rarefilename;
        }

         $rarefile1 = $request->file('photo');    
        if($rarefile1!=''){
        $raupload1 = public_path() .'/img/vendor/';
        $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
        $success1=$rarefile1->move($raupload1,$rarefilename1);
        $vendor->photo = $rarefilename1;
        }

        $vendor->save();
        Session::flash('msg','vendor added successfully');

        return redirect('/useraccounts/managevendors');

   }
         public function editvendor($id)
   {
      $vendor=vendor::find($id);
      return view('edituservendor',compact('vendor'));
   }
        public function managevendors()
         {

         $vendors=vendor::select('vendors.*','users.name')
         ->leftJoin('users','vendors.userid','=','users.id')
         ->where('vendors.userid',Auth::id())
         ->get();
         return view('managevendors',compact('vendors'));
         }
        public function vendors()
         {  
           $vendors=vendor::all();
            return view('vendors',compact('vendors'));
         }
      public function deleterequest($id)
      {
          $userrequest=userrequest::find($id);
          $userrequest->delete();

          return back();

      }

      public function userviewallmytodo()
      {
           $todos=todo::where('userid',Auth::id())->get();

           return view('userviewallmytodo',compact('todos'));
      }
      public function adminapproverequest(Request $request)
      {
         $user=new User();

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username'=>'required|string|max:255|unique:users',

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
      }
      public function newuserrequest()
      {
          $userrequests=userrequest::where('status','1')->get();
          return view('newuserrequest',compact('userrequests'));
      }
      public function registerrequest(Request $request)
      {
           //return $request->all();
           $userrequest=new userrequest();
       $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users|unique:userrequests',
            'password' => 'required|confirmed|min:6',
            'username'=>'required|string|max:255|unique:users|unique:userrequests',
            'mobile'=>'required|string|min:10|max:10|unique:users|unique:userrequests',
       ]);
          
          $userrequest->name=$request->name;
          $userrequest->username=$request->username;
          $userrequest->email=$request->email;
          $userrequest->mobile=$request->mobile;
          $userrequest->password=bcrypt($request->password);
          $userrequest->pass=$request->password;
          $userrequest->save();
          Session::flash('message','You are Register Successfully');
          return back();
      }
      public function updatetodo(Request $request)
      {
         $todo=todo::find($request->tdid);
        
         $todo->description=$request->description;
         $todo->date=$request->date;
         $todo->time=date("H:i:s", strtotime($request->time));
         $todo->datetime=$request->date.' '.date("H:i:s", strtotime($request->time));
         $todo->save();
         return back();
      }
     public function deletemytodo($id)
     { 
          $todo=todo::where('id',$id)
                ->where('userid',Auth::id())
                ->delete();
          return back();
     }
     public function savetodo(Request $request)
     {
        
         $todo=new todo();
         $todo->userid=Auth::id();
         $todo->description=$request->description;
         $todo->date=$request->date;
         $todo->time=date("H:i:s", strtotime($request->time));
         $todo->datetime=$request->date.' '.date("H:i:s", strtotime($request->time));
         $todo->save();
         return back();
     }
    public function onlineusers()
    {
      $users=User::all();
      return view('onlineusers',compact('users'));
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

         
         return view('mymessages',compact('messages','users'));
    }
    public function usersendmessage(Request $request)
    {
         if($request->reciver!='Select a User')
         {
                $chat=new chat();
          $chat->sender=Auth::id();

          $chat->reciver=$request->reciver;
          $chat->message=$request->message;
          $rarefile = $request->file('attachment');
          if($rarefile!='')
        {
             $u=time().uniqid(rand());
        $raupload ="img/chatattachment";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $chat->attachment = $uplogoimg;
        $chat->attachmentrealname = $rarefile->getClientOriginalName();
        }

        $s1=Auth::id();//15
        $r1=$request->reciver;//13
        if($s1<$r1)
        {
            $cvid=$s1.'_'.$r1;
        }
        else
         {
            $cvid=$r1.'_'.$s1;
         } 
        $chat->convertationid=$cvid;
        $chat->save();
         }
        
        return back();

    }
   public function writemsg()
   {
       $users=User::all();
       return view('writemsg',compact('users'));
   }
public function getusers()
{
  $users=User::all();

   return response()->json($users);
}


    public function home()
    {

        if (!Auth::user()){
            $notices=notice::orderBy('id','DESC')->where('status','ACTIVE')->get();
            $documents=document::orderBy('id','DESC')->get();
            return view('startpage',compact('notices','documents'));
        }
       $countpendingdrvoucher=debitvoucherheader::where('status','MGR APPROVED')->count();
       $todos=todo::where('userid',Auth::id())->whereDate('datetime', Carbon::today())->paginate(10);

       $pendingexpenseentrycount=expenseentry::where('status','PENDING')->count();
        $tours=tour::where('status','PENDING')->count();
       $pendingrequistioncount=requisitionheader::where('status','PENDING')->count();

       $dailynotifications=usernotification::select('notifications.*','usernotifications.status as ustatus')
                         ->leftJoin('notifications','usernotifications.nid','=','notifications.id')
                         ->where('notifications.type','DAILY')
                         ->get();
      $monthlynotifications=usernotification::select('notifications.*','usernotifications.status as ustatus')
                         ->leftJoin('notifications','usernotifications.nid','=','notifications.id')
                         ->where('notifications.type','MONTHLY')
                         ->get();

      if(Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER' || Auth::user()->usertype=='ACCOUNTS ENTRY')
      {
          return view('accounts.home',compact('todos'));
      }
      elseif(Auth::user()->usertype=='HR')
      {
           return view('hr.home',compact('todos'));
      }
       elseif(Auth::user()->usertype=='TENDER' || Auth::user()->usertype=='TENDER COMMITTEE')
      {
           return view('tender.home');
      }

      $noofprojects=project::count();
      $noofclients=client::count();
      $noofusers=user::count();
      $completedprojects=project::where('status','COMPLETED')->count();
       
      return view('home',compact('noofprojects','noofclients','noofusers','completedprojects','todos','dailynotifications','monthlynotifications','pendingrequistioncount','pendingexpenseentrycount','countpendingdrvoucher','tours'));

      }
   public function activity()
   {
     
       $activites=activity::paginate(20);
       return view('activity',compact('activites'));
   }
   public function saveactivity(Request $request)
   {


     /*  $sid = "AC3739c72ba0c44c41746543f288b370f6"; // Your Account SID from www.twilio.com/console
$token = "61b2a08c8970376b526cba80d42b81fb"; // Your Auth Token from www.twilio.com/console

$client = new \Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
  'whatsapp:+917381256230', // Text this number
  array(
    'from' => 'whatsapp:+14155238886', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  )
);

return $message->sid;*/

        $activity=new activity();
        $activity->activityname=$request->activityname;
        $activity->description=$request->description;
        $activity->userid=Auth::id();
        $activity->save();
        Session::flash('msg','Activity Added Successfully');
        return back();

   }
   public function deleteactivity(Request $request,$id)
   {
    
     $activity=activity::find($id);
     $activity->delete();

     $projectactivity=projectactivity::where('activityid',$id)->delete();

     return back();
   }
   public function updateactivity(Request $request)
   {
    
    $activity=activity::find($request->activityid);
    $activity->activityname=$request->activityname;
        $activity->description=$request->description;
        $activity->userid=Auth::id();
        $activity->save();

         Session::flash('msg','Activity Updated Successfully');
        return back();

   }
   public function adduser()
   {
    
      $users=User::select('users.*','activities.activityname')
             ->leftJoin('assignedactivities','assignedactivities.userid','=','users.id')
             ->leftJoin('activities','assignedactivities.activityassigned','=','activities.id')
             ->groupBy('users.id')
             ->get();
      $activities=activity::all();

      return view('adduser',compact('users','activities'));
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
       $assignedactivity=new assignedactivity();
       $assignedactivity->userid=$user->id;
       $assignedactivity->activityassigned=$request->activityassigned;
       $assignedactivity->save();
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

   public function deleteuser(Request $request,$id)
   {

      
      $user=User::find($id);
      $user->delete();
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

   public function activitydetails()
   {
       
      $activities=activity::all();
      $projects=project::all();

      return view('activitydetails',compact('activities','projects'));
   }
   public function addclient()
   {
        
        $clients=client::get();
        return view('addclient',compact('clients'));
   }
   public function saveclient(Request $request)
   {
    
      $client=new client();
      $client->clientname=$request->clientname;
      $client->orgname=$request->orgname;
      $client->contact1=$request->contact1;
      $client->contact2=$request->contact2;
      $client->officecontact=$request->officecontact;
      $client->email=$request->email;
      $client->gstn=$request->gstn;
      $client->panno=$request->panno;
      $client->residentaddress=$request->residentaddress;
      $client->officeaddress=$request->officeaddress;
      $client->additionalinfo=$request->additionalinfo;
      $client->city=$request->city;
      $client->dist=$request->dist;
      $client->state=$request->state;
      $client->country=$request->country;
      $client->userid=Auth::id();
      $client->save();
    Session::flash('message','Client save Successfully');
      return back();

   }

   public function deleteclient($id)
   {
       
      $client=client::find($id);
      $client->delete();
      return  back();
   }
   public function editclient($id)
   {
      
      $client=client::find($id);

      return view('editclient',compact('client'));
   }
   public function updateclient(Request $request,$id)
   {


       
       $client=client::find($id);
      $client->clientname=$request->clientname;
      $client->orgname=$request->orgname;
      $client->contact1=$request->contact1;
      $client->contact2=$request->contact2;
      $client->officecontact=$request->officecontact;
      $client->email=$request->email;
      $client->gstn=$request->gstn;
      $client->panno=$request->panno;
      $client->residentaddress=$request->residentaddress;
      $client->officeaddress=$request->officeaddress;
      $client->additionalinfo=$request->additionalinfo;
      $client->city=$request->city;
      $client->dist=$request->dist;
      $client->state=$request->state;
      $client->country=$request->country;
      $client->userid=Auth::id();
      $client->save();
      Session::flash('message','Client Updated Successfully');
      return redirect('/dm/viewallclient');

   }

   public function viewallclient()
   {
       
       $clients=client::all();

       return view('viewallclient',compact('clients'));
   }
   public function addproject()
   {
      
      $clients=client::all();
      $activities=activity::all();
      return view('addproject',compact('clients','activities'));
   }
   public function saveproject(Request $request)
   {


    
     //return $request->all();

     $project=new project();
     $project->clientid=$request->clientid;
     $project->clientname=$request->clientname;
     $project->projectname=$request->projectname;
     $lastid=project::orderBy('id','DESC')->pluck('id')->first();
     $project->projectid='SAOOO'.($lastid+1);
     $project->cost=$request->cost;
     $project->startdate=$request->startdate;
     $project->enddate=$request->enddate;
     $project->priority=$request->priority;

     $project->loano=$request->loano;
     $project->agreementno=$request->agreementno;

     $rarefile = $request->file('orderform');

        if($rarefile!='')
        {
             $u=time().uniqid(rand());
        $raupload ="img/orderform";
        $uplogoimg=$u.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$uplogoimg);
        $project->orderform = $uplogoimg;
        }

     $project->save();
     $pid=$project->id;

     $count=count($request->activityid);
    if($count>0)
    {
        for ($i=0; $i < $count; $i++) { 
         $projectactivity=new projectactivity();
         $projectactivity->projectid=$pid;
         $projectactivity->activityid=$request->activityid[$i];
         $projectactivity->position=$i+1;
         $projectactivity->startdate=$request->activitystartdate[$i];
         $projectactivity->enddate=$request->activityenddate[$i];
         $projectactivity->enddate=$request->activityenddate[$i];
         $projectactivity->duration=$request->duration[$i];
         $projectactivity->save();

     } 
    }
     
     Session::flash("Project Saved Successfully");
     return back();
     
   
   }

   public function viewallproject()
   {
        
        $projects=project::select('projects.*','clients.orgname')
                  ->leftJoin('clients','projects.clientid','=','clients.id')
                  ->get();
        return view('viewallproject',compact('projects'));
   }

   public function deleteproject($id)
   {
      
      $project=project::find($id);
      $project->delete();

      $projectactivity=projectactivity::where('projectid',$id)->delete();

      return back();
   }
   public function editproject($id){

    

    $project=project::find($id);
    $projectactivities=projectactivity::select('projectactivities.*','activities.activityname')
                      ->where('projectactivities.projectid',$id)
                      ->leftJoin('activities','projectactivities.activityid','=','activities.id')
                      ->orderBy('projectactivities.position','ASC')
                      ->get();
    $clients=client::all();
    $activities=activity::all();
   // return $projectactivities;
    return view('editproject',compact('project','projectactivities','clients','activities'));
   }
   public function deleteprojectactivity($id)
   {
     
     $projectactivity=projectactivity::find($id);
     $projectactivity->delete();

     return back();
   }

   public function updateproject(Request $request,$id)
   {
      
   
     $project=project::find($id);
     $project->clientid=$request->clientid;
     $project->clientname=$request->clientname;
     $project->projectname=$request->projectname;
     $lastid=project::orderBy('id','DESC')->pluck('id')->first();
     $project->projectid='SAOOO'.($lastid+1);
     $project->cost=$request->cost;
     $project->startdate=$request->startdate;
     $project->enddate=$request->enddate;
     $project->priority=$request->priority;
      $project->loano=$request->loano;
     $project->agreementno=$request->agreementno;
     $project->save();
     $pid=$project->id;

     projectactivity::where('projectid',$id)->delete();
     
     $count=count($request->activityid);



     for ($i=0; $i < $count; $i++) { 
         $projectactivity=new projectactivity();
         $projectactivity->projectid=$pid;
         $projectactivity->activityid=$request->activityid[$i];
         $projectactivity->position=$i+1;
         $projectactivity->startdate=$request->activitystartdate[$i];
         $projectactivity->enddate=$request->activityenddate[$i];
         $projectactivity->enddate=$request->activityenddate[$i];
         $projectactivity->duration=$request->duration[$i];
         $projectactivity->save();

     }
     Session::flash("message","Project Saved Successfully");

     return back();
   }
   public function changestatus(Request $request)
   {
      
      $project=project::find($request->pid);
      $project->status=$request->status;
      $project->save();

      return back();

   }



   public function viewuserprojects()
   {

       $uid=Auth::id();

        $activities=assignedactivity::select('activityassigned')->where('userid',$uid)->get();
       $projects=project::select('projects.*','clients.orgname')
                  ->leftJoin('clients','projects.clientid','=','clients.id')
                  ->leftJoin('projectactivities','projectactivities.projectid','=','projects.id')
                  ->whereIN('projectactivities.activityid',$activities)
                  ->orderBy('projects.id','DESC')
                  ->get();
      
       return view('viewuserprojects',compact('projects'));
   }
   public function showuserprojectdetails($id)
   {
        $project=project::select('projects.*','clients.orgname')
                 ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->where('projects.id',$id)
                 ->first();
        $activities=projectactivity::select('projectactivities.*','activities.activityname','activities.id as actid')
                    ->leftJoin('activities','projectactivities.activityid','=','activities.id')
                     ->where('projectid',$id)
                     ->orderBy('projectactivities.position','ASC')
                     ->get();

          $projects=project::all();
         $clients=client::all();


        $projectactivity=projectactivity::select('projectactivities.*','activities.activityname','activities.id as actid')
                       ->leftJoin('activities','projectactivities.activityid','=','activities.id')
                       ->where('projectactivities.projectid',$id)
                       ->get();

        
        return view('showuserprojectdetails',compact('project','activities','clients','projects','projectactivity'));
   }


   public function userwritereport()
   {

        $projects=project::select('projects.*','clients.orgname')
                 ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
        $clients=client::all();
        return view('userwritereport',compact('clients','projects'));

   }

   public function saveuserreport(Request $request)
   {
        

        $projectreport=new projectreport();
        $projectreport->reportfordate=$request->reportfordate;
        $projectreport->clientid=$request->clientid;
        $projectreport->projectid=$request->projectid;
        $projectreport->activityid=$request->activityid;
        $projectreport->subject=$request->subject;
        $projectreport->description=$request->description;
        $projectreport->userid=Auth::id();
        $projectreport->author="SELF";

        $projectreport->save();

        return back();


   }

   public function userviewreports()
   {
      $uid=Auth::id();

      $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.userid',$uid)
      ->orWhere('projectreports.authorid',$uid)
      ->orderBy('projectreports.created_at','DESC')
      ->get();
       
      return view('userviewreports',compact('projectreports'));
   }

   public function deleteuserreport(Request $request,$id)
   {
    projectreport::find($id)->delete();

    return back();
   }

   public function edituserprojectreport($id)
   {
      $projectreport=projectreport::find($id);
       $clients=client::all();
      return view('edituserprojectreport',compact('projectreport','clients'));
   }

   public function updateuserreport(Request $request,$id)
   {

        $projectreport=projectreport::find($id);
        $projectreport->reportfordate=$request->reportfordate;
        $projectreport->clientid=$request->clientid;
        $projectreport->projectid=$request->projectid;
        $projectreport->activityid=$request->activityid;
        $projectreport->subject=$request->subject;
        $projectreport->description=$request->description;
        $projectreport->userid=Auth::id();
        $projectreport->author="SELF";

        $projectreport->save();

        return redirect('/urm/userviewreports');
   }

   public function verifiedreport()
   {
         $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.status','=','VERIFIED')
      ->orderBy('projectreports.created_at','DESC')
      ->get();

      return view('verifiedreport',compact('projectreports'));
   }


   public function notverifiedreport()
   {
       $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.status','=','NOT VERIFIED')
      ->orderBy('projectreports.created_at','DESC')
      ->get();

      return view('notverifiedreport',compact('projectreports'));
   }

   public function viewverifiedreport($id)
   {
              $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.id','=',$id)
      ->first();

        return view('viewverifiedreport',compact('projectreports'));
   }

   public function viewnotverifiedreport($id)
   {
              $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.id','=',$id)
      ->first();
       return view('viewnotverifiedreport',compact('projectreports'));
   }

   public function adminverifyreport(Request $request,$id)
   {
       $projectreports=projectreport::find($id);
       $projectreports->status="VERIFIED";
       $projectreports->acceptedby=Auth::user()->name;
       $projectreports->remark=$request->remarks;

       $projectreports->save();

       return back();

   }
   public function viewadminprojects()
   {
         $uid=Auth::id();

        $activities=assignedactivity::select('activityassigned')->where('userid',$uid)->get();
       $projects=project::select('projects.*','clients.orgname')
                  ->leftJoin('clients','projects.clientid','=','clients.id')
                  ->leftJoin('projectactivities','projectactivities.projectid','=','projects.id')
                  ->whereIN('projectactivities.activityid',$activities)
                  ->orderBy('projects.id','DESC')
                  ->get();

     return view('viewadminprojects',compact('projects'));
   }

   public function adminprojectdetails($id)
   {

    $project=project::select('projects.*','clients.orgname')
                 ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->where('projects.id',$id)
                 ->first();
        $activities=projectactivity::select('projectactivities.*','activities.activityname','activities.id as acid')
                    ->leftJoin('activities','projectactivities.activityid','=','activities.id')
                     ->where('projectid',$id)
                     ->orderBy('projectactivities.position','ASC')
                     ->get();
    return view('adminprojectdetails',compact('project','activities'));
   }


   public function adminwritereport()
   {
          $projects=project::select('projects.*','clients.orgname')
                 ->leftJoin('clients','projects.clientid','=','clients.id')
                 ->get();
         $clients=client::all();
         $users=User::where('usertype','!=','MASTER ADMIN')->get();
       return view('adminwritereport',compact('clients','users','projects'));
   }

   public function saveadminreport(Request $request)
   {

       $projectreport=new projectreport();
        $projectreport->reportfordate=$request->reportfordate;
        $projectreport->clientid=$request->clientid;
        $projectreport->projectid=$request->projectid;
        $projectreport->activityid=$request->activityid;
        $projectreport->subject=$request->subject;
        $projectreport->description=$request->description;
        $projectreport->status="VERIFIED";
        $projectreport->acceptedby=Auth::user()->name;
        $projectreport->authorid=Auth::id();

        if($request->userid=='SELF')
        {
           $projectreport->userid=Auth::id();
        $projectreport->author="SELF";
        }
        else
        {
          $projectreport->userid=$request->userid;
          $projectreport->author=Auth::user()->name;
        }
       

        $projectreport->save();

        return back();

   }


   public function adminviewmyreport()
   {

        $uid=Auth::id();

      $projectreports=projectreport::select('projectreports.*','clients.orgname','projects.projectname','activities.activityname','users.name')
      ->leftJoin('clients','projectreports.clientid','=','clients.id')
      ->leftJoin('projects','projectreports.projectid','=','projects.id')
      ->leftJoin('activities','projectreports.activityid','=','activities.id')
      ->leftJoin('users','projectreports.userid','=','users.id')
      ->where('projectreports.userid',$uid)
      ->orWhere('projectreports.authorid',$uid)
      ->orderBy('projectreports.created_at','DESC')
      ->get();
        return view('adminviewmyreport',compact('projectreports'));
   }
   public function deleteadminreport(Request $request,$id)
   {
     
     projectreport::find($id)->delete();

     return back();
   }


   public function editadminprojectreport($id)
   {
     $clients=client::all();
     $users=User::where('usertype','!=','MASTER ADMIN')->get();
  $projectreport=projectreport::find($id);
  return view('editadminprojectreport',compact('clients','users','projectreport'));
   }


   public function updateadminreport(Request $request,$id)
   {
     $projectreport=projectreport::find($id);
        $projectreport->reportfordate=$request->reportfordate;
        $projectreport->clientid=$request->clientid;
        $projectreport->projectid=$request->projectid;
        $projectreport->activityid=$request->activityid;
        $projectreport->subject=$request->subject;
        $projectreport->description=$request->description;
        $projectreport->status="VERIFIED";
        $projectreport->acceptedby=Auth::user()->name;
        $projectreport->authorid=Auth::id();

        if($request->userid==Auth::id())
        {
           $projectreport->userid=Auth::id();
        $projectreport->author="SELF";
        }
        else
        {
          $projectreport->userid=$request->userid;
          $projectreport->author=Auth::user()->name;
        }
       

        $projectreport->save();

        return redirect('/hrm/adminviewmyreport');
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
      $users=User::where('usertype','!=','MASTER ADMIN')->get();
   

      return view('complaint',compact('users','complaints','filterreq','statuses'));
   }

    
   public function savecomplaint(Request $request)
   {
        $complaint=new complaint();
        $complaint->type=$request->type;
        $complaint->fromuserid=Auth::id();
        $complaint->touserid=$request->touserid;
        $complaint->lastdate=$request->date;
        $complaint->description=$request->description;
        $complaint->cc=$request->cc;
         $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/complaints/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $complaint->attachment = $rarefilename;
        }
        $complaint->save();
        Session::flash('message','Your complaint registered Successfully');
        return back();


   }

   public function updatecompalint(Request $request)
   {
      $complaint=complaint::find($request->cid);
        $complaint->type=$request->type;
        $complaint->fromuserid=Auth::id();
        $complaint->touserid=$request->touserid;
        $complaint->lastdate=$request->date;
        $complaint->description=$request->description;
        $complaint->cc=$request->cc;
          $rarefile = $request->file('attachment');    
        if($rarefile!=''){
        $raupload = public_path() .'/img/complaints/';
        $rarefilename=time().'.'.$rarefile->getClientOriginalName();
        $success=$rarefile->move($raupload,$rarefilename);
        $complaint->attachment = $rarefilename;
        }
        $complaint->save();
        Session::flash('message','Your complaint Updated Successfully');
        return back();
   }

   public function compalintresolved(Request $request)
   {
     $complaint=complaint::find($request->compid);
     $complaint->remark=$request->remark;
     $complaint->status="RESOLVED";
     $complaint->resolveddate=date('Y-m-d');
     $complaint->save();

       $complaintlog=new complaintlog();
        $complaintlog->complaintid=$request->compid;
        $complaintlog->writerid=Auth::id();
        $complaintlog->message=$request->remark;
        $complaintlog->save();
     return back();
   }
   
    public function usercompalintresolved(Request $request)
   {
     $complaint=complaint::find($request->compid);
     $complaint->remark=$request->remark;
     $complaint->status="RESOLVED REQUEST";
     $complaint->resolveddate=date('Y-m-d');
     $complaint->save();

       $complaintlog=new complaintlog();
        $complaintlog->complaintid=$request->compid;
        $complaintlog->writerid=Auth::id();
        $complaintlog->message=$request->remark;
        $complaintlog->save();
     return back();
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

    
                
    return view('complainttoresolve',compact('complaints','statuses','filterreq'));
   }
  
  public function complaintaction(Request $request)
  {
       $complaint=complaint::find($request->cid);
       $complaint->lastdate=$request->lastdate;
       $complaint->remark=$request->remark;
       $complaint->status="PROCESSING";
       $complaint->save();
        
        $complaintlog=new complaintlog();
        $complaintlog->complaintid=$request->cid;
        $complaintlog->writerid=Auth::id();
        $complaintlog->message=$request->remark;
        $complaintlog->save();


       return back();
  }

  public function complaintresolved(Request $request)
  {

    $complaint=complaint::find($request->compid);
     $complaint->remark=$request->remark;
     $complaint->status="RESOLVED";
     $complaint->resolveddate=date('Y-m-d');
     $complaint->save();

        $complaintlog=new complaintlog();
        $complaintlog->complaintid=$request->compid;
        $complaintlog->writerid=Auth::id();
        $complaintlog->message=$request->remark;
        $complaintlog->save();
      return back();

  }

 


  public function viewallcomplaints(Request $request)
  {
      if($request->has('type'))
         {
     $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->where('complaints.status',$request->type)
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
      $filterreq=$request->type;
          }
        else
        {
             $complaints=complaint::select('complaints.*','u1.name as to','u2.name as from','u3.name as ccname')
                 ->leftJoin('users as u1','complaints.touserid','=','u1.id')
                 ->leftJoin('users as u2','complaints.fromuserid','=','u2.id')
                 ->leftJoin('users as u3','complaints.cc','=','u3.id')
                 ->orderBy('complaints.updated_at','DESC')
                 ->get();
           $filterreq="";
        }
      $statuses=complaint::groupBy('status')->get();


      return view('viewallcomplaints',compact('complaints','statuses','filterreq'));
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
      return view('viewcomplaintdetails',compact('complaint','complaintlogs'));
  }
public function adminviewcomplaintdetails($id)
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
      return view('adminviewcomplaintdetails',compact('complaint','complaintlogs'));
  }



  public function savecomplaintlog(Request $request,$id)
  {

          $complaint=complaint::find($id);
          if(Auth::user()->usertype=='MASTER ADMIN')
          {
            $complaint->lastdate=$request->lastdate;
            $complaint->status="PENDING";
          }
           else
           {
             $complaint->differdateto=$request->lastdate;
             $complaint->status="REQ DIFFER DATE";
           }
       $complaint->remark=$request->message;
      
       $complaint->save();

        $complaintlog=new complaintlog();
        if(Auth::user()->usertype!='MASTER ADMIN')
        {
          $complaint->status="PROCESSING";
          $complaintlog->differdate=$request->lastdate;
          $complaintlog->seen='1';
        }
        $complaintlog->complaintid=$id;
        $complaintlog->writerid=Auth::id();

        $complaintlog->message=$request->message;
        $complaintlog->save();

         if(Auth::user()->usertype=='MASTER ADMIN')
         {
            $com=complaintlog::where('complaintid',$id)->update(['seen' => 0]);
         }

        return back();
  }

  
}
