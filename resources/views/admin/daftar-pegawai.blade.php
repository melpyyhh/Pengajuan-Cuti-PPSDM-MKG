<x-app-layout>
    <x-slot name="header">
        <h1 class="py-2 text-4xl font-bold tracking-widest text-gray-800">
            {{ __('Daftar Data Pegawai') }}
        </h1>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title -->
        <div>
            <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
                Daftar Data Pegawai
            </h1>
        </div>

        <!-- Button -->
        <div class="w-full -m-1.5 overflow-hidden mx-auto block max-md:hidden">
            <div class="inline-block w-full p-1 align-middle">
                <!-- Pencarian dan Tombol Input Data Pegawai -->
                <div class="flex items-center py-2 mb-5 space-x-4">
                    <!-- Search Form -->
                    <form action="{{ route('admin.daftar-pegawai') }}" method="GET" class="flex items-center flex-1">
                        <input type="text" name="search" id="search-input" placeholder="Cari..."
                            class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none max-w-[300px]"
                            value="{{ request('search') }}">
                        <button type="submit" class="px-4 py-2 text-white bg-yellow-500 rounded-r-md">
                            🔍
                        </button>
                    </form>
                    <!-- Tombol Input Data Pegawai -->
                    <a href="{{ route('admin.input-pegawai') }}" class="px-6 py-2 text-white rounded-md bg-tertiary">
                        Input Data Pegawai
                    </a>
                </div>


                <!-- Tabel -->
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow">
                    <table class="w-full mx-auto divide-y divide-gray-200 table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-10 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    No
                                </th>
                                <th scope="col"
                                    class="px-16 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    Nama
                                </th>
                                <th scope="col"
                                    class="px-10 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    NIP
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    Jabatan
                                </th>
                                <th scope="col"
                                    class="px-4 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    Unit Kerja
                                </th>
                                <th scope="col"
                                    class="px-10 py-4 text-xs font-bold tracking-widest text-black uppercase">
                                    Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($listPegawai as $data)
                                <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                    <td class="px-10 py-4 text-center text-gray-800 text-s">
                                        {{ ($listPegawai->currentPage() - 1) * $listPegawai->perPage() + $loop->iteration }}
                                    </td>
                                    <td class="px-16 py-4 text-center text-gray-800 text-s">{{ $data->nama }}</td>
                                    <td class="px-10 py-4 text-center text-gray-800 text-s">{{ $data->nip }}</td>
                                    <td class="px-4 py-4 text-center text-gray-800 text-s">{{ $data->jabatan }}</td>
                                    <td class="px-4 py-4 text-center text-gray-800 text-s">{{ $data->unitKerja }}</td>
                                    <td class="px-10 py-4 text-center text-gray-800 text-s">
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('admin.detail-pegawai', ['pegawaiId' => $data->id]) }}"
                                                class="flex items-center justify-center w-12 h-12 text-white bg-yellow-500 rounded-full hover:bg-orange-300 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24" class="w-6 h-6">
                                                    <path
                                                        d="M11 2a9 9 0 1 1-6.32 15.34l-4.05 4.05a1 1 0 0 1-1.41-1.41l4.05-4.05A9 9 0 0 1 11 2zm0 2a7 7 0 1 0 4.95 11.95A7 7 0 0 0 11 4zm-1 3h2v3h3v2h-3v3h-2v-3H7v-2h3V7z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                        Tidak ada data yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:hidden">
        @foreach ($listPegawai as $data)
            <div class="p-4 space-y-3 bg-[#f4f7fe] rounded-lg shadow">
                <div class="text-sm font-semibold text-gray-600">Nama : {{ $data->nama }}</div>
                <div class="text-sm font-semibold text-gray-600">NIP : {{ $data->nip }}</div>
                <div class="text-sm font-semibold text-gray-600">Jabatan : {{ $data->jabatan }}</div>
                <div class="text-sm font-semibold text-gray-600">Unit Kerja : {{ $data->unitKerja }}</div>
                <div>
                    <a href="{{ route('admin.detail-pegawai', ['pegawaiId' => $data->id]) }}"
                        class="px-2 text-sm font-semibold text-white transition-colors shadow rounded-xl bg-tertiary hover:bg-orange-300">
                        Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <nav class="flex items-center py-3 gap-x-1" aria-label="Pagination">
        <!-- Previous Button -->
        <button type="button"
            class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
            @if ($listPegawai->onFirstPage()) disabled @endif aria-label="Previous"
            onclick="window.location='{{ $listPegawai->previousPageUrl() }}'">
            <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
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
            <svg aria-hidden="true" class="hidden shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m9 18 6-6-6-6"></path>
            </svg>
        </button>
    </nav>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('admin.search-pegawai') }}",
                    method: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        $('tbody').html(response);
                    },
                    error: function() {
                        console.error('Terjadi kesalahan.');
                    }
                });
            });
        });
    </script>

</x-app-layout>
