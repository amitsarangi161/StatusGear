<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css')}}">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css')}}">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css')}}">
      <!-- jvectormap -->
      <link rel="stylesheet" href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
      <!-- Date Picker -->
     <!--  <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css')}}"> -->
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
      

      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

  
  
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
   <!--  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script> -->
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <style type="text/css">
      .amit-btn a{border-radius: 0px!important;}
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Status Gear</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- Sidebar toggle button-->
      <ul class="navbar-nav nav " style="padding-left: 64px;">
        <li class="dropdown message-menu">
          <a  onclick="window.history.back(0);">
            <p style="font-size: 20px;"><i class="fa fa-arrow-circle-left"></i> Back</p>
          </a>
        </li>
      </ul>

      
      @php
         $wallet=\App\wallet::where('employeeid',Auth::id())
                ->get();
         $walletcr=$wallet->sum('credit');
         $walletdr=$wallet->sum('debit');
         $walletbalance=$walletcr-$walletdr;

      @endphp
      <div class="navbar-custom-menu">

        <ul class="navbar-nav nav" style="padding-right: 20px;padding-top: 10px;">

        <li class="dropdown message-menu" style="padding-right: 20px; padding-left: 20px;">
          <img src="{{asset('wallet.png')}}" style="height: 40px;width: 40px;">
        </li>
        <li class="dropdown message-menu">
          <strong style="color: #fff;">Wallet</strong><p style="color: #fff;" id="walletbalance">Rs. {{$walletbalance}}</p>
        </li>
        </ul>
        <ul class="nav navbar-nav">

         
           
          <li class="dropdown user user-menu">
      
            @if (Auth::guest())
          <li><a href="{{ route('login') }}">Login</a></li>
          <li><a href="{{ route('register') }}">Register</a></li>
         
           @else

      
             <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-flat">Sign out</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
          </form>
            
           @endif
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
<div id="myloaderDiv" style="display:none; width: 100%; height: 100%; background-color: #ffffffb3; position: absolute; top:0; bottom: 0; left: 0; right: 0; margin: auto; z-index: 9999;">
        <img style="position: absolute; top:0; bottom: 0; left: 0; right: 0; margin: auto;" id="loading-image" src="{{ asset('images/loader/loader-dtpl.gif') }}" style=""/>
    </div>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        @if (Auth::user())

        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <p> {{ Auth::user()->usertype}}</p>
          
          
           
        </div>
      
        @endif
       
      </div>
     




      <ul class="sidebar-menu">
        <li class="header"><strong class="text-center">CONSTRUCTION NAVIGATION</strong></li>
      
    

           <li class="{{ Request::is('/') ? 'active' : '' }} treeview">
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          </li>
 
   @if(Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='ADMIN')
       <li class="{{ Request::is('dm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DEFINE MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('dm/activity') ? 'active' : '' }}"><a href="/dm/activity"><i class="fa fa-circle-o text-aqua"></i>DEFINE ACTIVITY</a></li>
            @if(Auth::user()->usertype=='MASTER ADMIN')
            <li class="{{ Request::is('dm/adduser') ? 'active' : '' }}"><a href="/dm/adduser"><i class="fa fa-circle-o text-aqua"></i>ADD NEW USER</a></li>

             <li class="{{ Request::is('dm/newuserrequest') ? 'active' : '' }}"><a href="/dm/newuserrequest"><i class="fa fa-circle-o text-aqua"></i>NEW USER REQUEST</a></li>
             @endif
            <li class="{{ Request::is('dm/activitydetails') ? 'active' : '' }}"><a href="/dm/activitydetails"><i class="fa fa-circle-o text-aqua"></i>ASSIGNED ACTIVITY TO USERS</a></li>

            <li class="{{ Request::is('dm/addclient') ? 'active' : '' }}"><a href="/dm/addclient"><i class="fa fa-circle-o text-aqua"></i>ADD A NEW CLIENT</a></li>


            <li class="{{ Request::is('dm/viewallclient') ? 'active' : '' }}"><a href="/dm/viewallclient"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL CLIENT</a></li>
            <li class="{{ Request::is('dm/userassigntohod') ? 'active' : '' }}"><a href="/dm/userassigntohod"><i class="fa fa-circle-o text-aqua"></i>USER ASSIGN TO HOD</a></li>

            <li class="{{ Request::is('dm/viewallassignedusertohod') ? 'active' : '' }}"><a href="/dm/viewallassignedusertohod"><i class="fa fa-circle-o text-aqua"></i>VIEW ASSIGNED USERS TO HOD</a></li>

          </ul>
        </li>


<!-- For Master Admin -->
              <li class="{{ Request::is('projects*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-th"></i> <span>PROJECT MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('projects/addproject') ? 'active' : '' }}"><a href="/projects/addproject"><i class="fa fa-circle-o text-red"></i>ADD A PROJECT</a></li>
             
             <li class="{{ Request::is('projects/viewallproject') ? 'active' : '' }}"><a href="/projects/viewallproject"><i class="fa fa-circle-o text-red"></i>VIEW ALL PROJECT</a></li>
        
          </ul>
        </li>
 @endif
 
  <!-- ADMIN END -->
 @if(Auth::user()->usertype=='ADMIN')

  <li class="{{ Request::is('hodrequisition*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-bar-chart "></i> <span>PENDING REQ/EXP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li class="{{ Request::is('hodrequisition/pendingrequisition') ? 'active' : '' }}"><a href="/hodrequisition/pendingrequisition"><i class="fa fa-circle-o text-red"></i>PENDING REQUISITION</a></li>

             <li class="{{ Request::is('hodrequisition/expenseentry') ? 'active' : '' }}"><a href="/hodrequisition/expenseentry"><i class="fa fa-circle-o text-red"></i>PENDING EXPENSE ENTRY</a></li>

          </ul>
        </li>

  
  <li class="{{ Request::is('hrm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-pencil"></i> <span>REPORT MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('hrm/adminwritereport') ? 'active' : '' }}"><a href="/hrm/adminwritereport"><i class="fa fa-circle-o text-red"></i>WRITE REPORT</a></li>
            
            <li class="{{ Request::is('hrm/adminviewmyreport') ? 'active' : '' }}"><a href="/hrm/adminviewmyreport"><i class="fa fa-circle-o text-red"></i>VIEW MY REPORT</a></li>
          </ul>
        </li>
   
@endif

@if(Auth::user()->usertype=='MASTER ADMIN' || Auth::user()->usertype=='ADMIN')
 <li class="{{ Request::is('gr*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>GENERAL REPORT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('gr/verifiedreport') ? 'active' : '' }}"><a href="/gr/verifiedreport"><i class="fa fa-circle-o text-red"></i>VERIFIED</a></li>
             
             <li class="{{ Request::is('gr/notverifiedreport') ? 'active' : '' }}"><a href="/gr/notverifiedreport"><i class="fa fa-circle-o text-red"></i>NOT VERIFIED</a></li>
        
          </ul>
  </li>

@if(Auth::user()->usertype=='ADMIN')
  <li class="{{ Request::is('attendance*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>ATTENDANCE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('attendance/viewattendance') ? 'active' : '' }}"><a href="/attendance/viewattendance"><i class="fa fa-circle-o text-red"></i>VIEW ATTENDANCE</a></li>
             
            
          </ul>
</li>

@endif
@endif


<!-- for User -->
@if(Auth::user()->usertype=='USER')
 <li class="{{ Request::is('userprojects*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-laptop"></i> <span>PROJECT MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('userprojects/viewprojects') ? 'active' : '' }}"><a href="/userprojects/viewprojects"><i class="fa fa-circle-o text-red"></i>VIEW ALL PROJECTS
              
            </a></li>
             
        
          </ul>
        </li>



   <li class="{{ Request::is('urm*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>REPORT MAIN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('urm/userwritereport') ? 'active' : '' }}"><a href="/urm/userwritereport"><i class="fa fa-circle-o text-red"></i>WRITE A REPORT(SELF)</a></li>

            <li class="{{ Request::is('urm/userviewreports') ? 'active' : '' }}"><a href="/urm/userviewreports"><i class="fa fa-circle-o text-red"></i>VIEW MY REPORTS</a></li>
             
        
          </ul>
        </li>


        
@endif


@if(Auth::user()->usertype!='MASTER ADMIN')

@php
 $countpendingvendor=\App\requisition::select('requisitions.*','expenseheads.expenseheadname','particulars.particularname','projects.projectname')
                               ->where('requisitions.payto','TO VENDOR')
                               ->where('requisitions.userid',Auth::id())

                               ->leftJoin('expenseheads','requisitions.expenseheadid','=','expenseheads.id')
                               ->leftJoin('particulars','requisitions.particularid','=','particulars.id')
                               ->leftJoin('requisitionheaders','requisitions.requisitionheaderid','=','requisitionheaders.id')

                                ->leftJoin('projects','requisitionheaders.projectid','=','projects.id')
                                ->whereNull('vendorid')
                               
                                 ->count();

@endphp
 <li class="{{ Request::is('userwallet*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-credit-card"></i> <span>WALLET</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
             <span class="pull-right-container">
                  <span class="label label-success pull-right" id="walletbal">{{$walletbalance}}</span>
             </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('userwallet/viewwallet') ? 'active' : '' }}"><a href="/userwallet/viewwallet"><i class="fa fa-circle-o text-red"></i>VIEW MY WALLET
            

            </a></li>
             
        
          </ul>
        </li>
<li class="{{ Request::is('useraccounts*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>ACCOUNTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="{{ Request::is('useraccounts/labours') ? 'active' : '' }}"><a href="/useraccounts/labours"><i class="fa fa-circle-o text-aqua"></i>MANAGE LABOURS</a></li>

           <li class="{{ Request::is('useraccounts/paidamounts') ? 'active' : '' }}"><a href="/useraccounts/paidamounts"><i class="fa fa-circle-o text-aqua"></i>PAID AMOUNTS</a></li>

           <li class="{{ Request::is('useraccounts/vehicles') ? 'active' : '' }}"><a href="/useraccounts/vehicles"><i class="fa fa-circle-o text-aqua"></i>MANAGE VEHICLES</a></li>

           <li class="{{ Request::is('useraccounts/vendors') ? 'active' : '' }}"><a href="/useraccounts/vendors"><i class="fa fa-circle-o text-aqua"></i>VENDORS</a></li>

            <li class="{{ Request::is('useraccounts/managevendors') ? 'active' : '' }}"><a href="/useraccounts/managevendors"><i class="fa fa-circle-o text-aqua"></i>MANAGE ALL VENDORS</a></li>
             
          <li class="{{ Request::is('useraccounts/expenseentry') ? 'active' : '' }}"><a href="/useraccounts/expenseentry"><i class="fa fa-circle-o text-aqua"></i>EXPENSE ENTRY</a></li> 
          <li class="{{ Request::is('useraccounts/viewallexpenseentry') ? 'active' : '' }}"><a href="/useraccounts/viewallexpenseentry"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL EXPENSE ENTRY</a></li>

          <li class="{{ Request::is('useraccounts/applicationform') ? 'active' : '' }}"><a href="/useraccounts/applicationform"><i class="fa fa-circle-o text-aqua"></i>REQUISITION APPLY FORM</a></li>

          <li class="{{ Request::is('useraccounts/requisitionvendors') ? 'active' : '' }}"><a href="/useraccounts/requisitionvendors"><i class="fa fa-circle-o text-aqua"></i>REQUISITION PENDING <br>  &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;VENDOR

            <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countpendingvendor}}</span>
            </span>
          </a></li>

           <li class="{{ Request::is('useraccounts/viewapplicationform') ? 'active' : '' }}"><a href="/useraccounts/viewapplicationform"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL REQUISITION</a></li>


             
        
          </ul>
        </li>



<li class="{{ Request::is('engage*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>ENGAGE LABOUR/VEHICLE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          
          <ul class="treeview-menu">

           <li class="{{ Request::is('engage/dailylabour') ? 'active' : '' }}"><a href="/engage/dailylabour"><i class="fa fa-circle-o text-aqua"></i>ENGAGE DAILY LABOUR</a></li>
           <li class="{{ Request::is('engage/viewallengagedlabours') ? 'active' : '' }}"><a href="/engage/viewallengagedlabours"><i class="fa fa-circle-o text-aqua"></i>VIEWALL ENGAED LABOURS</a></li>

           <li class="{{ Request::is('engage/engagedailyvehicle') ? 'active' : '' }}"><a href="/engage/engagedailyvehicle"><i class="fa fa-circle-o text-aqua"></i>DAILY VEHICLE ENGAGE</a></li>
           <li class="{{ Request::is('engage/viewallengagedailyvehicle') ? 'active' : '' }}"><a href="/engage/viewallengagedailyvehicle"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL ENGAGED VEHICLE</a></li>


          
          </ul>
        </li>



@endif


<li class="{{ Request::is('tour*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>TOUR APPROVAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          
          <ul class="treeview-menu">
             @if(Auth::user()->usertype!='MASTER ADMIN')
           <li class="{{ Request::is('tour/tourapprovalapplication') ? 'active' : '' }}"><a href="/tour/tourapprovalapplication"><i class="fa fa-circle-o text-aqua"></i>TOUR APPROVAL APPLICATION</a></li>

            <li class="{{ Request::is('tour/viewmytourapplications') ? 'active' : '' }}"><a href="/tour/viewmytourapplications"><i class="fa fa-circle-o text-aqua"></i>VIEW MY APPLICATIONS</a></li>
            @else

           <li class="{{ Request::is('tour/pendingtourapplications') ? 'active' : '' }}"><a href="/tour/pendingtourapplications"><i class="fa fa-circle-o text-aqua"></i>PENDING TOUR APPLICATION</a></li>

           <li class="{{ Request::is('tour/approvedtourapplications') ? 'active' : '' }}"><a href="/tour/approvedtourapplications"><i class="fa fa-circle-o text-aqua"></i>APPROVED TOUR APPLICATION</a></li>

           <li class="{{ Request::is('tour/cancelledtourapplications') ? 'active' : '' }}"><a href="/tour/cancelledtourapplications"><i class="fa fa-circle-o text-aqua"></i>CANCELLED TOUR APPLICATION</a></li>

           <li class="{{ Request::is('tour/adminviewalltourapplications') ? 'active' : '' }}"><a href="/tour/adminviewalltourapplications"><i class="fa fa-circle-o text-aqua"></i>VIEW ALL TOUR APPLICATION</a></li>
            @endif

          
          </ul>
        </li>
 <li class="{{ Request::is('uc*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>COMPLAINT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('uc/complaint') ? 'active' : '' }}"><a href="/uc/complaint"><i class="fa fa-circle-o text-red"></i>CREATE A COMPLAINT</a></li>

            <li class="{{ Request::is('uc/complainttoresolve') ? 'active' : '' }}"><a href="/uc/complainttoresolve"><i class="fa fa-circle-o text-red"></i>TO DO LIST</a></li>

               @if(Auth::user()->usertype=='MASTER ADMIN')
              <li class="{{ Request::is('uc/viewallcomplaints') ? 'active' : '' }}"><a href="/uc/viewallcomplaints"><i class="fa fa-circle-o text-red"></i>VIEW ALL COMPLAINTS</a></li>
              @endif
          </ul>
</li>

<li class="{{ Request::is('bills*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-print"></i> <span>BILL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
         
              <span class="label label-danger pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('bills/createbill') ? 'active' : '' }}"><a href="/bills/createbill"><i class="fa fa-circle-o text-red"></i>CREATE A BILL</a></li>

             @if(Auth::user()->usertype=='MASTER ADMIN')
              
             <li class="{{ Request::is('bills/viewpendingbills') ? 'active' : '' }}"><a href="/bills/viewpendingbills"><i class="fa fa-circle-o text-red"></i>VIEW PENDING BILL</a></li>
              <li class="{{ Request::is('bills/viewapprovedbills') ? 'active' : '' }}"><a href="/bills/viewapprovedbills"><i class="fa fa-circle-o text-red"></i>VIEW APPROVED BILL</a></li>
                <li class="{{ Request::is('bills/viewrejectbills') ? 'active' : '' }}"><a href="/bills/viewrejectbills"><i class="fa fa-circle-o text-red"></i>VIEW REJECT BILL</a></li>
              @endif
            

            <li class="{{ Request::is('bills/viewallbills') ? 'active' : '' }}"><a href="/bills/viewallbills"><i class="fa fa-circle-o text-red"></i>VIEW ALL BILL</a></li>
           
          
          </ul>
</li>


<li class="{{ Request::is('usermsg*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>MESSAGE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
         
              <span class="label label-danger pull-right" id="countmsg"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('usermsg/writemsg') ? 'active' : '' }}"><a href="/usermsg/writemsg"><i class="fa fa-circle-o text-red"></i>SEND A MESSAGE</a></li> -->

            <li class="{{ Request::is('usermsg/mymessages') ? 'active' : '' }}"><a href="/usermsg/mymessages"><i class="fa fa-circle-o text-red"></i>MESSAGES</a></li>
            
           

          </ul>
</li>


@if(Auth::user()->usertype=='MASTER ADMIN')

<li class="{{ Request::is('reports*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>REPORTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('reports/userwisepaymentreports') ? 'active' : '' }}"><a href="/reports/userwisepaymentreports"><i class="fa fa-circle-o text-red"></i>USER WISE PAYMENT REPORT</a></li>
             <li class="{{ Request::is('reports/projectwisepaymentreports') ? 'active' : '' }}"><a href="/reports/projectwisepaymentreports"><i class="fa fa-circle-o text-red"></i>PROJECT WISE PAYMENT REPORT</a></li>
            <li class="{{ Request::is('reports/paymentreports') ? 'active' : '' }}"><a href="/reports/paymentreports"><i class="fa fa-circle-o text-red"></i> PAYMENT REPORT</a></li>

            <li class="{{ Request::is('reports/transactionreport') ? 'active' : '' }}"><a href="/reports/transactionreport"><i class="fa fa-circle-o text-red"></i>TRANSACTION REPORT</a></li>

            <li class="{{ Request::is('reports/expensereport') ? 'active' : '' }}"><a href="/reports/expensereport"><i class="fa fa-circle-o text-red"></i>EXPENSE REPORT</a></li>

          </ul>
</li>


<li class="{{ Request::is('suggestions*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-bullhorn"></i> <span>SUGGESTIONS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('suggestions/viewallsuggestions') ? 'active' : '' }}"><a href="/suggestions/viewallsuggestions"><i class="fa fa-circle-o text-red"></i>VIEW ALL SUGGESTIONS</a></li>
             
            <li class="{{ Request::is('suggestions/impsuggestions') ? 'active' : '' }}"><a href="/suggestions/impsuggestions"><i class="fa fa-circle-o text-red"></i>IMPORTANT SUGGESTIONS</a></li>
          </ul>
</li>

<li class="{{ Request::is('attendance*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>ATTENDANCE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('attendance/viewattendance') ? 'active' : '' }}"><a href="/attendance/viewattendance"><i class="fa fa-circle-o text-red"></i>VIEW ATTENDANCE</a></li>

             <li class="{{ Request::is('attendance/attendancereport') ? 'active' : '' }}"><a href="/attendance/attendancereport"><i class="fa fa-circle-o text-red"></i>ATTENDANCE REPORT</a></li>
             
            
          </ul>
</li>

@endif

@php
 $findtender=\App\assignedtenderuser::select()
                ->leftJoin('tenders','assignedtenderusers.id','=','tenders.id')
                ->where('assignedtenderusers.userid',Auth::id())
                 ->get();

@endphp

@if(count($findtender)>0)
<li class="{{ Request::is('mytenders*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-briefcase"></i> <span>TENDERS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             <li class="{{ Request::is('mytenders/assignedtenders') ? 'active' : '' }}"><a href="/mytenders/assignedtenders"><i class="fa fa-circle-o text-red"></i>ASSIGNED TENDERS</a></li>
             
            
          </ul>
</li>
@endif
  <!-- user End -->

        

       
    </section>
    <!-- /.sidebar -->
  </aside>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if(Auth::user()->usertype=='MASTER ADMIN')
          <div class="btn-group btn-group-justified amit-btn">
            <a href="/" class="btn btn-warning btn-lg">Construction</a>
            <a href="/adminhr" class="btn btn-success btn-lg">HR</a>
            <a href="/adminaccounts" class="btn btn-warning btn-lg">Accounts</a>
            <a href="/admintender" class="btn btn-info btn-lg">TENDER</a>
          </div>   
        @endif
              
        <section class="content-header">      
            <h1 style="text-align: center;">
               STATUS GEAR 1.0V Construction
            </h1>
            <ol class="breadcrumb">

                @foreach(Request::segments() as $segment)
                <li>
                   <a href="#"><span style="text-transform:uppercase;">{{$segment}}</span></a>
                </li>
                @endforeach 
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('content')
           
        </section> 


    </div>

    <div class="modal fade " id="myModal" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"> Reset Password</h4>
                  <form class="form-horizontal" role="form" method="POST" action="">
                    {{ csrf_field() }}

                  <table class="table table-responsive table-hover table-bordered">
                    <tr>
                    <td>NEW PASSWORD</td>
                    <td><input id="password" type="password" name="password" placeholder="Enter New Password"></td>
                    </tr>
                    <tr>
                    <td>CONFIRM PASSWORD</td>
                    <td><input id="confirm_password" type="password" name="pass2" placeholder="Confirm Password"><span id='message'></span></td>
                    </tr>
                    <tr><td colspan="2">  <span id='result'><button class="btn btn-success" type="submit" disabled>RESET NOW
                    </button></span></td></tr>
                  </table>

                  </form>
                </div>
       
            </div>
        </div>
    </div>


<link href="{{ URL::asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('css/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

      <script src="{{ URL::asset('/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
     
      <script src="{{ URL::asset('/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/dataTables.buttons.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.flash.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/jszip.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/pdfmake.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/vfs_fonts.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.html5.min.js')}}" type="text/javascript"></script>
      <script src="{{ URL::asset('/js/datatables/buttons.print.min.js')}}" type="text/javascript"></script>




 <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">

<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

<link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">

<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>


<script type="text/javascript">

window.onpageshow = function(event) {
if (event.persisted) {
    window.location.reload() 
}
};


  $('.readonly').on('input', function(e){
    var key = e.which || this.value.substr(-1).charCodeAt(0);
    $(".readonly").val("");
    alert('Manually Input Blocked Choose a date from Picker');
  });

$(document).ready(function(){
          
   countunreadmessage();


     setInterval(function(){
     countunreadmessage();
     checkwalletbalance();
 }, 100000);

       });


       function countunreadmessage()
       {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcountunreadmessage")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 
                     $("#countmsg").html(data);
                     $("#countmsg111").html(data);
               }
               
             });
       }

         function checkwalletbalance()
       {
           $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf_token"]').attr('content')
            }
        });

           $.ajax({
               type:'POST',
              
               url:'{{url("/ajaxcheckwalletbalance")}}',
              
               data: {
                     "_token": "{{ csrf_token() }}",
                     
                     },

               success:function(data) { 
                     $("#walletbalance").html('Rs. '+data);
                     $("#walletbal").html(data);
                     
               }
             });
       }

      $('.datatable1').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 25,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
            });
      $('.datatable2').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 10,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
            });
</script>
  <script>
      $('.select2').select2({dropdownCssClass : 'bigdrop'});
      $( ".addnewrow" ).sortable();
    </script>

   <script>


$( ".sortable1" ).sortable();
$(".datepicker").datepicker({
       dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0
       });
$(".datepicker1").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0
       }).datepicker("setDate", "0");
$(".datepicker2").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: 0,
       setDate: 0
       }).datepicker("setDate", "0");

$(".datepicker3").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: 0
      
       });
$(".datepicker4").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: -2,
       maxDate: new Date()
      
       }).datepicker("setDate", "0");

$(".datepicker5").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: -2,
       maxDate: new Date()
      
       });

$(".attfromdate").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       maxDate: 0,
       maxDate: new Date()
      
       });
$(".atttodate").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       maxDate: 0,
       });


</script> 

<script type="text/javascript">
var jqf = $.noConflict();

  jqf('#password, #confirm_password').on('keyup', function () {
  if (jqf('#password').val() == jqf('#confirm_password').val()) {
    jqf('#result').html('<button class="btn btn-success" type="submit">RESET NOW</button>');
  } else 
    jqf('#result').html('<button class="btn btn-success" type="submit" disabled >RESET NOW</button>');
});
  $('.datatable').DataTable({
       drawCallback: function () {
        
              $('[data-toggle="popover"]').popover({
        placement : 'right',
        trigger : 'hover'
    }); 
            },

     "order": [[ 0, "desc" ]],
     "iDisplayLength": 25,

  });
  
  $('.datatablescroll').DataTable({

     "order": [[ 0, "desc" ]],
     "scrollY": 500,
     "scrollX": true,
     "iDisplayLength": 25
  });
$('.datatablescrollexport').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 25,
        "scrollY": 450,
        "scrollX": true,

        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'Report',          
            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'Report'
            },
            {
                extend: 'print',
                footer:true,
                title: 'Report'
            },

       ],
            });

</script>





  
  <footer class="main-footer no-print">

    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0V
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="http://www.subudhitechno.com">Subudhi Techno Engineers Pvt. Ltd.</a>.</strong> All rights
    reserved.
  </footer>

    
</body>
</html>
