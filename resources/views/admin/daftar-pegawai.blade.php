<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pegawai') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title above the table -->
        <div class="px-4 py-4 mx-1">
            <h3 class="text-3xl font-bold text-black">Daftar Pegawai</h3>
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

                    <!-- Tombol Input Data Pegawai -->
                    <a href="{{ route('admin.input-pegawai') }}" class="bg-tertiary text-white px-6 py-2 rounded-md">
                        Input Data Pegawai
                    </a>
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
                                        Nama</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        NIP</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Jabatan</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Unit Kerja</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs text-center font-bold text-black uppercase tracking-widest">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listPegawai as $data)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $data->nama }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $data->nip }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $data->jabatan }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">{{ $data->unitKerja }}</td>
                                        <td class="px-16 py-10 text-s text-gray-800">
                                            <button type="button"
                                                class="text-s font-semibold text-blue-600 hover:text-blue-800 focus:outline-none">Detail</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav class="flex items-center gap-x-1" aria-label="Pagination">
                            <!-- Previous Button -->
                            <button type="button"
                                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                @if ($listPegawai->onFirstPage()) disabled @endif aria-label="Previous"
                                onclick="window.location='{{ $listPegawai->previousPageUrl() }}'">
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
                                @foreach ($listPegawai->links()->elements as $page)
                                    @if (is_array($page))
                                        @foreach ($page as $num => $url)
                                            <button type="button"
                                                class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-blue-500 hover:text-white py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                                @if ($num == $listPegawai->currentPage()) style="background-color: #E99A20; color: white;" @endif
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
                                @if ($listPegawai->hasMorePages()) onclick="window.location='{{ $listPegawai->nextPageUrl() }}'" @else disabled @endif
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
        </div>
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @foreach ($listPegawai as $data)
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
                    @if ($listPegawai->onFirstPage()) disabled @endif aria-label="Previous"
                    onclick="window.location='{{ $listPegawai->previousPageUrl() }}'">
                    <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    <span>Previous</span>
                </button>

                <div class="flex items-center gap-x-1">
                    <!-- Page Number Buttons -->
                    @foreach ($listPegawai->links()->elements as $page)
                        @if (is_array($page))
                            @foreach ($page as $num => $url)
                                <button type="button"
                                    class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-blue-500 hover:text-white py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
                                    @if ($num == $listPegawai->currentPage()) style="background-color: #E99A20; color: white;" @endif
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
                    @if ($listPegawai->hasMorePages()) onclick="window.location='{{ $listPegawai->nextPageUrl() }}'" @else disabled @endif
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
    </div>
</x-app-layout>
