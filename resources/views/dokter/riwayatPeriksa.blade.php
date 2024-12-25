<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dokter | Riwayat Pasien</title>
</head>

<body>
    @include('layout.navbar')
    <div class="lg:flex ml-0 lg:ml-64">
        <div>
            @include('layout.sidebar')
        </div>
        <div class="container py-5">
            <div class="relative overflow-x-auto shadow-md rounded-lg border border-black mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Pasien
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alamat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No. KTP
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No. HP
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No. RM
                            </th>

                            <th scope="col" class="px-6 py-3 text-end">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pasiens as $pasien)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $pasien->nama }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $pasien->alamat }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pasien->no_ktp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pasien->no_hp }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $pasien->no_rm }}
                                </td>
                                {{-- <td class="px-6 py-4">
                                    {{ $daftarPoli->keluhan }}
                                </td> --}}
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    @include('layout.dokter.riwayat.modalDetail')
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
