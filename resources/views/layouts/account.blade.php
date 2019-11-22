<!DOCTYPE html>
@if(Auth::user()->usertype=='USER')
<script type="text/javascript">
    location.replace('/400');
</script>
@elseif(Auth::user()->usertype=='ADMIN')
<script type="text/javascript">
    location.replace('/400');
</script>
@elseif(Auth::user()->usertype=='HR')
<script type="text/javascript">
    location.replace('/400');
</script>
@endif

<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
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
      <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
      <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
      <style type="text/css">
        .chngreqfont{
          font-size: 11px!important;
        }
        .chngdrfont{
          font-size: 12px!important;
        }
      </style>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    <script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

 
  
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <style type="text/css">
      .amit-btn a{border-radius: 0px!important;}
    </style>
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
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
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
    <script src="{{ asset('js/jQuery.fixTableHeader.min.js') }}"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
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
          <a  onclick="window.history.back();">
            <p style="font-size: 20px;"><i class="fa fa-arrow-circle-left"></i> Back</p>
          </a>
        </li>
      </ul>

      <div class="navbar-custom-menu">
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
        <li class="header">MAIN NAVIGATION</li>
      
    
@if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER' ||Auth::user()->usertype=='ACCOUNTS ENTRY')



           <li class="{{ Request::is('adminaccounts') ? 'active' : '' }} treeview">
          <a href="/adminaccounts">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
          </li>
 
       <li class="{{ Request::is('defination*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>DEFINATION</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             @if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER')
             <li class="{{ Request::is('defination/labours') ? 'active' : '' }}"><a href="/defination/labours"><i class="fa fa-circle-o text-aqua"></i>MANAGE LABOURS</a></li>

             <li class="{{ Request::is('defination/vehicles') ? 'active' : '' }}"><a href="/defination/vehicles"><i class="fa fa-circle-o text-aqua"></i>MANAGE VEHICLES</a></li>

            <li class="{{ Request::is('defination/expensehead') ? 'active' : '' }}"><a href="/defination/expensehead"><i class="fa fa-circle-o text-aqua"></i>EXPENSE HEAD</a></li>

            <li class="{{ Request::is('defination/particulars') ? 'active' : '' }}"><a href="/defination/particulars"><i class="fa fa-circle-o text-aqua"></i>PARTICULARS</a></li>
            

            <li class="{{ Request::is('defination/deductiondefination') ? 'active' : '' }}"><a href="/defination/deductiondefination"><i class="fa fa-circle-o text-aqua"></i>DEDUCTION DEFINATION</a></li>
             @endif
            <li class="{{ Request::is('defination/vendors') ? 'active' : '' }}"><a href="/defination/vendors"><i class="fa fa-circle-o text-aqua"></i>VENDORS</a></li>

            <li class="{{ Request::is('defination/managevendors') ? 'active' : '' }}"><a href="/defination/managevendors"><i class="fa fa-circle-o text-aqua"></i>MANAGE ALL VENDORS</a></li>
             <li class="{{ Request::is('defination/units') ? 'active' : '' }}"><a href="/defination/units"><i class="fa fa-circle-o text-aqua"></i>UNITS</a></li>

             <li class="{{ Request::is('defination/hsn') ? 'active' : '' }}"><a href="/defination/hsn"><i class="fa fa-circle-o text-aqua"></i>HSN MASTER</a></li>

             <li class="{{ Request::is('defination/discount') ? 'active' : '' }}"><a href="/defination/discount"><i class="fa fa-circle-o text-aqua"></i>TENDER PREMIUM/DISCOUNT SETUP</a></li>
          </ul>
        </li>


      <li class="{{ Request::is('setupcrv*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>CREDIT VOUCHER SETUP</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="{{ Request::is('setupcrv/sacrsetup') ? 'active' : '' }}"><a href="/setupcrv/sacrsetup"><i class="fa fa-circle-o text-blue"></i>CR VOUCHER SETUP SA</a></li>

            <li class="{{ Request::is('setupcrv/steplcrsetup') ? 'active' : '' }}"><a href="/setupcrv/steplcrsetup"><i class="fa fa-circle-o text-red"></i>CR VOUCHER SETUP STEPL</a></li>
            <li class="{{ Request::is('setupcrv/stecscrsetup') ? 'active' : '' }}"><a href="/setupcrv/stecscrsetup"><i class="fa fa-circle-o text-red"></i>CR VOUCHER SETUP STECS</a></li>

          </ul>
        </li>
      
@if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER')
       <li class="{{ Request::is('banks*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-university"></i> <span>BANKS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="{{ Request::is('banks/banks') ? 'active' : '' }}"><a href="/banks/banks"><i class="fa fa-circle-o text-aqua"></i>ADD BANKS</a></li>
            
             <li class="{{ Request::is('banks/companybankaccount') ? 'active' : '' }}"><a href="/banks/companybankaccount"><i class="fa fa-circle-o text-red"></i>COMPANY BANK ACCOUNTS</a></li>

            <li class="{{ Request::is('banks/userbankaccount') ? 'active' : '' }}"><a href="/banks/userbankaccount"><i class="fa fa-circle-o text-red"></i>ADD USER BANK ACCOUNT</a></li>
            
             <li class="{{ Request::is('banks/viewalluserbankaccount') ? 'active' : '' }}"><a href="/banks/viewalluserbankaccount"><i class="fa fa-circle-o text-red"></i>VIEW ALL USER ACCOUNTS</a></li>

          </ul>
        </li>
        
        <li class="{{ Request::is('accbills*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-print"></i> <span>BILL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
         
              <span class="label label-danger pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('accbills/createbill') ? 'active' : '' }}"><a href="/accbills/createbill"><i class="fa fa-circle-o text-red"></i>CREATE A BILL</a></li>

             @if(Auth::user()->usertype=='MASTER ADMIN')
              
             <li class="{{ Request::is('accbills/viewpendingbills') ? 'active' : '' }}"><a href="/accbills/viewpendingbills"><i class="fa fa-circle-o text-red"></i>VIEW PENDING BILL</a></li>
              <li class="{{ Request::is('accbills/viewapprovedbills') ? 'active' : '' }}"><a href="/accbills/viewapprovedbills"><i class="fa fa-circle-o text-red"></i>VIEW APPROVED BILL</a></li>
                <li class="{{ Request::is('accbills/viewrejectbills') ? 'active' : '' }}"><a href="/accbills/viewrejectbills"><i class="fa fa-circle-o text-red"></i>VIEW REJECT BILL</a></li>
            @endif
            

            <li class="{{ Request::is('accbills/viewallbills') ? 'active' : '' }}"><a href="/accbills/viewallbills"><i class="fa fa-circle-o text-red"></i>VIEW ALL BILL</a></li>

          <!--   <li class="{{ Request::is('accbills/viewallinvoicenos') ? 'active' : '' }}"><a href="/accbills/viewallinvoicenos"><i class="fa fa-circle-o text-red"></i>VIEW ALL INVOICE NOS</a></li> -->


           
          
          </ul>
</li>

        <li class="{{ Request::is('crvoucher*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>CREDIT VOUCHER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li class="{{ Request::is('crvoucher/createcrvoucher*') ? 'active' : '' }} treeview">
              <a href="#"><i class="fa fa-circle-o text-blue"></i>CREATE CR VOUCHER
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!-- <li class="{{ Request::is('crvoucher/createcrvoucher/createnew') ? 'active' : '' }}"><a href="/crvoucher/createcrvoucher/createnew"><i class="fa fa-circle-o"></i>CREATE NEW</a></li> -->
                <li class="{{ Request::is('crvoucher/createcrvoucher/createfrombill') ? 'active' : '' }}"><a href="/crvoucher/createcrvoucher/createfrombill"><i class="fa fa-circle-o"></i>CREATE FROM BILL</a></li>
           
              </ul>
            </li>

          <!--  <li class="{{ Request::is('crvoucher/createcrvoucher') ? 'active' : '' }}"><a href="/crvoucher/createcrvoucher"><i class="fa fa-circle-o text-blue"></i>CREATE CR VOUCHER</a></li> -->

            <li class="{{ Request::is('crvoucher/viewallcrvoucher') ? 'active' : '' }}"><a href="/crvoucher/viewallcrvoucher"><i class="fa fa-circle-o text-blue"></i>VIEW ALL CR VOUCHER</a></li>


       


          </ul>

        </li>

          @php
              $countpendingexp=\App\expenseentry::where('status','PENDING')->count();
              $countapprovedexp=\App\expenseentry::where('status','APPROVED')->count();
              $countcancelledexp=\App\expenseentry::where('status','CANCELLED')->count();
              $countwalletpaidexp=\App\expenseentry::where('status','WALLET PAID')->count();
              $countallexp=\App\expenseentry::count();
              
          @endphp

         <li class="{{ Request::is('expense*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>EXPENSES ENTRY</span>

            <span class="pull-right-container">

              <i class="fa fa-angle-left pull-right"></i><span class="label label-warning pull-right">{{$countpendingexp}}</span>
            </span>

          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('expense/expenseentry') ? 'active' : '' }}"><a href="/expense/expenseentry"><i class="fa fa-circle-o text-red"></i>EXPENSE ENTRY</a></li>
            <li class="{{ Request::is('expense/pendingexpenseentry') ? 'active' : '' }}"><a href="/expense/pendingexpenseentry"><i class="fa fa-circle-o text-red"></i>PENDING EXPENSE ENTRY

              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countpendingexp}}</span>
                </span>
            </a></li>
            <li class="{{ Request::is('expense/approvedexpenseentry') ? 'active' : '' }}"><a href="/expense/approvedexpenseentry"><i class="fa fa-circle-o text-red"></i>APPROVED EXPENSE ENTRY

             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countapprovedexp}}</span>
                </span>
            </a></li>

            <li class="{{ Request::is('expense/cancelledexpenseentry') ? 'active' : '' }}"><a href="/expense/cancelledexpenseentry"><i class="fa fa-circle-o text-red"></i>CANCELLED EXPENSE ENTRY
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countcancelledexp}}</span>
                </span>
            </a></li>

            <li class="{{ Request::is('expense/walletpaidexpenseentry') ? 'active' : '' }}"><a href="/expense/walletpaidexpenseentry"><i class="fa fa-circle-o text-red"></i>WALLET PAID EXPENSE ENTRY
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countwalletpaidexp}}</span>
                </span>
            </a></li>

            <li class="{{ Request::is('expense/viewallexpenseentry') ? 'active' : '' }}"><a href="/expense/viewallexpenseentry"><i class="fa fa-circle-o text-red"></i>ALL EXPENSE ENTRY
                <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countallexp}}</span>
                </span>

            </a></li>


          </ul>
        </li>

  @endif

      @php
        $countpendingdrmgr=\App\debitvoucherheader::where('status','PENDING')->count();
        $countpendingdradmin=\App\debitvoucherheader::where('status','MGR APPROVED')->count();
        $countapproveddrvoucher=\App\debitvoucherheader::where('status','ADMIN APPROVED')
        ->count();
        $countcompleteddrvoucher=\App\debitvoucherheader::where('status','COMPLETED')
        ->count();
        $countcancelleddrvoucher=\App\debitvoucherheader::where('status','CANCELLED')
        ->count();
        $alldr=\App\debitvoucherheader::where('id','>','0')
        ->count();
      @endphp
         
          <li class="{{ Request::is('vouchers*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-rupee"></i> <span>DEBIT VOUCHER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                <span class="label label-warning pull-right">{{$countpendingdrmgr+$countpendingdradmin}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('vouchers/debitvoucher') ? 'active' : '' }}"><a href="/vouchers/debitvoucher"><i class="fa fa-circle-o text-red"></i>DEBIT VOUCHER</a></li>
          @if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER')
            <li class="{{ Request::is('vouchers/pendingdebitvouchermgr') ? 'active' : '' }}"><a href="/vouchers/pendingdebitvouchermgr" title="PENDING DR VOUCHER(MGR)" class="chngdrfont"><i class="fa fa-circle-o text-red"></i>PENDING DR VOUCHER(MGR)
            <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countpendingdrmgr}}</span>
            </span>

            </a></li>

            <li class="{{ Request::is('vouchers/pendingdebitvoucheradmin') ? 'active' : '' }}"><a href="/vouchers/pendingdebitvoucheradmin" class="chngdrfont" title="PENDING DR VOUCHER(ADMIN)"><i class="fa fa-circle-o text-red"></i>PENDING DR VOUCHER(ADMIN)
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countpendingdradmin}}</span>
            </span>
            </a></li>

             <li class="{{ Request::is('vouchers/approveddebitvoucher') ? 'active' : '' }}"><a href="/vouchers/approveddebitvoucher"><i class="fa fa-circle-o text-red"></i>APPROVED DR VOUCHER 
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countapproveddrvoucher}}</span>
            </span>
             </a></li>
               <li class="{{ Request::is('vouchers/completeddebitvoucher') ? 'active' : '' }}"><a href="/vouchers/completeddebitvoucher"><i class="fa fa-circle-o text-red"></i>COMPLETED DR VOUCHER 
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countcompleteddrvoucher}}</span>
            </span>
             </a></li>
               <li class="{{ Request::is('vouchers/cancelleddebitvoucher') ? 'active' : '' }}"><a href="/vouchers/cancelleddebitvoucher"><i class="fa fa-circle-o text-red"></i>CANCELLED DR VOUCHER 
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$countcancelleddrvoucher}}</span>
            </span>
             </a></li>

          @endif
            <li class="{{ Request::is('vouchers/viewalldebitvoucher') ? 'active' : '' }}"><a href="/vouchers/viewalldebitvoucher"><i class="fa fa-circle-o text-red"></i>ALL DEBIT VOUCHERS
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$alldr}}</span>
            </span>

            </a></li>
           

          </ul>
        </li>
        @if(Auth::user()->usertype=='MASTER ADMIN' ||Auth::user()->usertype=='ACCOUNTS' || Auth::user()->usertype=='CASHIER')
         @php

               $pendingdrcount=\App\debitvoucherpayment::where('paymentstatus','PENDING')
                                                       ->count();
                 $paiddrcount=\App\debitvoucherpayment::where('paymentstatus','PAID')
                                                       ->count();
           @endphp

          <li class="{{ Request::is('dvpay*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-book"></i> <span>DEBIT VOUCHER PAYMENT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-warning pull-right">{{$pendingdrcount}}</span>
                </span>
            </span>
          </a>
          <ul class="treeview-menu">
           <li class="{{ Request::is('dvpay/pendingdrpayment') ? 'active' : '' }}"><a href="/dvpay/pendingdrpayment"><i class="fa fa-circle-o text-aqua"></i>PENDING DR  PAYMENT

            <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$pendingdrcount}}</span>
                </span>
           </a></li>
            
             <li class="{{ Request::is('dvpay/paiddramount') ? 'active' : '' }}"><a href="/dvpay/paiddramount"><i class="fa fa-circle-o text-red"></i>PAID DR PAYMENTS
               <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$paiddrcount}}</span>
                </span>
             </a></li>

           

          </ul>
        </li>
       <li class="{{ Request::is('requisitions*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-retweet"></i> <span>REQUISITIONS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('requisitions/applicationform') ? 'active' : '' }}"><a href="/requisitions/applicationform"><i class="fa fa-circle-o text-red"></i>APPLICATION FORM</a></li>



          </ul>
        </li>


 

         @php
          $mgrpendingreqcount=\App\requisitionheader::where('status','PENDING MGR')
                          ->count();
          $hodpendingreqcount=\App\requisitionheader::where('status','PENDING HOD')
                          ->count();
          $pendingreqcount=\App\requisitionheader::where('status','PENDING')
                          ->count();
          $approvedreqcount=\App\requisitionheader::where('status','APPROVED')
                          ->count();
          $completedreqcount=\App\requisitionheader::where('status','COMPLETED')
                          ->count();
          $cancelledreqcount=\App\requisitionheader::where('status','CANCELLED')
                          ->count();


          @endphp
        <li class="{{ Request::is('viewrequisitions*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>VIEW REQUISITIONS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-warning pull-right">{{$mgrpendingreqcount+$pendingreqcount+$hodpendingreqcount}}</span>
            </span>
          </a>

       
          <ul class="treeview-menu">

                  <li class="{{ Request::is('viewrequisitions/pendingrequisitionshod') ? 'active' : '' }}"><a href="/viewrequisitions/pendingrequisitionshod" title="PENDING REQUISITIONS(FOR HOD)" class="chngreqfont"><i class="fa fa-circle-o text-blue"></i>PENDING REQUISITIONS(FOR HOD)
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$hodpendingreqcount}}</span>
                </span>
            </a></li>


                <li class="{{ Request::is('viewrequisitions/pendingrequisitionsmgr') ? 'active' : '' }}"><a title="PENDING REQUISITIONS(FOR ACCOUNTS)" class="chngreqfont" href="/viewrequisitions/pendingrequisitionsmgr"><i class="fa fa-circle-o text-blue"></i>PENDING REQUISITIONS(ACCOUNTS)
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$mgrpendingreqcount}}</span>
                </span>
            </a></li>

            <li class="{{ Request::is('viewrequisitions/pendingrequisitions') ? 'active' : '' }}"><a title="PENDING REQUISITIONS(FOR ADMIN)" class="chngreqfont" href="/viewrequisitions/pendingrequisitions"><i class="fa fa-circle-o text-blue"></i>PENDING REQUISITIONS(FOR ADMIN)
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$pendingreqcount}}</span>
                </span>
            </a></li>
            <li class="{{ Request::is('viewrequisitions/approvedrequisitions') ? 'active' : '' }}"><a href="/viewrequisitions/approvedrequisitions"><i class="fa fa-circle-o text-blue"></i>APPROVED REQUISITIONS
             <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$approvedreqcount}}</span>
                </span>
            </a></li>

             <li class="{{ Request::is('viewrequisitions/completedrequisitions') ? 'active' : '' }}"><a href="/viewrequisitions/completedrequisitions"><i class="fa fa-circle-o text-blue"></i>COMPLETED REQUISITIONS
              <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$completedreqcount}}</span>
                </span>
             </a></li>
           
              <li class="{{ Request::is('viewrequisitions/cancelledrequisitions') ? 'active' : '' }}"><a href="/viewrequisitions/cancelledrequisitions"><i class="fa fa-circle-o text-blue"></i>CANCELLED REQUISITIONS
               <span class="pull-right-container">
                  <span class="label label-success pull-right">{{$cancelledreqcount}}</span>
                </span>

              </a></li>
              <li class="{{ Request::is('viewrequisitions/viewapplicationform') ? 'active' : '' }}"><a href="/viewrequisitions/viewapplicationform"><i class="fa fa-circle-o text-red"></i>VIEW ALL APPLICATION FORM</a></li>

          </ul>

        </li>



         <li class="{{ Request::is('prb*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-credit-card"></i> <span>PAY REQUISITION BANK</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
             @php 
                  $banks=\App\useraccount::select('useraccounts.*','banks.bankname')
                        ->where('useraccounts.type','COMPANY')
                        ->leftJoin('banks','useraccounts.bankid','=','banks.id')
                        ->get();
             @endphp

             @if(count($banks)>0)
             @foreach($banks as $bank)
          <li class="{{ Request::is('prb/'.$bank->bankname.'/*') ? 'active' : '' }}"><a href="/prb/{{$bank->bankname}}/{{$bank->id}}"><i class="fa fa-circle-o text-blue"></i>{{$bank->bankname}} PENDING AMOUNTS</a></li>
          

              <li class="{{ Request::is('prb/paidamt/'.$bank->bankname.'/*') ? 'active' : '' }}"><a href="/prb/paidamt/{{$bank->bankname}}/{{$bank->id}}"><i class="fa fa-circle-o text-blue"></i>{{$bank->bankname}} PAID AMOUNTS</a></li>
             @endforeach
           
            @else
             <li class="{{ Request::is('prc/*') ? 'active' : '' }}"><a href="#"><i class="fa fa-circle-o text-blue"></i>CURRENTLY NO BANK ADDED</a></li>
            @endif
          </ul>
        </li>

         <li class="{{ Request::is('prc*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>PAY REQUISITION CASH</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('prc/requisitioncashrequest') ? 'active' : '' }}"><a href="/prc/requisitioncashrequest"><i class="fa fa-circle-o text-blue"></i>REQUISITION CASH REQUEST</a></li>
           
           <li class="{{ Request::is('prc/viewpaidrequisitioncash') ? 'active' : '' }}"><a href="/prc/viewpaidrequisitioncash"><i class="fa fa-circle-o text-blue"></i>VIEW PAID REQUISITION(CASH)</a></li>

          </ul>

        </li>
@endif

         <li class="{{ Request::is('ucacc*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>COMPLAINT</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('ucacc/complaint') ? 'active' : '' }}"><a href="/ucacc/complaint"><i class="fa fa-circle-o text-red"></i>CREATE A COMPLAINT</a></li>

            <li class="{{ Request::is('ucacc/complainttoresolve') ? 'active' : '' }}"><a href="/ucacc/complainttoresolve"><i class="fa fa-circle-o text-red"></i>TO DO LIST</a></li>

          </ul>
        </li>

<li class="{{ Request::is('accountmsg*') ? 'active' : '' }} treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>MESSAGE</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
               <span class="label label-danger pull-right" id="countmsg"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li class="{{ Request::is('usermsg/writemsg') ? 'active' : '' }}"><a href="/usermsg/writemsg"><i class="fa fa-circle-o text-red"></i>SEND A MESSAGE</a></li> -->

            <li class="{{ Request::is('accountmsg/mymessages') ? 'active' : '' }}"><a href="/accountmsg/mymessages"><i class="fa fa-circle-o text-red"></i>MESSAGES</a></li>
            
           

          </ul>
</li>
        @endif

       
    </section>
    <!-- /.sidebar -->
  </aside>



    <div class="content-wrapper">
       @if(Auth::user()->usertype=='MASTER ADMIN')
          <div class="btn-group btn-group-justified amit-btn">
            <a href="/" class="btn btn-warning btn-lg">Construction</a>
            <a href="/adminhr" class="btn btn-success btn-lg">HR</a>
            <a href="/adminaccounts" class="btn btn-warning btn-lg">Accounts</a>
            <a href="/admintender" class="btn btn-info btn-lg">TENDER</a>
          </div>   
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="text-center">
               
               STATUS GEAR 1.0V ACCOUNTS
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




 <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">

<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script>

<link rel="stylesheet" href="{{ URL::asset('plugins/select2/select2.min.css') }}">

<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="{{ URL::asset('plugins/select2/select2.full.min.js') }}"></script>



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
<script type="text/javascript">
  window.onpageshow = function(event) {
if (event.persisted) {
    window.location.reload() 
}
};
     
  $(".readonly").keydown(function(e){
        e.preventDefault();
    });
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
            });$('.datatable3').DataTable({
        dom: 'Bfrtip',
        "order": [[ 0, "asc" ]],
        "iDisplayLength": 25,

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
      
      $('.tableContainer').fixTableHeader();

</script>
  <script>
      $('.select2').select2({dropdownCssClass : 'bigdrop'});
      //$( ".addnewrow" ).sortable();
    </script>

   <script>
$(".datepicker").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0
       });

$(".datepicker3").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       setDate: 0,
        orientation: "bottom"
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

$(".datepicker4").datepicker({
   dateFormat: 'yy-mm-dd',
       showButtonPanel: true,
       changeYear: true,
       changeMonth: true,
       minDate: 0,
       setDate: 0
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
     "iDisplayLength": 25,
     "order": [[ 0, "desc" ]]
  });

 
</script>

<script type="text/javascript">
     countunreadmessage();
     setInterval(function(){
     countunreadmessage();
 }, 50000);

  


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
               }
             });
       }
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
