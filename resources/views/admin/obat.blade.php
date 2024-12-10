<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
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
            @include('layout.admin.obat.modalAdd')
            <div class="relative overflow-x-auto shadow-md rounded-lg border border-black mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nama Obat
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Kemasan
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3 text-end">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obats as $obat)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $obat->nama_obat }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $obat->kemasan }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $obat->harga }}
                                </td>
                                <td class="px-6 py-4 flex gap-2 justify-end">
                                    @include('layout.admin.obat.modalEdit')
                                    <form action="{{ route('admin.obat.delete', $obat->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this obat?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="">Delete</button>
                                    </form>
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
