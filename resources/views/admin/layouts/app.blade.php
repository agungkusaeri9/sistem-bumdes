<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <x-Admin.Navbar></x-Admin.Navbar>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-Admin.Sidebar></x-Admin.Sidebar>
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <x-Admin.Footer></x-Admin.Footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('admin.layouts.partials.scripts')
</body>

</html>
