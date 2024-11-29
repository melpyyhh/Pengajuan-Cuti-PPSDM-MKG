<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Cuti') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title above the table -->
        <div class="px-0 py-4 mx-1">
            <h3 class="text-4xl font-bold text-black">Riwayat Cuti</h3>
        </div>

        <div class="w-full -m-1.5 overflow-x-auto mx-auto">
            <div class="p-1.5 w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                    <!-- Tabel dengan kelas w-full dan mx-auto untuk perataan tengah -->
                    <table class="w-full min-w-full divide-y divide-gray-200 mx-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-20 py-10 text-start text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">#</th>
                                <th scope="col" class="px-20 py-10 text-start text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">TANGGAL PENGAJUAN</th>
                                <th scope="col" class="px-20 py-10 text-start text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">JENIS CUTI</th>
                                <th scope="col" class="px-20 py-10 text-end text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">LAMA CUTI</th>
                                <th scope="col" class="px-20 py-10 text-end text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">PROSES</th>
                                <th scope="col" class="px-20 py-10 text-end text-xs font-bold text-black uppercase tracking-widest whitespace-nowrap">DETAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 Sementara -->
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-20 py-10 whitespace-nowrap text-sm font-medium text-gray-800">1</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">30/11/2024</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Cuti Tahunan</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">2 Hari</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Proses</td>
                                <td class="px-20 py-10 whitespace-nowrap text-left text-sm font-medium">
                                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Detail</button>
                                </td>

                            </tr>
                            <!-- Row 2 -->
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-20 py-10 whitespace-nowrap text-sm font-medium text-gray-800">2</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">29/11/2024</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Cuti Sakit</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">1 Hari</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Selesai</td>
                                <td class="px-20 py-10 whitespace-nowrap text-left text-sm font-medium">
                                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Detail</button>
                                </td>

                            </tr>
                            <!-- Row 3 -->
                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                <td class="px-20 py-10 whitespace-nowrap text-sm font-medium text-gray-800">3</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">28/11/2024</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Cuti Melahirkan</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">3 Hari</td>
                                <td class="px-20 py-10 whitespace-nowrap text-sm text-gray-800">Proses</td>
                                <td class="px-20 py-10 whitespace-nowrap text-left text-sm font-medium">
                                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Detail</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>