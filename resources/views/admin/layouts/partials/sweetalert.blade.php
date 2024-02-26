@if (session('success'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@elseif(session('error'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@elseif(session('warning'))
    <script>
        Swal.fire({
            position: 'center',
            icon: 'warning',
            text: '{{ session('warning') }}',
            showConfirmButton: true,
            timer: 1500
        })
    </script>
@endif
