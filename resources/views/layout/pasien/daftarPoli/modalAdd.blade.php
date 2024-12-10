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
    <button data-modal-target="add-poli-modal" data-modal-toggle="add-poli-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Daftar Poli
    </button>

    <!-- Main modal -->
    <div id="add-poli-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Daftar Poli
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="add-poli-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->

                <form class="p-4 md:p-5" action="{{ route('pasien.daftar-poli.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label for="no_rm" class="text-sm font-bold">Nomor Rekam Medis</label>
                            <input type="text" name="no_rm" id="no_rm"
                                class="p-2 border border-black rounded-md bg-gray-200" readonly
                                value={{ $no_rm }}>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="nama_poli" class="text-sm font-bold">Pilih Poli</label>
                            <select name="id_poli" id="id_poli" class="p-2 border border-black rounded-md">
                                <option value="">Pilih Poli</option>
                                @foreach ($polis as $poli)
                                    <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="pilih_jadwal" class="text-sm font-bold">Pilih Jadwal</label>
                            <select name="id_jadwal" id="id_jadwal" class="p-2 border border-black rounded-md" disabled>
                                <option value="">Pilih Jadwal</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="keluhan" class="text-sm font-bold">Keluhan</label>
                            <input type="text" name="keluhan" id="keluhan"
                                class="p-2 border border-black rounded-md">
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center border-t py-5 border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="add-poli-modal" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                accept</button>
                            <button data-modal-hide="add-poli-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('id_poli').addEventListener('change', function() {
            const idPoli = this.value;
            const jadwalSelect = document.getElementById('id_jadwal');

            jadwalSelect.innerHTML = '<option value="">Memuat...</option>';
            jadwalSelect.disabled = true;

            if (idPoli) {
                console.log(idPoli);
                fetch(`jadwal-periksa/${idPoli}`)
                    .then(response => response.json())
                    .then(data => {
                        jadwalSelect.innerHTML = '<option value="">Pilih Jadwal</option>';
                        data.forEach(jadwal => {
                            jadwalSelect.innerHTML +=
                                `<option value="${jadwal.id}">${jadwal.dokter.nama} ${jadwal.hari} - ${jadwal.jam_mulai} s/d ${jadwal.jam_selesai}</option>`;
                        });
                        jadwalSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        jadwalSelect.innerHTML = '<option value="">Terjadi kesalahan</option>';
                    });
            } else {
                jadwalSelect.innerHTML = '<option value="">Pilih Poli terlebih dahulu</option>';
            }
        });
    </script>
</body>

</html>
