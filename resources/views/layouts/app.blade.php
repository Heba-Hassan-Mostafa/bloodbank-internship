<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blood Bank</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/css/all.css')}}" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/css/ionicons.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset('adminlte/plugins/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">
   </head>
    <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <form action="{{url('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        logout
                    </button>
                </form>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="{{asset('adminlte/img/AdminLTELogo.png')}}"
                 alt="Blood Bank Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">Blood Bank</span>
        </a>

        <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->


                    <li class="nav-item">
                        <a href="{{url(route('client.index'))}}" class="nav-link">
                            <i class="fa fa-users"></i>
                            <p>العملاء</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('governorate.index'))}}" class="nav-link">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>المحافظات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('category.index'))}}" class="nav-link">
                            <i class="fa fa-list"></i>
                            <p>الاقسام</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('post.index'))}}" class="nav-link">
                            <i class="fa fa-comment"></i>
                            <p>المقالات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('order.index'))}}" class="nav-link">
                            <i class="fas fa-heart"></i>
                            <p> التبرعات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('contact.index'))}}" class="nav-link">
                            <i class="fas fa-phone"></i>
                            <p>اتصل بنا</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('setting.index'))}}" class="nav-link">
                            <i class="fas fa-cogs"></i>
                            <p>الاعدادات</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('user.change-password'))}}" class="nav-link">
                            <i class="fa fa-key"></i>
                            <p>تغيير كلمة المرور</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('user.index'))}}" class="nav-link">
                            <i class="fa fa-users"></i>
                            <p>المستخدمين </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(route('role.index'))}}" class="nav-link">
                            <i class="fa fa-list"></i>
                            <p>رتب المستخدمين </p>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->


        <!-- /.sidebar -->
            </div>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('page_title')</h1>
                        <small>@yield('small_title')</small>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.0-beta.1
        </div>
        <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">BloodBank.io</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/js/demo.js')}}"></script>

    @stack('scripts')
</body>
</html>
