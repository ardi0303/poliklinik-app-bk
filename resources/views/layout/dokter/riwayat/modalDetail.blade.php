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
    <button data-modal-target="detail-periksa-modal-{{ $periksa->id }}"
        data-modal-toggle="detail-periksa-modal-{{ $periksa->id }}"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Riwayat Periksa Pasien
    </button>

    <!-- Main modal -->
    <div id="detail-periksa-modal-{{ $periksa->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Riwayat Periksa Pasien
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="detail-periksa-modal-{{ $periksa->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->

                <div class="p-4 md:p-5 grid grid-cols-2 gap-2">
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label for="tgl_periksa" class="text-sm font-bold">Tanggal Periksa</label>
                            <p>{{ $periksa->tgl_periksa }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="nama_pasien" class="text-sm font-bold">Nama Pasien</label>
                            <p>{{ $periksa->daftarPoli->pasien->nama }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="nama_dokter" class="text-sm font-bold">Nama Dokter</label>
                            <p>{{ $periksa->daftarPoli->jadwalPeriksa->dokter->nama }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="keluhan" class="text-sm font-bold">Keluhan</label>
                            <p>{{ $periksa->daftarPoli->keluhan }}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label for="catatan" class="text-sm font-bold">Catatan</label>
                            <p>{{ $periksa->catatan }}</p>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="obat" class="text-sm font-bold">Obat</label>
                            <ul>
                                @foreach ($periksa->detailPeriksa as $detail)
                                    <li>{{ $detail->obat->nama_obat }} -
                                        Rp{{ number_format($detail->obat->harga, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- biaya --}}
                        <div class="flex flex-col gap-2">
                            <label for="biaya" class="text-sm font-bold">Biaya</label>
                            <p>Rp{{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
