<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengajuan Cuti') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title above the table -->
        <div class="px-4 py-4 mx-1">
            <h3 class="text-3xl font-bold text-black">Daftar Pengajuan Cuti</h3>
        </div>

        <div class="w-full -m-1.5 overflow-hidden mx-auto block max-md:hidden">
            <div class="p-1 w-full inline-block align-middle">
                <!-- Pencarian dan Tombol Input Data Pegawai -->
                <div class="flex items-center mb-5 px-4 space-x-4">
                    <!-- Input Search -->
                    <div class="flex items-center flex-1">
                        <input type="text" placeholder="Search ..."
                            class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none max-w-[300px]">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-r-md">
                            🔍
                        </button>
                    </div>
                </div>


                <div class="overflow-x-hidden border border-gray-200">
                    <div class="overflow-hidden rounded-xl shadow">
                        <table class="w-full table-auto divide-y divide-gray-200 mx-auto ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        No</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Nama Pegawai</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Unit Kerja</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Jabatan</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Status Pemeriksaan</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPengajuan as $data)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            {{ $data->pegawai->nama }}
                                        </td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            {{ $data->pegawai->unitKerja }}
                                        </td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            {{ $data->pegawai->jabatan }}
                                        </td>
                                        <td class="px-16 py-10 text-xs text-gray-800">
                                            <span
                                                class="
                                                    @if (strtolower($data->status_ajuan) == 'diproses') p-1.5 bg-yellow-200 text-yellow-700 uppercase font-bold text-wider rounded-xl
                                                    @elseif(strtolower($data->status_ajuan) == 'disetujui')
                                                        p-1.5 bg-green-200 text-green-700 uppercase font-bold text-wider rounded-xl
                                                    @elseif(strtolower($data->status_ajuan) == 'ditolak')
                                                        p-1.5 bg-red-200 text-red-700 uppercase font-bold text-wider rounded-xl
                                                    @else
                                                        p-1.5 bg-gray-200 text-gray-700 @endif
                                                ">
                                                {{ ucfirst($data->status_ajuan) }}
                                            </span>
                                        </td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            <a href="/penyetuju/penyetuju-detail/{{ $data->pengajuan->id }}"
                                                class="text-s font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">
                                                Detail
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <nav class="flex items-center gap-x-1" aria-label="Pagination">
                            <!-- Previous Button -->
                            <button type="button"
                                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                @if ($listPengajuan->onFirstPage()) disabled @endif aria-label="Previous"
                                onclick="window.location='{{ $listPengajuan->previousPageUrl() }}'">
                                <svg aria-hidden="true" class="hidden shrink-0 size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                                <span>Previous</span>
                            </button>

                            <div class="flex items-center gap-x-1">
                                <!-- Page Number Buttons -->
                                @foreach ($listPengajuan->links()->elements as $page)
                                    @if (is_array($page))
                                        @foreach ($page as $num => $url)
                                            <button type="button"
                                                class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-blue-500 hover:text-white py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                                @if ($num == $listPengajuan->currentPage()) style="background-color: #E99A20; color: white;" @endif
                                                onclick="window.location='{{ $url }}'">
                                                {{ $num }}
                                            </button>
                                        @endforeach
                                    @endif
                                @endforeach
                            </div>

                            <!-- Next Button -->
                            <button type="button"
                                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                @if ($listPengajuan->hasMorePages()) onclick="window.location='{{ $listPengajuan->nextPageUrl() }}'" @else disabled @endif
                                aria-label="Next">
                                <span>Next</span>
                                <svg aria-hidden="true" class="hidden shrink-0 size-3.5"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}
                        {{-- <div class="grid grid-cols-1 gap-4 md:hidden">
            @foreach ($listPengajuan as $data)
            <div class="bg-white space-y-3 p-4 rounded-lg shadow">
                <!-- Nama -->
                <div class="text-sm text-gray-600">
                    Nama : {{ $data->nama }}
                </div>
                <!-- NIP -->
                <div class="text-sm text-gray-600">
                    NIP : {{ $data->nip }}
                </div>
                <!-- Jabatan -->
                <div class="text-sm text-gray-600">
                    Jabatan : {{ $data->jabatan }}
                </div>
                <!-- Unit Kerja -->
                <div class="text-sm text-gray-600">
                    Unit Kerja : {{ $data->unitKerja }}
                </div>
                <!-- Detail -->
                <div>
                    <button type="button"
                        class="text-xs font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</button>
                </div>
            </div>
            @endforeach
            <nav class="flex items-center gap-x-1" aria-label="Pagination">
                <!-- Previous Button -->
                <button type="button"
                    class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                    @if ($listPengajuan->onFirstPage()) disabled @endif aria-label="Previous"
                    onclick="window.location='{{ $listPengajuan->previousPageUrl() }}'">
                    <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    <span>Previous</span>
                </button>

                <div class="flex items-center gap-x-1">
                    <!-- Page Number Buttons -->
                    @foreach ($listPengajuan->links()->elements as $page)
                    @if (is_array($page))
                    @foreach ($page as $num => $url)
                    <button type="button"
                        class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-blue-500 hover:text-white py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                        @if ($num == $listPengajuan->currentPage()) style="background-color: #E99A20; color: white;" @endif
                        onclick="window.location='{{ $url }}'">
                        {{ $num }}
                    </button>
                    @endforeach
                    @endif
                    @endforeach
                </div>

                <!-- Next Button -->
                <button type="button"
                    class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                    @if ($listPengajuan->hasMorePages()) onclick="window.location='{{ $listPengajuan->nextPageUrl() }}'" @else disabled @endif
                    aria-label="Next">
                    <span>Next</span>
                    <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </nav>
        </div>

    </div> --}}
</x-app-layout>
