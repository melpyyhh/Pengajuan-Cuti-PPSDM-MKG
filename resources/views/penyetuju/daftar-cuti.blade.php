<x-app-layout>
    <x-slot name="header">
        <h2 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
            {{ __('Daftar Cuti') }}
        </h2>
    </x-slot>

    <!-- Content -->
    <div class="flex flex-col w-full">
        <!-- Title -->
        <div>
            <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
                Daftar Cuti
            </h1>
        </div>

        <div class="w-full -m-1.5 overflow-hidden mx-auto block max-md:hidden">
            <div class="inline-block w-full p-1 align-middle">
                <!-- Pencarian -->
                <div class="flex items-center py-2 mb-5 space-x-4">
                    <!-- Input Search -->
                    <div class="flex items-center flex-1">
                        <form action="{{ route('penyetuju.daftar-cuti') }}" method="GET" class="flex items-center flex-1">
                            <input type="text" name="search" id="search-input" placeholder="Cari..." value="{{ request()->search }}"
                                class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none max-w-[300px]">
                            <button type="submit" class="px-4 py-2 text-white bg-yellow-500 rounded-r-md">
                                🔍
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Tabel -->
                <div class="overflow-hidden border border-gray-200 rounded-lg shadow">
                    <div class="overflow-hidden shadow rounded-xl">
                        <table class="w-full mx-auto divide-y divide-gray-200 rounded-lg table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        No</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Nama Pegawai</th>
                                    <th scope="col"
                                        class="px-10 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Unit Kerja</th>
                                    <th scope="col"
                                        class="px-16 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Jabatan</th>
                                    <th scope="col"
                                        class="px-10 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Status Pemeriksaan</th>
                                    <th scope="col"
                                        class="px-10 py-10 text-xs font-bold tracking-widest text-black uppercase">
                                        Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($listPengajuan as $data)
                                    <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                                        <td class="px-16 py-10 text-center text-gray-800 text-s">
                                            {{ ($listPengajuan->currentPage() - 1) * $listPengajuan->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-16 py-10 text-center text-gray-800 text-s">
                                            {{ $data->pegawai->nama }}
                                        </td>
                                        <td class="px-10 py-10 text-center text-gray-800 text-s">
                                            {{ $data->pegawai->unitKerja }}
                                        </td>
                                        <td class="px-16 py-10 text-center text-gray-800 text-s">
                                            {{ $data->pegawai->jabatan }}
                                        </td>
                                        <td class="px-16 py-10 text-center text-gray-800 text-s">
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
                                        <td class="px-10 py-10 text-center text-gray-800 text-s">
                                            <div class="flex items-center justify-center">
                                                <button
                                                    onclick="window.location.href='/penyetuju/penyetuju-detail/{{ $data->pengajuan->id }}'"
                                                    class="flex items-center justify-center w-12 h-12 text-gray-800 rounded-full bg-tertiary hover:bg-orange-300 focus:outline-none">
                                                    <svg fill="#08244B" viewBox="0 0 64 64" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#08244B"
                                                        class="w-6 h-6">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M36,21c0-2.206-1.794-4-4-4s-4,1.794-4,4s1.794,4,4,4S36,23.206,36,21z M30,21c0-1.103,0.897-2,2-2s2,0.897,2,2 s-0.897,2-2,2S30,22.103,30,21z">
                                                                </path>
                                                                <path
                                                                    d="M27,41v6h10v-6h-2V27h-8v6h2v8H27z M29,31v-2h4v14h2v2h-6v-2h2V31H29z">
                                                                </path>
                                                                <path
                                                                    d="M32,1C14.907,1,1,14.907,1,32s13.907,31,31,31s31-13.907,31-31S49.093,1,32,1z M32,61C16.009,61,3,47.991,3,32 S16.009,3,32,3s29,13.009,29,29S47.991,61,32,61z">
                                                                </path>
                                                                <path
                                                                    d="M32,7c-5.236,0-10.254,1.607-14.512,4.649l1.162,1.628C22.567,10.479,27.184,9,32,9c12.682,0,23,10.318,23,23 c0,4.816-1.479,9.433-4.277,13.35l1.628,1.162C55.393,42.254,57,37.236,57,32C57,18.215,45.785,7,32,7z">
                                                                </path>
                                                                <path
                                                                    d="M32,55C19.318,55,9,44.682,9,32c0-4.817,1.479-9.433,4.277-13.35l-1.627-1.162C8.608,21.746,7,26.764,7,32 c0,13.785,11.215,25,25,25c5.236,0,10.254-1.607,14.512-4.649l-1.162-1.628C41.433,53.521,36.816,55,32,55z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </button>
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

        <!-- Mobile View -->
        <div class="grid flex-1 grid-cols-1 gap-4 md:hidden">
            <div class="flex items-center flex-1">
                <form action="{{ route('penyetuju.daftar-cuti') }}" method="GET" class="flex items-center flex-1">
                    <input type="text" name="search" id="search-input" placeholder="Cari..." value="{{ request()->search }}"
                        class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none max-w-[300px]">
                    <button type="submit" class="px-4 py-2 text-white bg-yellow-500 rounded-r-md">
                        🔍
                    </button>
                </form>
            </div>
            <div class="grid flex-1 grid-cols-1 gap-4 md:hidden">
                @forelse ($listPengajuan as $data)
                    <div class="p-4 space-y-3 bg-[#F4F7FE] rounded-lg shadow-md">
                       <!-- Nomor -->
                    <div class="text-sm font-semibold text-gray-800">
                        <p>Ajuan Cuti ke :
                            {{ ($listPengajuan->currentPage() - 1) * $listPengajuan->perPage() + $loop->iteration }}
                        </p>
                    </div>
                        <!-- Nama Pegawai -->
                        <div class="text-sm text-gray-600">
                            Nama Pegawai: {{ $data->pegawai->nama }}
                        </div>
                        <!-- Unit Kerja -->
                        <div class="text-sm text-gray-600">
                            Unit Kerja: {{ $data->pegawai->unitKerja }}
                        </div>
                        <!-- Jabatan -->
                        <div class="text-sm text-gray-600">
                            Jabatan: {{ $data->pegawai->jabatan }}
                        </div>
                        <!-- Status -->
                        <div class="text-sm">
                            <span
                                class="
                            @if (strtolower($data->status_ajuan) == 'diproses') p-1 bg-yellow-200 text-yellow-700 uppercase font-bold text-wider rounded-xl
                            @elseif(strtolower($data->status_ajuan) == 'disetujui')
                                p-1 bg-green-200 text-green-700 uppercase font-bold text-wider rounded-xl
                            @elseif(strtolower($data->status_ajuan) == 'ditolak')
                                p-1 bg-red-200 text-red-700 uppercase font-bold text-wider rounded-xl
                            @else
                                p-1 bg-gray-200 text-gray-700 @endif
                            ">
                                {{ ucfirst($data->status_ajuan) }}
                            </span>
                        </div>
                        <!-- Detail Button -->
                        <div>
                            <button wire:navigate href="/penyetuju/penyetuju-detail/{{ $data->pengajuan->id }}"
                                class="px-2 text-sm font-semibold text-white transition-colors shadow rounded-xl bg-tertiary hover:bg-orange-300">
                                Detail
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-4 text-center text-gray-500">
                            Tidak ada data yang ditemukan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        <nav class="flex items-center py-3 gap-x-1" aria-label="Pagination">
            <!-- Previous Button -->
            <button type="button"
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none bg-primary text-white hover:bg-tertiary focus:bg-tertiary dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
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
                                class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-blue-500 hover:text-white py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-blue-600 disabled:opacity-50 disabled:pointer-events-none bg-primary text-white hover:bg-tertiary focus:bg-tertiary dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
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
                class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none bg-primary text-white hover:bg-tertiary focus:bg-tertiary dark:text-white dark:bg-primary dark:hover:bg-tertiary dark:focus:bg-tertiary"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('penyetuju.search-cuti') }}",
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
