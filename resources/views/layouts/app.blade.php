<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SIAKAD') | {{ config('app.name') }}</title>

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/siakad.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-body-tertiary">
    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.sidebar')

            <main class="col-lg-9 col-xl-10 px-3 px-md-4 py-4">
                @include('layouts.partials.flash')
                
                @yield('content')

                <footer class="text-center text-body-secondary small mt-5">
                    &copy; {{ date('Y') }} {{ config('app.name') }} - D3 Teknik Informatika
                </footer>
            </main>
        </div>
    </div>

    <!-- SweetAlert Script untuk layout utama (app) -->
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
    @stack('scripts')
</body>
</html>