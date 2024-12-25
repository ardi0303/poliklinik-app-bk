<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <title>Admin | Dashboard</title>
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
        @endif
        <div>
            @include('layout.sidebar')
        </div>
        <div class="container py-5 grid grid-cols-4 gap-2">
            {{-- buatkan div 4 buah untuk menampilkan jumlah dari $dokters, $pasiens, $polis, dan $obats --}}
            <a href="{{ route('admin.dokter') }}" class="bg-blue-500 text-white p-5 rounded-lg">
                <h1 class="text-2xl font-bold">Dokter</h1>
                <p class="text-4xl font-bold">{{ $dokters }}</p>
            </a>
            <a href="{{ route('admin.pasien') }}" class="bg-green-500 text-white p-5 rounded-lg">
                <h1 class="text-2xl font-bold">Pasien</h1>
                <p class="text-4xl font-bold">{{ $pasiens }}</p>
            </a>
            <a href="{{ route('admin.poli') }}" class="bg-yellow-500 text-white p-5 rounded-lg">
                <h1 class="text-2xl font-bold">Poli</h1>
                <p class="text-4xl font-bold">{{ $polis }}</p>
            </a>
            <a href="{{ route('admin.obat') }}" class="bg-red-500 text-white p-5 rounded-lg">
                <h1 class="text-2xl font-bold">Obat</h1>
                <p class="text-4xl font-bold">{{ $obats }}</p>
            </a>
        </div>
    </div>
</body>

</html>
