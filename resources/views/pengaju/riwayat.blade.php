<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Cuti') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title above the table -->
        <div class="px-4 py-4 mx-1">
            <h3 class="text-3xl font-bold text-black">Riwayat Cuti</h3>
        </div>

        <div class="w-full -m-1.5 overflow-hidden mx-auto block max-md:hidden">
            <div class="p-1 w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200">
                    <div class="overflow-hidden rounded-lg shadow">
                        <table class="w-full table-auto divide-y divide-gray-200 mx-auto ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-16 py-10 text-start text-xs font-bold text-black uppercase tracking-widest">
                                        No</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-start text-xs font-bold text-black uppercase tracking-widest">
                                        Tanggal Pengajuan</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-start text-xs font-bold text-black uppercase tracking-widest">
                                        Jenis Cuti</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold text-black uppercase tracking-widest">Lama
                                        Cuti</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold text-black uppercase tracking-widest">
                                        Status</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold text-black uppercase tracking-widest">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatCuti as $cuti)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $cuti->tanggal_awal }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            {{ $cuti->pengajuan->cuti->jenis_cuti ?? '-' }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $cuti->lama_cuti }} Hari</td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            <span
                                                class="
                                                    @if (strtolower($cuti->status_ajuan) == 'diproses') p-1.5 bg-yellow-200 text-yellow-700 uppercase font-bold text-wider rounded-xl
                                                    @elseif(strtolower($cuti->status_ajuan) == 'disetujui')
                                                        p-1.5 bg-green-200 text-green-700 uppercase font-bold text-wider rounded-xl
                                                    @elseif(strtolower($cuti->status_ajuan) == 'ditolak')
                                                        p-1.5 bg-red-200 text-red-700 uppercase font-bold text-wider rounded-xl
                                                    @else
                                                        p-1.5 bg-gray-200 text-gray-700 @endif
                                                ">
                                                {{ ucfirst($cuti->status_ajuan) }}
                                            </span>
                                        </td>
                                        <td class="px-16 py-10 text-left text-s">
                                            <button type="button"
                                                class="text-xs font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @foreach ($riwayatCuti as $cuti)
                <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                    <!-- Nomor
                <div class="text-sm font-semibold text-gray-800">
                    {{ $loop->iteration }}
                </div> -->
                    <!-- Tanggal Pengajuan -->
                    <div class="text-sm text-gray-600">
                        Tanggal Pengajuan: {{ $cuti->tanggal_awal }}
                    </div>
                    <!-- Jenis Cuti -->
                    <div class="text-sm text-gray-600">
                        Jenis Cuti: {{ $cuti->cuti->name ?? '-' }}
                    </div>
                    <!-- Lama Cuti -->
                    <div class="text-sm text-gray-600">
                        Lama Cuti: {{ $cuti->lama_cuti }} Hari
                    </div>
                    <!-- Status -->
                    <div class="text-sm">
                        <span
                            class="
                @if (strtolower($cuti->status_ajuan) == 'diproses') p-1 bg-yellow-200 text-yellow-700 uppercase font-bold text-wider rounded-xl
                @elseif(strtolower($cuti->status_ajuan) == 'disetujui')
                    p-1 bg-green-200 text-green-700 uppercase font-bold text-wider rounded-xl
                @elseif(strtolower($cuti->status_ajuan) == 'ditolak')
                    p-1 bg-red-200 text-red-700 uppercase font-bold text-wider rounded-xl
                @else
                    p-1 bg-gray-200 text-gray-700 @endif
                ">
                            {{ ucfirst($cuti->status_ajuan) }}
                        </span>
                    </div>
                    <!-- Detail -->
                    <div>
                        <button type="button"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
