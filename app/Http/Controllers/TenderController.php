<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tender;
use Session;
use App\User;
use App\assignedtenderuser;
use Auth;
use App\tenderdocument;
use App\corrigendumfile;
use App\Associatepartner;
use DataTables;
use App\tendercommitteecomment;
use DB;
use App\tenderparticipant;
use App\usertenderremark;
use App\committeetenderremark;
use Excel;




class TenderController extends Controller
{ 

public function importassociatepartners(Request $request)
{
       $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);
      $path = $request->file('select_file')->getRealPath();
      $data = Excel::selectSheetsByIndex(0)->load($path)->get();
      //return $data;
      if($data->count()>0){
        foreach($data as $kay=>$value){
        $check=associatepartner::where('associatepartnername',$value['name'])
          ->count();
        if($check==0){
     $associatepartner=new Associatepartner();
     $associatepartner->associatepartnername=$value['name'];
     $associatepartner->officeaddress=$value['address'];
     $associatepartner->contact1=$value['phone_no'];
     $associatepartner->email=$value['email'];
     $associatepartner->avgturnover=number_format((float)$value['avgturnover'], 2, '.', '');
     $associatepartner->save();
        }
      }
  }


      return back();
}
public function viewalltendersuser(){
     return view('viewalltendersuser');
}

public function previoustenders()
{
           $mytenders=assignedtenderuser::select('tenderid')
                        ->where('userid',Auth::id())
                        ->where('assignedtenderusers.status','COMPLETED')
                        ->get();


            $tenders=tender::whereIn('id',$mytenders)
                    ->where('status','!=','COMMITTEE REJECTED')
                    ->orderBy('lastdateofsubmisssion', 'desc')
                    ->get();
    
            return view('myprevioustender',compact('tenders'));
         
}
public function revokestatus(Request $request)
{
    //return $request->all();
     $tender=tender::find($request->tid);
     $tender->status=$request->status;
     $tender->revokeremarks=$request->remarks;
     $tender->save();
     if($tender->status=='ASSIGNED TO USER')
     {
        $assignedtenderuser=assignedtenderuser::where('tenderid',$tender->id)
       ->update([
           'status' => 'PENDING'
        ]);
        $users=assignedtenderuser::where('tenderid',$tender->id)->get();
        if ($users) {
             foreach ($users as $key => $user) {
                 $remark=new usertenderremark();
                 $remark->userid=$user->userid;
                 $remark->author=Auth::id();
                 $remark->tenderid=$tender->id;
                 $remark->remarks=$request->remarks;
                 $remark->save();

             }
        }

     }
     return back();
}
public function revokestatusrejectcommittee(Request $request)
{
    //return $request->all();
     $tender=tender::find($request->tid);
     $tender->status=$request->status;
     $tender->revokeremarks=$request->remarks;
     $tender->save();
     if($tender->status=='ASSIGNED TO USER')
     {
        $assignedtenderuser=assignedtenderuser::where('tenderid',$tender->id)
       ->update([
           'status' => 'PENDING'
        ]);
            $users=assignedtenderuser::where('tenderid',$tender->id)->get();
        if ($users) {
             foreach ($users as $key => $user) {
                 $remark=new usertenderremark();
                 $remark->userid=$user->userid;
                 $remark->author=Auth::id();
                 $remark->tenderid=$tender->id;
                 $remark->remarks=$request->remarks;
                 $remark->save();

             }
        }
     }
     return redirect('/comrejected/comitteerejectedtenders');
}
public function revokestatuscommitteeapproved(Request $request)
{
    //return $request->all();
     $tender=tender::find($request->tid);
     $tender->status=$request->status;
     $tender->revokeremarks=$request->remarks;
     $tender->save();
     if($tender->status=='ASSIGNED TO USER')
     {
        $assignedtenderuser=assignedtenderuser::where('tenderid',$tender->id)
       ->update([
           'status' => 'PENDING'
        ]);
           $users=assignedtenderuser::where('tenderid',$tender->id)->get();
        if ($users) {
             foreach ($users as $key => $user) {
                 $remark=new usertenderremark();
                 $remark->userid=$user->userid;
                 $remark->author=Auth::id();
                 $remark->tenderid=$tender->id;
                 $remark->remarks=$request->remarks;
                 $remark->save();

             }
        }

     }
     return redirect('/tendercom/approvedcommiteetender');
}public function revokestatusadmin(Request $request)
{
    //return $request->all();

     $tender=tender::find($request->tid);
     $tender->status=$request->status;
     $tender->revokeremarks=$request->remarks;
     $tender->save();
     if($tender->status=='ASSIGNED TO USER')
     {
        $assignedtenderuser=assignedtenderuser::where('tenderid',$tender->id)
       ->update([
           'status' => 'PENDING'
        ]);
           $users=assignedtenderuser::where('tenderid',$tender->id)->get();
        if ($users) {
             foreach ($users as $key => $user) {
                 $remark=new usertenderremark();
                 $remark->userid=$user->userid;
                 $remark->author=Auth::id();
                 $remark->tenderid=$tender->id;
                 $remark->remarks=$request->remarks;
                 $remark->save();

             }
        }
     }
     return redirect('/ata/admintenderapproval');
}public function revokestatustendercommittee(Request $request)
{
    //return $request->all();
     $tender=tender::find($request->tid);
     $tender->status=$request->status;
     $tender->revokeremarks=$request->remarks;
     $tender->save();
     if($tender->status=='ASSIGNED TO USER')
     {
        $assignedtenderuser=assignedtenderuser::where('tenderid',$tender->id)
       ->update([
           'status' => 'PENDING'
        ]);
            $users=assignedtenderuser::where('tenderid',$tender->id)->get();
        if ($users) {
             foreach ($users as $key => $user) {
                 $remark=new usertenderremark();
                 $remark->userid=$user->userid;
                 $remark->author=Auth::id();
                 $remark->tenderid=$tender->id;
                 $remark->remarks=$request->remarks;
                 $remark->save();

             }
        }
     }
     return redirect('/tendercom/pendingtenderapproval');
}

public function tendernotintrested(Request $request,$id)
{
     $tender=tender::find($id);
     $tender->status='NOT INTERESTED';
     $tender->save();
     return redirect('/tm/tenderlist');
}
public function ajaxsaveadmincommemnt(Request $request)
{
           $remark=new usertenderremark();
           $remark->userid=$request->userid;
           $remark->author=Auth::id();
           $remark->tenderid=$request->tenderid;
           $remark->remarks=$request->remarks;
           $remark->save();

    return response()->json($remark);
}
public function viewtenderpendinguser($id)
{
        $tender=tender::find($id);
        $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
        $associatepartners=Associatepartner::get();
        $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
        $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewtenderpendinguser',compact('tender','tenderdocuments','corrigendumfiles','users','associatepartners'));
}

public function removeparticipants(Request $request,$id)
{
       tenderparticipant::find($id)->delete();

       return back();
}


public function savetenderparticipants(Request $request,$id)
{
     $chk=tenderparticipant::where('tenderid',$id)
                           ->where('participant',$request->participant)
                           ->get();
     if(count($chk)==0)
     {
     $tenderparticipant=new tenderparticipant();
     $tenderparticipant->tenderid=$id;
     $tenderparticipant->participant=$request->participant;
     $tenderparticipant->techscore=$request->techscore;
     $tenderparticipant->financialscore=$request->financialscore;
     $tenderparticipant->save();
     }
 

     return back();

     return $request->all();
}

public function emddetailsupdate(Request $request,$id)
{
      $tender=tender::find($id); 
      $tender->emdamt=$request->emdamt;
      $tender->emdamtintheformsof=$request->emdamtintheformsof;
      $tender->emdamtdate=$request->emdamtdate;
      $rarefile1 = $request->file('emd');    
      if($rarefile1!=''){
      $raupload1 = public_path() .'/img/posttenderdoc/';
      $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
      $success1=$rarefile1->move($raupload1,$rarefilename1);
      $tender->emd = $rarefilename1;
      }
      $tender->save();

      return back();

}

public function tendercostdetailsupdate(Request $request,$id)
{
     $tender=tender::find($id);
     $tender->tendercost=$request->tendercost;
     $tender->tendercostintheformof=$request->tendercostintheformof;
     $tender->tendercostdate=$request->tendercostdate;
     $rarefile = $request->file('tendercostdoc');    
      if($rarefile!=''){
      $raupload = public_path() .'/img/posttenderdoc/';
      $rarefilename=time().'.'.$rarefile->getClientOriginalName();
      $success=$rarefile->move($raupload,$rarefilename);
      $tender->tendercostdoc = $rarefilename;
      }
     $tender->save();

     return back();
}
public function pendinguserassigned()
{
      $tenderarr=array();
      $users=array();
      $tenders=tender::where('status','ASSIGNED TO USER')
                 ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                 ->get();
      $idarr=tender::select('id')->where('status','ASSIGNED TO USER')
                 ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                 ->get();
      foreach ($tenders as $key => $tender) {
          $tenderusers=assignedtenderuser::select('assignedtenderusers.*','users.name')
                      ->where('tenderid',$tender->id)
                      ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                      ->get();
            
         
          $tenderarr[]=compact('tender','tenderusers');
      }
     
       $pendingtenderusers=assignedtenderuser::select('users.name','userid', DB::raw('count(*) as total'))
                   ->groupBy('userid')
                   ->whereIn('tenderid',$idarr)
                   ->where('status','PENDING')
                   ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                   ->get();

      

      return view('tender.pendinguserassigned',compact('tenderarr','pendingtenderusers'));

}

public function uploadposttenderdocuments(Request $request,$id)
{
      $tender=tender::find($id);
  

       $rarefile2 = $request->file('technicalproposal');    
      if($rarefile2!=''){
      $raupload2 = public_path() .'/img/posttenderdoc/';
      $rarefilename2=time().'.'.$rarefile2->getClientOriginalName();
      $success2=$rarefile2->move($raupload2,$rarefilename2);
      $tender->technicalproposal = $rarefilename2;
      }
        $rarefile3 = $request->file('financialproposal');    
      if($rarefile3!=''){
      $raupload3 = public_path() .'/img/posttenderdoc/';
      $rarefilename3=time().'.'.$rarefile3->getClientOriginalName();
      $success3=$rarefile3->move($raupload3,$rarefilename3);
      $tender->financialproposal = $rarefilename3;
      }
    
      $tender->save();


      return back();





}

 public function viewassignedtenderoffice($id)
 {
     $tender=Tender::find($id);
    $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
    $ofices=User::where('usertype','TENDER')->get();

    return view('tender.viewassignedtenderoffice',compact('tender','tenderdocuments','corrigendumfiles','users'));
 }

public function assignedtendersoffice()
{
     $tenders=DB::table('tenders')
                ->select('tenders.*','users.name')
                ->leftJoin('users','tenders.author','=','users.id')
                ->where('status','ADMIN APPROVED')
                ->where('tenders.assignedoffice',Auth::id())
                ->orderBy('lastdateofsubmisssion','desc')
                ->get();
    return view('tender.assignedtendersoffice',compact('tenders'));
}

public function viewcommitteerejectedtender($id)
{
    $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tender=Tender::find($id);
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();

    return view('tender.viewcommitteerejectedtender',compact('tender','tenderdocuments','corrigendumfiles','users'));
}
public function comitteerejectedtenders()
{
       $tenders=DB::table('tenders')
              ->select('tenders.*','users.name')
              ->leftJoin('users','tenders.author','=','users.id')
              ->where('status','COMMITTEE REJECTED')
              ->orderBy('lastdateofsubmisssion','desc')
              ->get();
      return view('tender.comitteerejectedtenders',compact('tenders'));
}

public function committeereject(Request $request,$id)
{
     $tender=tender::find($id);
     $tender->status='COMMITTEE REJECTED';
     $tender->committeerejectreason=$request->committeerejectreason;
     $tender->save();

     return redirect('/tendercom/pendingtenderapproval');
}
public function ajaxfetchtendercomment(Request $request)
{
      $remarks=usertenderremark::select('usertenderremarks.*','users.name')
            ->leftJoin('users','usertenderremarks.author','=','users.id')
           ->where('tenderid',$request->tenderid)
           ->where('userid',$request->user)
           ->get();
     $user=User::find($request->user);
    
     $comment=tendercommitteecomment::select('tendercommitteecomments.*','associatepartners.associatepartnername')

              ->where('tenderid',$request->tenderid)

               ->where('userid',$request->user)
               ->leftJoin('associatepartners','tendercommitteecomments.associatepartner','=','associatepartners.id')
               ->first();
     return response()->json(compact('user','comment','remarks'));
}

public function associatepartner()
{
    $associatepartners=Associatepartner::select('associatepartners.*','users.name')
                      ->leftJoin('users','users.id','=','associatepartners.author')
                      ->get();
    return view('tender.associatespartner',compact('associatepartners'));
}
public function updateassociatepartner(Request $request)
            {
               $updateassociate =Associatepartner::find($request->apid);
               $updateassociate->associatepartnername=$request->associatepartnername;
               $updateassociate->officeaddress=$request->officeaddress;
               $updateassociate->contact1=$request->contact1;
               $updateassociate->contact2=$request->contact2;
               $updateassociate->officecontact=$request->officecontact;
               $updateassociate->email=$request->email;
               $updateassociate->gstn=$request->gstn;
               $updateassociate->panno=$request->panno;
               $updateassociate->city=$request->city;
               $updateassociate->dist=$request->dist;
               $updateassociate->state=$request->state;
               $updateassociate->country=$request->country;
               $updateassociate->additionalinfo=$request->additionalinfo;
               $updateassociate->save();
                Session::flash('message','Associatepartner Updated Successfully');
                return back();
            }
public function saveassociatepartner(Request $request)
{
     $authid=Auth::id();
     $associatepartner=new Associatepartner();
     $associatepartner->associatepartnername=$request->associatepartnername;
     $associatepartner->officeaddress=$request->officeaddress;
     $associatepartner->contact1=$request->contact1;
     $associatepartner->contact2=$request->contact2;
     $associatepartner->officecontact=$request->officecontact;
     $associatepartner->email=$request->email;
     $associatepartner->gstn=$request->gstn;
     $associatepartner->panno=$request->panno;
     $associatepartner->city=$request->city;
     $associatepartner->dist=$request->dist;
     $associatepartner->state=$request->state;
     $associatepartner->country=$request->country;
     $associatepartner->additionalinfo=$request->additionalinfo;
     $associatepartner->author=$authid;
     $associatepartner->avgturnover=$request->avgturnover;
     $associatepartner->save();
     Session::flash('message','Save successfully');
     return back();
  
}
public function changepriorityadmin(Request $request,$id)
{
    $tender=Tender::find($id);
    $tender->tenderpriority=$request->tenderpriority;
    $tender->save();

    return back();
}
public function changerecomendtender(Request $request,$id)
{
  //return $request->all();
    $tender=Tender::find($id);
    $tender->recomended=$request->recomended;
    $tender->associatepartner=$request->associatepartner;
    $tender->save();

    return back();
}

public function viewnotappliedtender($id)
{

   $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tender=Tender::find($id);
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();

    return view('tender.viewnotappliedtender',compact('tender','tenderdocuments','corrigendumfiles','users'));
}

public function approvedbutnotappliedtenders()
{
       $tenders=DB::table('tenders')
              ->select('tenders.*','users.name')
              ->leftJoin('users','tenders.author','=','users.id')
              ->where('status','NOT APPLIED')
              ->get();
   return view('tender.approvedbutnotappliedtenders',compact('tenders'));
}

public function viewappliedtenders($id)
{

    $tenderparticipants=tenderparticipant::select('tenderparticipants.*','associatepartners.associatepartnername')
      ->leftJoin('associatepartners','tenderparticipants.participant','=','associatepartners.id')
      ->get();
    $tender=Tender::find($id);
    $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
    $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
    $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
     $participants=Associatepartner::get();

    return view('tender.viewappliedtenders',compact('tender','tenderdocuments','corrigendumfiles','users','participants','tenderparticipants'));
} 
 public function updateparticipant(Request $request){
    $tenderparticipant=tenderparticipant::find($request->uid);
    $tenderparticipant->techscore=$request->techscore;
    $tenderparticipant->financialscore=$request->financialscore;
    $tenderparticipant->save();
    Session::flash('msg','Tenderparticipant Updated Successfully');
    return back();

  }
public function appliedtenders()
{
    $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('status','APPLIED')
          ->get();
   return view('tender.appliedtenders',compact('tenders'));
}

public function ajaxchangetenderstatus(Request $request)
{
    $tender=Tender::find($request->id);
    $tender->status=$request->status;
    $tender->notappliednotes=$request->description;
    $tender->save();

    return response()->json($tender);
}

public function viewalltenders()
{
              $tenders=tender::all();
              $statuses=tender::select('status')->groupBy('status')->get();
              return view('tender.viewalltenders',compact('tenders','statuses'));
}


  public function viewadminapprovedtender($id)
  {
        $tender=tender::find($id);
        $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
        $associatepartners=Associatepartner::get();
        $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
        $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewadminapprovedtender',compact('tender','tenderdocuments','corrigendumfiles','users','associatepartners'));
  }


   public function adminapprovedtenders()
   {
         $tenders=DB::table('tenders')
                ->select('tenders.*','users.name','u1.name as assignedoffice')
                ->leftJoin('users','tenders.author','=','users.id')
                ->leftJoin('users as u1','tenders.assignedoffice','=','u1.id')
                ->where('status','ADMIN APPROVED')
                ->get();
         //return $tenders;

         return view('tender.alladminapprovedtenders',compact('tenders'));
   }

   public static function changedateformat($date)
   {
    $originalDate = $date;
    $newDate = date("d-m-Y", strtotime($originalDate));
    return $newDate;
   }
  public static function changedatetimeformat($datetime)
   {
    $originalDate = $datetime;
    $newDate = date("d-m-Y H:m:t", strtotime($originalDate));
    return $newDate;
   }


    public function approvetenderbyadmin(Request $request)
    {
        $tender=tender::find($request->taid);
        $tender->status='ADMIN APPROVED';
        $tender->assignedoffice=$request->assignedoffice;
        $tender->notes=$request->notes;
        $tender->save();

        return redirect('/ata/admintenderapproval');
    } 
       public function rejecttenderbyadmin(Request $request)
    {
        $tender=tender::find($request->trid);
        $tender->status='ADMIN REJECTED';
        $tender->rejectnotes=$request->rejectnotes;
        $tender->save();

        return redirect('/ata/admintenderapproval');
    }

    public function viewtenderadminforapproval($id)
    {


        $remarks=committeetenderremark::select('committeetenderremarks.*','users.name')
                     ->where('tenderid',$id)
                     ->leftJoin('users','committeetenderremarks.author','=','users.id')
                     ->get();

       $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
       $tender=tender::find($id);
          $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
       $offices=User::where('usertype','TENDER')->get();
          return view('tender.viewtenderadminforapproval',compact('tender','tenderdocuments','corrigendumfiles','users','offices','remarks'));
    }
    public function admintenderapproval()
    {
          $tenders=DB::table('tenders')
                 ->select('tenders.*','users.name')
                 ->leftJoin('users','tenders.author','=','users.id')
                 ->where('status','COMMITEE APPROVED')
                 ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                 ->get();
          
         return view('tender.admintenderapproval',compact('tenders'));
    }

    public function approvetenderbycommitee(Request $request,$id)
    {

          //return $request->all();


          if($request->has('SUBMIT') && $request->get('SUBMIT')=='SUBMIT')
{
     $tender=tender::find($id);

           $tender->committeecomment=$request->committeecomment;
           $tender->committee_recomend=$request->recomended;
           $tender->committee_associatepartner=$request->committee_associatepartner;
          /* $tender->sitevisitrequired=$request->sitevisitrequired;
           $tender->sitevisitdescription=$request->sitevisitdescription;
           $tender->workablesite=$request->workablesite;
           $tender->safetyconcern=$request->safetyconcern;
           $tender->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tender->thirdpartyapproval=$request->thirdpartyapproval;
           $tender->paymentsystem=$request->paymentsystem;
           $tender->inhousecapacity=$request->inhousecapacity;
           $tender->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tender->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tender->keypositionbemanaged=$request->keypositionbemanaged;
           $tender->projectdurationsufficient=$request->projectdurationsufficient;
           $tender->localofficesetup=$request->localofficesetup;
          
           $tender->paymentscheduleclear=$request->paymentscheduleclear;
           $tender->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tender->penalityclause=$request->penalityclause;
           $tender->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tender->wehaveexpertise=$request->wehaveexpertise;
           $tender->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tender->contractualambiguty=$request->contractualambiguty;
           $tender->contractualambigutydescription=$request->contractualambigutydescription;
           $tender->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tender->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tender->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tender->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tender->anyotherrequirement=$request->anyotherrequirement;
           $tender->ratetobequoted=$request->ratetobequoted;
           $tender->paymentsystemdetails=$request->paymentsystemdetails;
 */          $tender->status='COMMITEE APPROVED';
           $tender->save();

            $committeetenderremark=new committeetenderremark();
            $committeetenderremark->tenderid=$id;
            $committeetenderremark->remarks=$request->committeecomment;
            $committeetenderremark->author=Auth::id();
            $committeetenderremark->save();
}
       
       if($request->has('SAVE')&& $request->get('SAVE')=='SAVE') {
           $tender=tender::find($id);
           $tender->committee_recomend=$request->recomended;
           $tender->committee_associatepartner=$request->committee_associatepartner;
           $tender->save();


            $committeetenderremark=new committeetenderremark();
            $committeetenderremark->tenderid=$id;
            $committeetenderremark->remarks=$request->committeecomment;
            $committeetenderremark->author=Auth::id();
            $committeetenderremark->save();


         
       }

           return redirect('/tendercom/pendingtenderapproval');
    }
    public function deletecorrigendumfile($id)
    {
          $corrigendumfile=corrigendumfile::find($id)->delete();

          return back();
    }
    public function deletetenderdocument(Request $request,$id)
    {
         $tenderdocument=tenderdocument::find($id)->delete();
         return back();
    }
    public function viewapprovedcommiteetender($id)
    {
          $tender=tender::find($id);
          $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
          $associatepartners=Associatepartner::get();
          $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
          $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
          return view('tender.viewapprovedcommiteetender',compact('tender','tenderdocuments','corrigendumfiles','users','associatepartners'));
    }


     public function approvedcommiteetender()
     {

         $tenders=DB::table('tenders')->where('status','COMMITEE APPROVED')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                  ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                  ->get();

         return view('tender.approvedcommiteetender',compact('tenders'));
     }


      public function viewtendertendercomiteeapproval($id)
      {
          $tender=tender::find($id);
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
            $remarks=committeetenderremark::select('committeetenderremarks.*','users.name')
                     ->where('tenderid',$id)
                     ->leftJoin('users','committeetenderremarks.author','=','users.id')
                     ->get();

            

          $associatepartners=Associatepartner::get();
           return view('tender.viewtendertendercomiteeapproval',compact('tender','tenderdocuments','corrigendumfiles','users','remarks','associatepartners'));
      }


      public function pendingtenderapproval()
      {
           $tenders=DB::table('tenders')->where('status','PENDING COMMITEE APPROVAL')
                  ->select('tenders.*','users.name')
                  ->leftJoin('users','tenders.author','=','users.id')
                  ->get();
           return view('tender.pendingtenderapproval',compact('tenders'));
      }


       public function fillformtendercommitee(Request $request,$id)
       {
           
           $tender=tender::find($id);
           $tender->sitevisitrequired=$request->sitevisitrequired;
           $tender->sitevisitdescription=$request->sitevisitdescription;
           $tender->workablesite=$request->workablesite;
           $tender->safetyconcern=$request->safetyconcern;
           $tender->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tender->thirdpartyapproval=$request->thirdpartyapproval;
           $tender->paymentsystem=$request->paymentsystem;
           $tender->inhousecapacity=$request->inhousecapacity;
           $tender->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tender->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tender->keypositionbemanaged=$request->keypositionbemanaged;
           $tender->projectdurationsufficient=$request->projectdurationsufficient;
           $tender->localofficesetup=$request->localofficesetup;
           $tender->paymentscheduleclear=$request->paymentscheduleclear;
           $tender->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tender->penalityclause=$request->penalityclause;
           $tender->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tender->wehaveexpertise=$request->wehaveexpertise;
           $tender->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tender->contractualambiguty=$request->contractualambiguty;
           $tender->contractualambigutydescription=$request->contractualambigutydescription;
           $tender->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tender->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tender->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tender->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tender->anyotherrequirement=$request->anyotherrequirement;
           $tender->ratetobequoted=$request->ratetobequoted;
           $tender->paymentsystemdetails=$request->paymentsystemdetails;
           $tender->status='COMMITEE APPROVED';
           $tender->save();

           return back();


       }public function fillformuser(Request $request,$id)
       {

           //return $request->all();

           $chk=tendercommitteecomment::where('userid',Auth::id())
                ->where('tenderid',$id)
                ->get();
            
          if (count($chk)>0) {
            $tendercommitteecomment=tendercommitteecomment::where('userid',Auth::id())
                ->where('tenderid',$id)->first();
            
          }
          else{
             $tendercommitteecomment=new tendercommitteecomment();
          }
           
          
           $tendercommitteecomment->sitevisitrequired=$request->sitevisitrequired;
           $tendercommitteecomment->tenderid=$id;
           $tendercommitteecomment->userid=Auth::id();
           $tendercommitteecomment->sitevisitdescription=$request->sitevisitdescription;
           $tendercommitteecomment->workablesite=$request->workablesite;
           $tendercommitteecomment->safetyconcern=$request->safetyconcern;
           $tendercommitteecomment->thirdpartyapprovaldetails=$request->thirdpartyapprovaldetails;
           $tendercommitteecomment->thirdpartyapproval=$request->thirdpartyapproval;
           $tendercommitteecomment->paymentsystem=$request->paymentsystem;
           $tendercommitteecomment->inhousecapacity=$request->inhousecapacity;
           $tendercommitteecomment->thirdpartyinvolvement=$request->thirdpartyinvolvement;
           $tendercommitteecomment->areaaffectedbyextremist=$request->areaaffectedbyextremist;
           $tendercommitteecomment->keypositionbemanaged=$request->keypositionbemanaged;
           $tendercommitteecomment->projectdurationsufficient=$request->projectdurationsufficient;
           $tendercommitteecomment->localofficesetup=$request->localofficesetup;
           $tendercommitteecomment->paymentscheduleclear=$request->paymentscheduleclear;
           $tendercommitteecomment->paymentscheduleambiguty=$request->paymentscheduleambiguty;
           $tendercommitteecomment->penalityclause=$request->penalityclause;
           $tendercommitteecomment->penalityclauseambiguty=$request->penalityclauseambiguty;
           $tendercommitteecomment->wehaveexpertise=$request->wehaveexpertise;
           $tendercommitteecomment->wehaveexpertisedescription=$request->wehaveexpertisedescription;
           $tendercommitteecomment->contractualambiguty=$request->contractualambiguty;
           $tendercommitteecomment->contractualambigutydescription=$request->contractualambigutydescription;
           $tendercommitteecomment->extensivefieldinvestigation=$request->extensivefieldinvestigation;
           $tendercommitteecomment->extensivefieldinvestigationdescription=$request->extensivefieldinvestigationdescription;
           $tendercommitteecomment->requiredexperienceoffirm=$request->requiredexperienceoffirm;
           $tendercommitteecomment->requiredexperienceoffirmdescription=$request->requiredexperienceoffirmdescription;
           $tendercommitteecomment->anyotherrequirement=$request->anyotherrequirement;
           $tendercommitteecomment->ratetobequoted=$request->ratetobequoted;
            $tendercommitteecomment->paymentsystemdetails=$request->paymentsystemdetails;
            
            $tendercommitteecomment->durationtype=$request->durationtype;
            $tendercommitteecomment->duration=$request->duration;
            $tendercommitteecomment->durationsufficient=$request->durationsufficient;
            $tendercommitteecomment->durationsufficientdescription=$request->durationsufficientdescription;
            $tendercommitteecomment->associatepartner=$request->associatepartner;
            $tendercommitteecomment->recomended=$request->recomended;
            $tendercommitteecomment->participation=$request->participation;
           $tendercommitteecomment->save();

           $remark=new usertenderremark();
           $remark->userid=Auth::id();
           $remark->author=Auth::id();
           $remark->tenderid=$id;
           $remark->remarks=$request->remarks;
           $remark->save();
           if ($request->has('submit') && $request->get('submit')=='SUBMIT') {
           $assignedtenderuser=assignedtenderuser::where('tenderid',$id)
                              ->where('userid',Auth::id())
                              ->first();

            $assignedtenderuser->status='COMPLETED';
            $assignedtenderuser->save();

            $tender=tender::find($id);
            $tender->status='PENDING COMMITEE APPROVAL';
            $tender->save();
              }
              else
              {
                 $assignedtenderuser=assignedtenderuser::where('tenderid',$id)
                              ->where('userid',Auth::id())
                              ->first();

            $assignedtenderuser->status='SAVED';
            $assignedtenderuser->save();
              }
           

           return redirect('/mytenders/assignedtenders');


       }

       public function viewtenderuser($id)
       {
           $tender=tender::find($id);
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $associatepartners=Associatepartner::get();

           $tendercomment=tendercommitteecomment::where('tenderid',$id)->where('userid',Auth::id())->first();

           $usertenderremarks=usertenderremark::select('usertenderremarks.*','users.name')
            ->leftJoin('users','usertenderremarks.author','=','users.id')
           ->where('tenderid',$id)
           ->where('userid',Auth::id())
           ->get();
           
           //return $usertenderremarks;
           return view('viewtenderuser',compact('tender','tenderdocuments','corrigendumfiles','associatepartners','tendercomment','usertenderremarks'));
       }

       public function viewprevioustenderuser($id)
       {
           $tender=tender::find($id);
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $associatepartners=Associatepartner::get();

           $tendercomment=tendercommitteecomment::where('tenderid',$id)->where('userid',Auth::id())->first();

           $usertenderremarks=usertenderremark::select('usertenderremarks.*','users.name')
            ->leftJoin('users','usertenderremarks.author','=','users.id')
           ->where('tenderid',$id)
           ->where('userid',Auth::id())
           ->get();
           
           //return $usertenderremarks;
           return view('viewprevioustenderuser',compact('tender','tenderdocuments','corrigendumfiles','associatepartners','tendercomment','usertenderremarks'));
       }

public function updateuserassociatepartner(Request $request){
           $updateassociate =Associatepartner::find($request->apid);
           $updateassociate->associatepartnername=$request->associatepartnername;
           $updateassociate->officeaddress=$request->officeaddress;
           $updateassociate->contact1=$request->contact1;
           $updateassociate->contact2=$request->contact2;
           $updateassociate->officecontact=$request->officecontact;
           $updateassociate->email=$request->email;
           $updateassociate->gstn=$request->gstn;
           $updateassociate->panno=$request->panno;
           $updateassociate->city=$request->city;
           $updateassociate->dist=$request->dist;
           $updateassociate->state=$request->state;
           $updateassociate->country=$request->country;
           $updateassociate->additionalinfo=$request->additionalinfo;
           $updateassociate->save();
            Session::flash('message','Associatepartner Updated Successfully');
            return back();
} 

public function saveuserassociatepartner(Request $request){
  $authid=Auth::id();
     $associatepartner=new Associatepartner();
     $associatepartner->associatepartnername=$request->associatepartnername;
     $associatepartner->officeaddress=$request->officeaddress;
     $associatepartner->contact1=$request->contact1;
     $associatepartner->contact2=$request->contact2;
     $associatepartner->officecontact=$request->officecontact;
     $associatepartner->email=$request->email;
     $associatepartner->gstn=$request->gstn;
     $associatepartner->panno=$request->panno;
     $associatepartner->city=$request->city;
     $associatepartner->dist=$request->dist;
     $associatepartner->state=$request->state;
     $associatepartner->country=$request->country;
     $associatepartner->additionalinfo=$request->additionalinfo;
     $associatepartner->author=$authid;
     $associatepartner->save();
     Session::flash('message','Save successfully');
     return back();
}   

public function userassociatepartner(){
  $associatepartners=Associatepartner::select('associatepartners.*','users.name')
                      ->leftJoin('users','users.id','=','associatepartners.author')
                      ->get();
    return view('associatespartner',compact('associatepartners'));
}                
       public function assignedtenders()
       {
            $mytenders=assignedtenderuser::select('tenderid')
                        ->where('userid',Auth::id())
                          ->where(function ($query) {
                  $query->where('assignedtenderusers.status','PENDING')
                  ->orWhere('assignedtenderusers.status','SAVED');
                      })
                        ->get();


            $tenders=tender::whereIn('id',$mytenders)
                    ->orderBy('lastdateofsubmisssion', 'desc')
                    ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
                    ->get();

            return view('myassignedtender',compact('tenders'));
       }

       public function deleteuserfromtender($uid,$tid)
       {
             $assignedtenderuser=assignedtenderuser::where('userid',$uid)->where('tenderid',$tid)->delete();

             return back();
       }

       public function assignedusertotender(Request $request,$id)
       {

             $chk=assignedtenderuser::where('tenderid',$id)
                  ->where('userid',$request->user)
                  ->get();
              if (count($chk)>0) {
                return back();
                
              }
             $assignedtenderuser=new assignedtenderuser();
             $assignedtenderuser->tenderid=$id;
             $assignedtenderuser->userid=$request->user;
             $assignedtenderuser->save();

             $tender=tender::find($id);
             $tender->status='ASSIGNED TO USER';
             $tender->save();

             return back();
       }

       public function tendernotelligible(Request $request)
       {
           $tender=tender::find($request->tid);
           $tender->status='NOT ELLIGIBLE';
           $tender->notelligiblereason=$request->notelligiblereason;
           $tender->save();

            return redirect('/tm/tenderlist');
       }

        public function tenderelligible(Request $request,$id)
        {
            $tender=tender::find($id);
            $tender->status='ELLIGIBLE';
            $tender->save();

            return redirect('/tm/tenderlist');
        }
        public function viewtendertendercomitee($id)
        {
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $tender=tender::find($id);
            $users=User::all();
            $assignedusers=assignedtenderuser::select('users.*','assignedtenderusers.tenderid')
                            ->where('tenderid',$id)
                           ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                          ->get();

           return view('tender.viewtendertendercomitee',compact('tender','users','assignedusers','tenderdocuments','corrigendumfiles'));
        }

        public function tenderlistforcommitee()
        {
          $tenders=DB::table('tenders')->where('status','ELLIGIBLE')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'))
          ->get();
        
          return view('tender.tenderlistforcommitee',compact('tenders'));

        }
       public function updatetender(Request $request,$id){


                $tender=tender::find($id);
                $tender->nameofthework=$request->nameofthework;
                $tender->clientname=$request->clientname;
                $tender->recomended=$request->recomended;
                $tender->workvalue=$request->workvalue;
                $tender->workvalueinword=$request->workvalueinword;
                $tender->nitpublicationdate=$request->nitpublicationdate;
                $tender->source=$request->source;
                $tender->tenderpriority=$request->tenderpriority;
                $tender->typeofwork=$request->typeofwork;
                $tender->lastdateofsubmisssion=$request->lastdateofsubmisssion;
                $tender->rfpavailabledate=$request->rfpavailabledate;
              
                $tender->refpageofrfp=$request->refpageofrfp;
                
                $tender->emdamount=$request->emdamount;
                $tender->amountinword=$request->amountinword;
                $tender->emdinformof=$request->emdinformof;
                $tender->tenderamount=$request->tenderamount;
                $tender->tenderamountinword=$request->tenderamountinword;
                $tender->tendercostinformof=$request->tendercostinformof;
                $tender->tenderrefno=$request->tenderrefno;
                $tender->noofcovers=$request->noofcovers;
                $tender->salestartdate=$request->salestartdate;
                $tender->saleenddate=$request->saleenddate;
                $tender->bidstartdate=$request->bidstartdate;
                $tender->bidenddate=$request->bidenddate;
                $tender->prebidmeetingdate=$request->prebidmeetingdate;
                $tender->emdpayableto=$request->emdpayableto;
                $tender->tenderfeepayableto=$request->tenderfeepayableto;
                $tender->tendervalidityindays=$request->tendervalidityindays;
                $tender->tendervaliditydate=$request->tendervaliditydate;
                    $tender->registrationamount=$request->registrationamount;
                $tender->registrationamountinword=$request->registrationamountinword;
                $tender->registrationamountinformof=$request->registrationamountinformof;
                $tender->registrationamountpayableto=$request->registrationamountpayableto;

                $tender->save();
                $tid=$tender->id;
              
                 /*   $rarefile = $request->file('rfpdocument');    
                      if($rarefile!=''){
                      $raupload = public_path() .'/img/tender/';
                      $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                      $success=$rarefile->move($raupload,$rarefilename);
                      $tender->rfpdocument = $rarefilename;
                      }*/
               
                      $rfpdocuments=$request['rfpdocument'];

                      if ($rfpdocuments) {
                          foreach($rfpdocuments as $rfp)
                          {
                        
                          if($rfp!='')
                            {
                                $tenderdocument = new tenderdocument();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$rfp->getClientOriginalName();
                                $success=$rfp->move($raupload,$rarefilename);
                                $tenderdocument->file  = $rarefilename;
                                $tenderdocument->tenderid=$tid;
                                $tenderdocument->save();
                             } 
                               
                               
                            }
                      }
                    
                 
            /*        $rarefile1 = $request->file('corrigendumfile');    
                      if($rarefile1!=''){
                      $raupload1 = public_path() .'/img/tender/';
                      $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
                      $success1=$rarefile1->move($raupload1,$rarefilename1);
                      $tender->corrigendumfile = $rarefilename1;
                      }*/


                       $corrigendumfiles=$request['corrigendumfile'];

                       if ($corrigendumfiles) {
                         foreach($corrigendumfiles as $cor)
                          {
                        
                          if($cor!='')
                            {
                                $corrigendumfile = new corrigendumfile();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$cor->getClientOriginalName();
                                $success=$cor->move($raupload,$rarefilename);
                                $corrigendumfile->file  = $rarefilename;
                                $corrigendumfile->tenderid=$tid;
                                $corrigendumfile->save();
                             } 
                               
                               
                            }
                       }
                       
                 
                 Session::flash('msg','Tender Updated Successfully');
               return redirect()->route('tenderlist');



       }
       public function edittender($id)
       {
           $tender=tender::find($id);
           $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           return view('tender.edittender',compact('tender','tenderdocuments','corrigendumfiles'));
       }

       public function viewtender($id)
       {

    $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
           $tender=tender::find($id);
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $associatepartners=Associatepartner::get();

          // return $users;
           return view('tender.viewtender',compact('tender','tenderdocuments','corrigendumfiles','associatepartners','users'));
       } public function userviewtender($id)
       {
         $users=assignedtenderuser::select('assignedtenderusers.*','users.name')
                  ->where('tenderid',$id)
                  ->leftJoin('users','assignedtenderusers.userid','=','users.id')
                  ->get();
           $tender=tender::find($id);
            $tenderdocuments=tenderdocument::where('tenderid',$id)->get();
           $corrigendumfiles=corrigendumfile::where('tenderid',$id)->get();
           $associatepartners=Associatepartner::get();
           return view('userviewtender',compact('tender','tenderdocuments','corrigendumfiles','associatepartners','users'));
       }

       public function tenderlist()
       {
              $tenders=tender::select('tenders.*','users.name as author')
                      ->leftJoin('users','tenders.author','=','users.id')
                      ->get();
              $statuses=tender::select('tenders.status')->groupBy('tenders.status')->get();

              return view('tender.tenderlist',compact('tenders','statuses'));
       }

       public function gettenderlist(Request $request)
       {


           $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id')
          ->where('lastdateofsubmisssion', '>=',date('Y-m-d'));
           if ($request->has('status') && $request->get('status')!='') 
                {
                   $tenders=$tenders->where('status', $request->get('status'));
                }
        
         
          
          
          return DataTables::of($tenders)
                 ->setRowClass(function ($tenders) {
                        $date = \Carbon\Carbon::parse($tenders->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                        if($day>=0 && $day<=5)
                          {
                              return 'blink';
                          }
                      
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($tenders){
                         return '<a target="_bank" href="/viewtender/'.$tenders->id.'" class="btn btn-info">'.$tenders->id.'</a>';
                    })

                  ->addColumn('sta', function($tenders) {
                    /*if ($tenders->status=='PENDING') return '<span class="label label-default">'.$tenders->status.'</span>';*/
                      if ($tenders->status=='ELLIGIBLE') return '<span class="label label-success" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='NOT ELLIGIBLE') return '<span class="label label-warning" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='PENDING')
                      return '<select id="status" onchange="changestatus(this.value,'.$tenders->id.')">'.
                               '<option value="PENDING">PENDING</option>'.
                               '<option value="ELLIGIBLE">ELLIGIBLE</option>'.
                               '<option value="NOT ELLIGIBLE">NOT ELLIGIBLE</option>'.
                               '<option value="NOT INTERESTED">NOT INTERESTED</option>'.
                               '</select>';



                    if ($tenders->status=='COMMITEE APPROVED') return '<span class="label label-info" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN APPROVED') return '<span class="label label-primary" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN REJECTED') return '<span class="label label-danger" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    else
                      return '<span class="label label-default" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    
                    
                    })
                  ->addColumn('view', function($tenders){
                         return '<a target="_bank" href="/viewtender/'.$tenders->id.'" class="btn btn-info">VIEW</a>';
                    })
                  ->addColumn('edit', function($tenders){
                         return '<a href="/edittender/'.$tenders->id.'" class="btn btn-warning">EDIT</a>';
                    })
                  ->addColumn('now', function($tenders){
                         return '<p class="b" title="'.$tenders->nameofthework.'">'.$tenders->nameofthework.'</p>';
                    })
                      ->addColumn('ldos', function($tenders) {
                    return '<strong><span class="label label-danger" style="font-size:13px;">'.$this->changedateformat($tenders->lastdateofsubmisssion).'</strong></span>';
                     })
                  ->editColumn('nitpublicationdate', function($tenders) {
                    return $this->changedateformat($tenders->nitpublicationdate);
                     })
                   ->editColumn('emdamount', function($tenders) {
                    return $tenders->emdamount;
                     })
                ->editColumn('lastdateofsubmisssion', function($tenders) {
                    return $this->changedateformat($tenders->lastdateofsubmisssion);
                     })
                 
                  ->editColumn('rfpavailabledate', function($tenders) {
                    return $this->changedateformat($tenders->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($tenders) {
                        return $this->changedatetimeformat($tenders->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','now','sta','ldos'])
                
               
                 ->make(true);
       }
       public function getviewalltenderlist(Request $request)
       {
          $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id');
          
          if ($request->has('live') && $request->get('live')!='') 
                {
                   $tenders=$tenders->where('lastdateofsubmisssion', '>=',date('Y-m-d'));
                }
            elseif ($request->has('expired') && $request->get('expired')!='') {
                $tenders=$tenders->where('lastdateofsubmisssion', '<',date('Y-m-d'));
            }
          return DataTables::of($tenders)
                 ->setRowClass(function ($tenders) {
                        $date = \Carbon\Carbon::parse($tenders->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                               if($day>=0 && $day<=5)
                                {
                                  return 'blink';
                                }
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($tenders){
                         return '<a target="_bank" href="/viewtender/'.$tenders->id.'" class="btn btn-info">'.$tenders->id.'</a>';
                    })

                  ->addColumn('sta', function($tenders) {
                    if ($tenders->status=='PENDING') return '<span class="label label-default">'.$tenders->status.'</span>';
                      if ($tenders->status=='ELLIGIBLE') return '<span class="label label-success">'.$tenders->status.'</span>';
                    if ($tenders->status=='NOT ELLIGIBLE') return '<span class="label label-warning">'.$tenders->status.'</span>';
                    if ($tenders->status=='COMMITEE APPROVED') return '<span class="label label-info" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN APPROVED') return '<span class="label label-primary" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN REJECTED') return '<span class="label label-danger" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    else
                      return '<span class="label label-default" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    
                    
                    })

                  ->addColumn('live', function($tenders) {
                    if ($tenders->lastdateofsubmisssion < date("Y-m-d")) return '<span class="label label-danger">EXPIRED</span>';
                    else
                      return '<span class="label label-success">LIVE</span>';
                    
                    
                    })
                  ->addColumn('view', function($tenders){
                         return '<a target="_bank" href="/viewtender/'.$tenders->id.'" class="btn btn-info">VIEW</a>';
                    })
                  ->addColumn('edit', function($tenders){
                         return '<a href="/edittender/'.$tenders->id.'" class="btn btn-warning">EDIT</a>';
                    })
                  ->addColumn('now', function($tenders){
                         return '<p class="b" title="'.$tenders->nameofthework.'">'.$tenders->nameofthework.'</p>';
                    })
                   ->addColumn('ldos', function($tenders) {
                    return '<strong><span class="label label-danger" style="font-size:13px;">'.$this->changedateformat($tenders->lastdateofsubmisssion).'</strong></span>';
                     })
                  ->editColumn('nitpublicationdate', function($tenders) {
                    return $this->changedateformat($tenders->nitpublicationdate);
                     })
                  ->editColumn('lastdateofsubmisssion', function($tenders) {
                    return $this->changedateformat($tenders->lastdateofsubmisssion);
                     }) 
                      ->editColumn('emdamount', function($tenders) {
                    return $tenders->emdamount;
                     })
                       ->editColumn('tenderrefno', function($tenders) {
                    return $tenders->tenderrefno;
                     })
                  ->editColumn('rfpavailabledate', function($tenders) {
                    return $this->changedateformat($tenders->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($tenders) {
                        return $this->changedatetimeformat($tenders->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','now','sta','live','ldos'])
                
               
                 ->make(true);
       }

        public function getviewalltenderlistuser(Request $request)
       {
          $tenders=DB::table('tenders')
          ->select('tenders.*','users.name')
          ->leftJoin('users','tenders.author','=','users.id');
           if ($request->has('live') && $request->get('live')!='') 
                {
                   $tenders=$tenders->where('lastdateofsubmisssion', '>=',date('Y-m-d'));
                }
            elseif ($request->has('expired') && $request->get('expired')!='') {
                $tenders=$tenders->where('lastdateofsubmisssion', '<',date('Y-m-d'));
            }

          return DataTables::of($tenders)
                 ->setRowClass(function ($tenders) {
                        $date = \Carbon\Carbon::parse($tenders->lastdateofsubmisssion);
                        $now = \Carbon\Carbon::now();
                        $diff = $now->diffInDays($date);
                        if($date<$now){
                            $day=-($diff);
                         }
                        else
                        {
                          $day=$diff;
                        }
                               if($day>=0 && $day<=5)
                                {
                                  return 'blink';
                                }
                              
                   
                })
                 
                 
                 ->addColumn('idbtn', function($tenders){
                         return '<a href="/viewtender/'.$tenders->id.'" class="btn btn-info">'.$tenders->id.'</a>';
                    })

                  ->addColumn('sta', function($tenders) {
                    if ($tenders->status=='PENDING') return '<span class="label label-default" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                      if ($tenders->status=='ELLIGIBLE') return '<span class="label label-success" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='NOT ELLIGIBLE') return '<span class="label label-warning" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='COMMITEE APPROVED') return '<span class="label label-info" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN APPROVED') return '<span class="label label-primary" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    if ($tenders->status=='ADMIN REJECTED') return '<span class="label label-danger" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    else
                      return '<span class="label label-default" ondblclick="revokestatus('.$tenders->id.')">'.$tenders->status.'</span>';
                    
                    
                    })

                  ->addColumn('live', function($tenders) {
                    if ($tenders->lastdateofsubmisssion < date("Y-m-d")) return '<span class="label label-danger">EXPIRED</span>';
                    else
                      return '<span class="label label-success">LIVE</span>';
                    
                    
                    })
                  ->addColumn('view', function($tenders){
                         return '<a href="/userviewtender/'.$tenders->id.'" class="btn btn-info">VIEW</a>';
                    })
                  ->addColumn('edit', function($tenders){
                         return '<a href="/edittender/'.$tenders->id.'" class="btn btn-warning">EDIT</a>';
                    })
                  ->addColumn('now', function($tenders){
                         return '<p class="b" title="'.$tenders->nameofthework.'">'.$tenders->nameofthework.'</p>';
                    })
                   ->addColumn('ldos', function($tenders) {
                    return '<strong><span class="label label-danger" style="font-size:13px;">'.$this->changedateformat($tenders->lastdateofsubmisssion).'</strong></span>';
                     })
                  ->editColumn('nitpublicationdate', function($tenders) {
                    return $this->changedateformat($tenders->nitpublicationdate);
                     })
                  ->editColumn('lastdateofsubmisssion', function($tenders) {
                    return $this->changedateformat($tenders->lastdateofsubmisssion);
                     })
                  ->editColumn('rfpavailabledate', function($tenders) {
                    return $this->changedateformat($tenders->rfpavailabledate);
                     })
                  ->editColumn('created_at', function($tenders) {
                        return $this->changedatetimeformat($tenders->created_at);
                     })
                  
                  ->rawColumns(['idbtn','view','edit','now','sta','live','ldos'])
                
               
                 ->make(true);
       }
       public function home()
       {
           return view('tender.home');
       }

       public function createtender()
       {
            return view('tender.createtender');
       }

       public function savetender(Request $request)
       {
              $chk=tender::where('tenderrefno',$request->tenderrefno)->count();
              if($chk>0)
              {
                   Session::flash('err','Duplicate Entry Tender Already Exist');
                   return back();
              }
              else{



                $tender=new tender();
                $tender->author=Auth::id();
                $tender->nameofthework=$request->nameofthework;
                $tender->clientname=$request->clientname;
                $tender->recomended=$request->recomended;
                $tender->workvalue=$request->workvalue;
                $tender->workvalueinword=$request->workvalueinword;
                $tender->nitpublicationdate=$request->nitpublicationdate;
                $tender->source=$request->source;
                $tender->tenderpriority=$request->tenderpriority;
                $tender->typeofwork=$request->typeofwork;
                $tender->lastdateofsubmisssion=$request->lastdateofsubmisssion;
                $tender->rfpavailabledate=$request->rfpavailabledate;
              
                $tender->refpageofrfp=$request->refpageofrfp;
                
                $tender->emdamount=$request->emdamount;
                $tender->amountinword=$request->amountinword;
                $tender->emdinformof=$request->emdinformof;
                $tender->tenderamount=$request->tenderamount;
                $tender->tenderamountinword=$request->tenderamountinword;
                $tender->tendercostinformof=$request->tendercostinformof;
                $tender->tenderrefno=$request->tenderrefno;
                $tender->noofcovers=$request->noofcovers;
                $tender->salestartdate=$request->salestartdate;
                $tender->saleenddate=$request->saleenddate;
                $tender->bidstartdate=$request->bidstartdate;
                $tender->bidenddate=$request->bidenddate;
                $tender->prebidmeetingdate=$request->prebidmeetingdate;
                $tender->emdpayableto=$request->emdpayableto;
                $tender->tenderfeepayableto=$request->tenderfeepayableto;
                $tender->tendervalidityindays=$request->tendervalidityindays;
                $tender->tendervaliditydate=$request->tendervaliditydate;
                $tender->registrationamount=$request->registrationamount;
                $tender->registrationamountinword=$request->registrationamountinword;
                $tender->registrationamountinformof=$request->registrationamountinformof;
                $tender->registrationamountpayableto=$request->registrationamountpayableto;

                $tender->save();

                $tid=$tender->id;
              
                 /*   $rarefile = $request->file('rfpdocument');    
                      if($rarefile!=''){
                      $raupload = public_path() .'/img/tender/';
                      $rarefilename=time().'.'.$rarefile->getClientOriginalName();
                      $success=$rarefile->move($raupload,$rarefilename);
                      $tender->rfpdocument = $rarefilename;
                      }*/
               
            $rfpdocuments=$request['rfpdocument'];

                      if ($rfpdocuments) {
                          foreach($rfpdocuments as $rfp)
                          {
                        
                          if($rfp!='')
                            {
                                $tenderdocument = new tenderdocument();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$rfp->getClientOriginalName();
                                $success=$rfp->move($raupload,$rarefilename);
                                $tenderdocument->file  = $rarefilename;
                                $tenderdocument->tenderid=$tid;
                                $tenderdocument->save();
                             } 
                               
                               
                            }
                      }
                    
                 
            /*        $rarefile1 = $request->file('corrigendumfile');    
                      if($rarefile1!=''){
                      $raupload1 = public_path() .'/img/tender/';
                      $rarefilename1=time().'.'.$rarefile1->getClientOriginalName();
                      $success1=$rarefile1->move($raupload1,$rarefilename1);
                      $tender->corrigendumfile = $rarefilename1;
                      }*/


                       $corrigendumfiles=$request['corrigendumfile'];

                       if ($corrigendumfiles) {
                         foreach($corrigendumfiles as $cor)
                          {
                        
                          if($cor!='')
                            {
                                $corrigendumfile = new corrigendumfile();
                                $raupload = public_path() .'/img/tender/';
                                $rarefilename=time().'.'.$cor->getClientOriginalName();
                                $success=$cor->move($raupload,$rarefilename);
                                $corrigendumfile->file  = $rarefilename;
                                $corrigendumfile->tenderid=$tid;
                                $corrigendumfile->save();
                             } 
                               
                               
                            }
                       }


                    
                 
                 Session::flash('msg','Tender Saved Successfully');
                 return back();
           }

       }
}
