<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM Keluhan Unmul</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <div class="content-wrapper">
        @yield('content')
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
<script>
  $(document).ready(function(){
      $('#chooser').click(function(){
          $('#chooseFile').click();
          $('input[type="file"]#chooseFile').change(function(e){
              var filename = e.target.files[0].name;
              $('#filename').val(filename);
          });
      });
      $('.addFile').click(function(){
        $('input[type="file"]#chooseFile').val('');
        $('#filename').val('');
      });
  });
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false,
      'pageLength' : 5,
    })
  })
</script>
</body>
</html>