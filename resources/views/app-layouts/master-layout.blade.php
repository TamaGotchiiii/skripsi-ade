<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM Keluhan Unmul</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin-lte/dist/css/skins/_all-skins.min.css')}}">

  <style>
    .modal { 
      overflow: auto !important; 
    }
    .dot-done {
      height: 13px;
      width: 13px;
      background-color: #00ff00;
      border-radius: 50%;
      display: inline-block;
    }

    .dot-progress {
      height: 13px;
      width: 13px;
      background-color: #ffff00;
      border-radius: 50%;
      display: inline-block;
    }

    .dot-queue {
      height: 13px;
      width: 13px;
      background-color: #ff0000;
      border-radius: 50%;
      display: inline-block;
    }
    
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="icon" href="{{asset('image/logob_SxE_icon.ico')}}">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
<div class="wrapper">

<header class="main-header">

  <!-- Logo -->
  <a href="index2.html" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Unmul</b>Complain</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="{{ route('logout') }}" 
            onclick="
            event.preventDefault();
            document.getElementById('logout-form').submit();
            ">Logout <i class="fa fa-sign-out"></i></a>
          <form action="{{route('logout')}}" method="POST" style="display: none;" id="logout-form">@csrf</form>
        </li>
      </ul>
    </div>

  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">NAVIGASI UTAMA</li>
      <li>
        <a href="{{url('/antrian-keluhan')}}">
        <i class="fa fa-clipboard"></i> <span>Antrian Keluhan</span>
        </a>
      </li>
      @if(Auth::user()->level_user == 0)
        <li>
          <a href="{{url('/keluhan-dalam-pengerjaan')}}">
          <i class="fa fa-dashboard"></i> <span>Keluhan dalam Pengerjaan</span>
          </a>
        </li>
      @endif
      <li>
        <a href="{{url('/keluhan-selesai')}}">
        <i class="fa fa-check-circle"></i> <span>Keluhan Selesai</span>
        </a>
      </li>
      @if(Auth::user()->level_user == 0)
        <li>
          <a href="{{url('/keluhan-diselesaikan')}}">
          <i class="fa fa-check-square"></i> <span>Keluhan Diselesaikan</span>
          </a>
        </li>
      @endif
      @if(Auth::user()->level_user != 2)
        <li>
          <a href="{{url('/laporan-keluhan')}}">
          <i class="fa fa-line-chart"></i> <span>Laporan Keluhan</span>
          </a>
        </li>
      @endif
      @if(Auth::user()->level_user == 0)
        <li>
          <a href="{{url('/daftar-user')}}">
          <i class="fa fa-users"></i> <span>Daftar User</span>
          </a>
        </li>
        <li>
          <a href="{{url('/daftar-unit')}}">
          <i class="fa fa-home"></i> <span>Daftar Unit/Fakultas</span>
          </a>
        </li>
      @endif
      <li class="header">USER PROFILE CONTROL</li>
      <li>
        <a href="{{url('/keluhan-selesai')}}">
        <i class="fa fa-user"></i> <span>Profil User</span>
        </a>
      </li>
      <li>
        <a href="{{url('/keluhan-selesai')}}">
        <i class="fa fa-lock"></i> <span>Password User</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
        @yield('content')
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.x
  </div>
  <strong>Copyright &copy; {{date('Y')}} <a href="https://adminlte.io">Universitas Mulawarman</a>.</strong> All rights
  reserved.
</footer>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

</div>
    
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('admin-lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin-lte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin-lte/dist/js/demo.js')}}"></script>
<!-- page script -->
@yield('js')
<script>
let a = {{Auth::user()->level_user}}
let url = String(window.location.href);
if(a == 0 && url.includes('/antrian-keluhan')){
$(function () {
  $('#example2').DataTable({
  'paging'      : true,
  'lengthChange': false,
  'searching'   : true,
  'ordering'    : true,
  'info'        : false,
  'autoWidth'   : false,
  'pageLength' : 5,
  'order': [[5, 'asc'], [4,'asc']]
  });

});
}else if(url.includes('/daftar-user') || url.includes('/daftar-unit')){
$(function () {
  $('#example2').DataTable({
    'paging'      : true,
  'lengthChange': false,
  'searching'   : true,
  'ordering'    : true,
  'info'        : false,
  'autoWidth'   : false,
  'pageLength' : 5,
  });
});
}else if(url.includes('/keluhan-dalam-pengerjaan')){
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'pageLength' : 5,
    'order': [4,'asc']
    });
  });
}else{
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : false,
    'autoWidth'   : false,
    'pageLength' : 5,
    });
  });
}
</script>
</body>
</html>