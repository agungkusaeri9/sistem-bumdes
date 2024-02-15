<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.partials.head')
</head>

<body>
    <x-Admin.Navbar></x-Admin.Navbar>
    <x-Admin.Sidebar></x-Admin.Sidebar>
    @yield('content')

    <x-Admin.Footer></x-Admin.Footer>
    @include('admin.layouts.partials.scripts')
</body>

</html>
