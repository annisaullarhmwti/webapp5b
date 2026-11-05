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