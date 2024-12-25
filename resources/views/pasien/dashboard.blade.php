<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Pasien | Dashboard</title>
</head>

<body>
    @include('layout.navbar')
    <div class="lg:flex ml-0 lg:ml-64">
        @if (session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            </script>
        @elseif(session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: "{{ session('error') }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
            </script>
        @endif
        <div>
            @include('layout.sidebar')
        </div>
        <div class="container py-5 grid grid-cols-1 gap-2">
            <a href="{{ route('pasien.daftar-poli') }}" class="bg-blue-500 text-white p-5 rounded-lg">
                <h1 class="text-2xl font-bold">Daftar Poli</h1>
                <p class="text-4xl font-bold">{{ $daftarPolis }}</p>
            </a>
        </div>
    </div>
</body>

</html>
