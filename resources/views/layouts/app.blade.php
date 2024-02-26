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

    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                timer: 3000
            })
        </script>
    @elseif(session('error'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                timer: 3000
            })
        </script>
    @elseif(session('warning'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'warning',
                text: '{{ session('warning') }}',
                showConfirmButton: true,
                timer: 3000
            })
        </script>
    @endif

</body>

</html>
