@if(session()->has('message'))
    <script>
        // Display SweetAlert message on page load
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: "{{ session('icon') }}", // You can use 'info', 'warning', 'error', etc.
                title: "{{ session('title') }}",
                text: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
@endif
