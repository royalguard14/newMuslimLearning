
<?php $routeUri = Route::currentRouteName();
$user = Auth::user();

if($user->role == 1){

   $users=array('first_name'=>'Ghaizar','last_name'=>'Bautista');
 

}else if($user->role == 2){

  $usersx = DB::table('professor')->where('professor_id_number',$user->id_number)->first();

  $users=array('first_name'=>$usersx->professor_first_name,'last_name'=>$usersx->professor_lastname_name);
  
}else{

    $users=array('first_name'=>'student','last_name'=>'student');
}

$guard = Auth::user();
$role = DB::table('role')->Where('id',$guard->role)->first();
$ids = explode (",", $role->modules);
$mode = DB::table('designs')->where('id',1)->first();
$accent_color = DB::table('designs')->where('id',23)->first();
$sb = DB::table('designs')->where('id',24)->first();
$sidebar = explode("|", $sb->class);
$bl = DB::table('designs')->where('id',25)->first();

?>
<!DOCTYPE html>
<html lang="en">
<head> 

  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ZEAR-HRIS</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/panel/plugins/fontawesome-free/css/all.min.css')}}">
   <link href="{{asset('assets_old/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/panel/dist/css/adminlte.css')}}">

   <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/panel/plugins/daterangepicker/daterangepicker.css')}}">

<!-- Select2 -->
<link rel="stylesheet" href="{{asset('assets/panel/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/panel/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">



  
@yield('extra_head')

</head>
@include('sweetalert::alert')
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed {{$accent_color->class}} {{$mode->class}}" >
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('assets_old/img/zear_logo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  @include('layouts.include.header')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 {{$sidebar[1]}}" >
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link {{$bl->class}}">
      <img src="{{asset('assets_old/img/zear_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight">ZEAR DEVELOPER</span>
    </a>

    <!-- Sidebar -->
    

    <div class="sidebar {{$sidebar[0]}}">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

        
          <img src="{{asset('uploads/users/default.jpg')}}" class="img-circle elevation-2" alt="User Image">
                     
        </div>
        <div class="info">
          <a href="#" class="d-block">{!! strtoupper($users['first_name'].' '.$users['last_name']) !!}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        
        </div>
      </div>

      <!-- Sidebar Menu -->
    @include('layouts.include.navigator')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  @yield('heading')
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
  @yield('body')
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
@include('layouts.include.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('layouts.include.script')
@yield('extra_script')

<!-- Select2 -->
<script src="{{asset('assets/panel/plugins/select2/js/select2.full.min.js')}}"></script>


<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/panel/dist/js/demo.js')}}"></script>

<script type="text/javascript">
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
</script>  

    <script type="text/javascript">
        
$(function () {

$('.select2').select2()

//Initialize Select2 Elements
$('#select2bs4,#select2bs5,#sel_courses,#sel_subject,#sel_section,#sel_subject,#sel_professor,#sel_days').select2({
theme: 'bootstrap4'
})



    //Date range picker
    $('#reservation').daterangepicker()


});       
    </script>  
</body>
</html>
