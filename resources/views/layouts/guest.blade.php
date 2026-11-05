<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Masuk') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
</head>
<body class="bg-body-tertiary">
    <main class="container min-vh-100 py-4 d-flex align-items-center justify-content-center">
        <div class="w-100" style="max-width: 420px;">
            @yield('content')
        </div>
    </main>

    <!-- Skrip SweetAlert untuk menangani session success/error di halaman guest/login -->
    @if (session('success') || session('error'))
        <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const successMessage = @json(session('success'));
                const errorMessage = @json(session('error'));

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                if (successMessage) {
                    Toast.fire({
                        icon: 'success',
                        title: successMessage
                    });
                }

                if (errorMessage) {
                    Toast.fire({
                        icon: 'error',
                        title: errorMessage
                    });
                }
            });
        </script>
    @endif

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>