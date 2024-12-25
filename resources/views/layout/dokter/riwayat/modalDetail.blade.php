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
    <button onclick="showRiwayatPeriksa({{ $pasien->id }})"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Riwayat Periksa Pasien
    </button>

    <!-- Main modal -->
    <div id="detail-periksa-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Riwayat Periksa Pasien
                    </h3>
                    <button type="button" onclick="hideModal()"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>

                <!-- Modal body -->
                <div id="modal-content" class="p-4 md:p-5">
                    <!-- Konten akan diisi secara dinamis -->
                    <p class="text-gray-500">Loading data...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showRiwayatPeriksa(pasienId) {
            const modal = document.getElementById('detail-periksa-modal');
            const modalContent = document.getElementById('modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            modalContent.innerHTML = '<p class="text-gray-500">Loading data...</p>';

            fetch(`/dokter/riwayat-periksa/${pasienId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let content = '';
                        data.forEach(periksa => {
                            content += `
                              <div class="mb-4 grid grid-cols-2 gap-2">
                                <div>
                                  <p><strong>Tanggal Periksa:</strong> ${periksa.tgl_periksa}</p>
                                  <p><strong>Nama Pasien:</strong> ${periksa.daftar_poli.pasien.nama}</p>
                                  <p><strong>Nama Dokter:</strong> ${periksa.daftar_poli.jadwal_periksa.dokter.nama}</p>
                                  <p><strong>Keluhan:</strong> ${periksa.daftar_poli.keluhan}</p>
                                </div>
                                <div>
                                  <p><strong>Catatan:</strong> ${periksa.catatan}</p>
                                  <p><strong>Obat:</strong></p>
                                  <ul>
                                    ${periksa.detail_periksa?.map(detail => `<li>${detail.obat?.nama_obat || 'Tidak tersedia'} - Rp${parseInt(detail.obat?.harga || 0).toLocaleString()}</li>`).join('') || '<li>Tidak ada data obat</li>'}
                                  </ul>
                                  <p><strong>Biaya:</strong> Rp${parseInt(periksa.biaya_periksa).toLocaleString()}</p>
                                </div>
                              </div>
                              <hr class="my-4">
                            `;
                        });
                        modalContent.innerHTML = content;
                    } else {
                        modalContent.innerHTML =
                            '<p class="text-gray-500">Tidak ada riwayat periksa untuk pasien ini.</p>';
                    }
                })
                .catch(error => {
                    modalContent.innerHTML = '<p class="text-red-500">Terjadi kesalahan saat mengambil data.</p>';
                    console.error('Error:', error);
                });
        }

        function hideModal() {
            const modal = document.getElementById('detail-periksa-modal');
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>
