<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts/partials/head')
</head>

<body class="animsition">

    <x-Frontend.Navbar />



    @yield('content')

    <!-- Footer -->
    <x-Frontend.Footer />


    @include('layouts.partials.scripts')

</body>

</html>
