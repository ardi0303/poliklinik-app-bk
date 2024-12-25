<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <title>Dokter | Profil</title>
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
        <div class="container py-5 space-y-4">
            <h2 class="text-2xl font-bold">Profil</h2>
            <div class="space-y-2">
                <div class="flex flex-col gap-1">
                    <label for="nama" class="font-bold">Nama</label>
                    <p>{{ $dokter->nama }}</p>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="alamat" class="font-bold">Alamat</label>
                    <p>{{ $dokter->alamat }}</p>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="no_hp" class="font-bold">No. HP</label>
                    <p>{{ $dokter->no_hp }}</p>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="poli" class="font-bold">Poli</label>
                    <p>{{ $dokter->poli->nama_poli }}</p>
                </div>
            </div>
            @include('layout.dokter.profil.modalEdit')
        </div>
    </div>
</body>

</html>
