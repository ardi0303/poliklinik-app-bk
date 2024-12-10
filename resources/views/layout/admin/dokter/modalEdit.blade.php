<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <!-- Modal toggle -->
    <button data-modal-target="edit-dokter-modal-{{ $dokter->id }}"
        data-modal-toggle="edit-dokter-modal-{{ $dokter->id }}" type="button">
        Edit
    </button>

    <!-- Main modal -->
    <div id="edit-dokter-modal-{{ $dokter->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Dokter
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-dokter-modal-{{ $dokter->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label for="nama" class="text-sm font-bold">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="p-2 border border-black rounded-md" value="{{ $dokter->nama }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="alamat" class="text-sm font-bold">Alamat</label>
                            <input type="text" name="alamat" id="alamat"
                                class="p-2 border border-black rounded-md" value="{{ $dokter->alamat }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="no_hp" class="text-sm font-bold">No. HP</label>
                            <input type="text" name="no_hp" id="no_hp"
                                class="p-2 border border-black rounded-md" value="{{ $dokter->no_hp }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="poli" class="text-sm font-bold">Poli</label>
                            <select name="id_poli" id="id_poli" class="p-2 border border-black rounded-md">
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}"
                                        {{ $poli->id == $dokter->id_poli ? 'selected' : '' }}>
                                        {{ $poli->nama_poli }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center border-t py-5 border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="edit-dokter-modal-{{ $dokter->id }}" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                accept</button>
                            <button data-modal-hide="edit-dokter-modal-{{ $dokter->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
