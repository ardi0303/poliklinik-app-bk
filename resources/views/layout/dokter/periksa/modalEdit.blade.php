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
    <button data-modal-target="edit-periksa-modal-{{ $daftarPoli->id }}" class="edit-button"
        data-modal-toggle="edit-periksa-modal-{{ $daftarPoli->id }}" type="button">
        Edit
    </button>

    <!-- Main modal -->
    <div id="edit-periksa-modal-{{ $daftarPoli->id }}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Periksa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="edit-periksa-modal-{{ $daftarPoli->id }}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('dokter.periksa.update', $daftarPoli->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="space-y-4">
                        <div class="flex flex-col gap-2">
                            <label for="nama" class="text-sm font-bold">Nama Pasien</label>
                            <input type="text" name="nama" id="nama"
                                class="p-2 border border-black rounded-md bg-gray-200" readonly
                                value="{{ $daftarPoli->pasien->nama }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="tgl_periksa" class="text-sm font-bold">Tanggal Periksa</label>
                            <input type="date" name="tgl_periksa" id="tgl_periksa"
                                class="p-2 border border-black rounded-md"
                                value="{{ $daftarPoli->periksa->tgl_periksa }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="catatan" class="text-sm font-bold">Catatan</label>
                            <input type="text" name="catatan" id="catatan"
                                class="p-2 border border-black rounded-md" value="{{ $daftarPoli->periksa->catatan }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="obat" class="text-sm font-bold">Obat</label>
                            <select class="p-2 border border-black rounded-md" id="resep-{{ $daftarPoli->id }}"
                                name="obat[]" multiple="multiple">
                                @if ($daftarPoli->periksa)
                                    @foreach ($daftarPoli->periksa->detailPeriksa as $detail)
                                        <option value="{{ $detail->obat->id }}" data-harga="{{ $detail->obat->harga }}"
                                            selected>
                                            {{ $detail->obat->nama_obat }} -
                                            Rp{{ number_format($detail->obat->harga, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                @endif
                                @foreach ($obats as $obat)
                                    {{-- Cek apakah obat ini sudah dipilih sebelumnya --}}
                                    @if (!optional($daftarPoli->periksa)->detailPeriksa->contains('id_obat', $obat->id))
                                        <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                            {{ $obat->nama_obat }} - Rp{{ number_format($obat->harga, 0, ',', '.') }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="biaya_periksa" class="text-sm font-bold">Biaya Periksa</label>
                            <input type="text" name="biaya_periksa" id="biaya-{{ $daftarPoli->id }}"
                                class="p-2 border border-black rounded-md bg-gray-200" readonly>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center border-t py-5 border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="edit-periksa-modal-{{ $daftarPoli->id }}" type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                accept</button>
                            <button data-modal-hide="edit-periksa-modal-{{ $daftarPoli->id }}" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="module">
        $(document).ready(function() {
            // Inisialisasi Select2 untuk setiap resep berdasarkan ID
            $('[id^="resep-"]').each(function() {
                $(this).select2();
            });

            // Fungsi untuk menghitung biaya periksa
            function calculateBiayaPeriksa(modalId) {
                let totalPrice = 0;
                // Seleksi elemen dengan ID dinamis
                $(`#resep-${modalId} option:selected`).each(function() {
                    totalPrice += parseFloat($(this).data('harga')) || 0;
                });
                totalPrice += 150000; // Tambahkan biaya tetap
                // Update input biaya berdasarkan ID
                $(`#biaya-${modalId}`).val(totalPrice);
            }

            // Event listener untuk perubahan pada select
            $('[id^="resep-"]').on('change', function() {
                // Ambil ID unik dari elemen resep
                const modalId = $(this).attr('id').split('-')[1];
                calculateBiayaPeriksa(modalId);
            });

            // Hitung biaya awal untuk setiap modal
            $('[id^="resep-"]').each(function() {
                const modalId = $(this).attr('id').split('-')[1];
                calculateBiayaPeriksa(modalId);
            });
        });
    </script>
</body>

</html>
