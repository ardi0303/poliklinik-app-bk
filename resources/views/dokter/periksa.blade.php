<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <title>Dokter | Periksa</title>
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
        @elseif ($errors->any())
            <script>
                @foreach ($errors->all() as $error)
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: "{{ $error }}",
                        showConfirmButton: false,
                        timer: 3000
                    });
                @endforeach
            </script>
        @endif
        <div>
            @include('layout.sidebar')
        </div>
        <div class="container py-5">
            {{-- @include('layout.admin.poli.modalAdd') --}}
            <div class="relative overflow-x-auto shadow-md rounded-lg border border-black mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Pasien
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Keluhan
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarPolis as $daftarPoli)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $daftarPoli->pasien->nama }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $daftarPoli->keluhan }}
                                </td>
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    @if ($daftarPoli->dokter_action === 'Periksa')
                                        @include('layout.dokter.periksa.modalAdd')
                                    @elseif ($daftarPoli->dokter_action === 'Edit')
                                        @include('layout.dokter.periksa.modalEdit')
                                    @endif
                                    {{-- Additional content or actions can go here --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
