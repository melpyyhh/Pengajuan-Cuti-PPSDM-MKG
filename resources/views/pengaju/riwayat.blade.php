<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
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
            <div class="inline-block w-full p-1 align-middle">
                <div class="overflow-hidden border border-gray-200">
                    <div class="overflow-hidden rounded-lg shadow">
                        <table class="w-full mx-auto divide-y divide-gray-200 table-auto ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase text-start">
                                        No
                                    </th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase text-start">
                                        Tanggal Pengajuan
                                    </th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase text-start">
                                        Jenis Cuti
                                    </th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">Lama
                                        Cuti
                                    </th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Status
                                    </th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                            Detail
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatCuti as $cuti)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="px-16 py-10 text-gray-800 text-s">{{ $loop->iteration }}</td>
                                        <td class="px-16 py-10 text-gray-800 text-s">{{ $cuti->tanggal_awal }}</td>
                                        <td class="px-16 py-10 text-gray-800 text-s">
                                            {{ $cuti->pengajuan->cuti->jenis_cuti ?? '-' }}
                                        </td>
                                        <td class="px-16 py-10 text-gray-800 text-s">{{ $cuti->lama_cuti }} Hari</td>
                                        <td class="px-16 py-10 text-gray-800 text-s">
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
                                            <a href="/pengaju/pengajuan-detail/{{$cuti->pengajuan->id}}"
                                                class="text-xs font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid flex-1 grid-cols-1 gap-4 md:hidden">
            @foreach ($riwayatCuti as $cuti)
                <div class="p-4 space-y-3 bg-white rounded-lg shadow">
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
                        <a href="/pengaju/pengajuan-detail/{{$cuti->pengajuan->id}}"
                            class="text-xs font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
