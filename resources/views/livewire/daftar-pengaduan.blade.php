<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Daftar Pengaduan') }}
    </h2>
</x-slot>

<!-- Main Content -->
<div class="flex flex-col w-full">
    <!-- Title Section -->
    <div class="px-4 py-4">
        <h3 class="text-3xl font-bold tracking-wider text-black">Daftar Pengaduan</h3>
    </div>

    <!-- Statistik Pengaduan -->
    <div class="grid max-w-full grid-cols-3 gap-4 px-4 mb-6">
        <div class="py-4 text-center text-white bg-tertiary rounded-2xl">
            <div class="text-xl font-semibold">{{ $totalPengaduan }} Pengaduan</div>
        </div>
        <div class="py-4 text-center text-white bg-tertiary rounded-2xl">
            <div class="text-xl font-semibold">{{ $daftartungguCount }} Daftar Tunggu</div>
        </div>
        <div class="py-4 text-center text-white bg-tertiary rounded-2xl">
            <div class="text-xl font-semibold">{{ $ditanggapiCount }} Ditanggapi</div>
        </div>
    </div>

    <!-- Pencarian -->
    <div class="flex items-center px-4 mb-5">
        <input type="text" placeholder="Search ..." class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none"
        wire:model.debounce.300ms="search">
        <button class="px-4 py-2 text-white bg-yellow-500 rounded-r-md" wire:click="searchAction">
            🔍
        </button>
    </div>

    <!-- Daftar Pengaduan -->
    <div class="px-4">
        @forelse ($pengaduans->sortBy(fn($item) => $item->status_pengaduan !== 'daftarTunggu') as $pengaduan)
            <div class="flex items-center justify-between p-6 mb-2 bg-blue-100 rounded-md shadow-md">
            <div>
                    <div class="font-semibold">{{ $pengaduan->title }}</div>
                    <div class="text-sm text-gray-600">{{ $pengaduan->pegawai->nama }} -
                        {{ $pengaduan->pegawai->unitKerja }}
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ strlen($pengaduan->descriptions) > 25 ? substr($pengaduan->descriptions, 0, 25) . '...' : $pengaduan->descriptions }}
                    </div>
                </div>
                <div class="flex items-center gap-4 ml-auto mr-20">
                    <span class="p-2 rounded-xl text-sm font-bold uppercase
                        @if (strtolower($pengaduan->status_pengaduan) === 'daftartunggu') bg-gray-200 text-gray-700
                        @elseif(strtolower($pengaduan->status_pengaduan) === 'ditanggapi') mr-4 bg-green-200 text-green-700
                        @else bg-red-200 text-red-700 @endif">
                        {{ ucfirst($pengaduan->status_pengaduan) }}
                    </span>
                </div>
                <button type="button" 
                    wire:click="openModal({{ $pengaduan->id }})"
                    class="flex items-center justify-center w-12 h-12 font-bold text-gray-800 rounded-full bg-tertiary hover:bg-orange-300">
                    <!-- Your SVG icon -->
                    <svg fill="#08244B" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#08244B" class="w-6 h-6">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path
                                    d="M36,21c0-2.206-1.794-4-4-4s-4,1.794-4,4s1.794,4,4,4S36,23.206,36,21z M30,21c0-1.103,0.897-2,2-2s2,0.897,2,2 s-0.897,2-2,2S30,22.103,30,21z">
                                </path>
                                <path d="M27,41v6h10v-6h-2V27h-8v6h2v8H27z M29,31v-2h4v14h2v2h-6v-2h2V31H29z">
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
        @empty
            <div class="text-center text-gray-500">
                Tidak ada pengaduan yang ditemukan.
            </div>
        @endforelse
    </div>
    <!-- Modal -->
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75">
            <div class="bg-gray-100 p-2 rounded-xl border-2 border-[#0032CC] shadow-lg md:w-3/4 lg:w-2/3">
                <!-- Detail Pengaduan -->
                <div class="flex-1 p-4 overflow-y-auto" style="max-height: 400px;">
                    <div class="font-semibold text-xl">{{ $selectedPengaduan->pegawai->nama }}</div>
                    <div class="text-sm italic">{{ $selectedPengaduan->pegawai->jabatan }}</div>
                    <div class="text-sm">{{ $selectedPengaduan->pegawai->user->email }}</div>
                    <textarea class="w-full p-2 mt-2 border rounded-lg" rows="6"
                        disabled value="">{{ $selectedPengaduan->descriptions }}</textarea>
                    <div class="font-semibold text-xl">{{ $dataPegawai['nama'] }}</div>
                    <div class="text-sm italic">{{ $dataPegawai['jabatan'] }}</div>
                    <div class="text-sm">{{ $dataPegawai['email'] }}</div>
                    @if ($selectedPengaduan->status_pengaduan === 'ditanggapi')
                        <textarea type="text" id="tanggapan" wire:model="tanggapan"
                                class="w-full p-2 mt-2 border rounded-lg" rows="6"
                                placeholder="Tuliskan feedback anda disini...">{{ $selectedPengaduan->reply }}</textarea>
                    @else
                        <textarea type="text" id="tanggapan" wire:model="tanggapan"
                            class="w-full p-2 mt-2 border rounded-lg" rows="6"
                            placeholder="Tuliskan feedback anda disini..."></textarea>
                    @endif
                </div>
                <div class="flex justify-between gap-4 mt-4 px-8">
                        <button wire:click="closeModal"
                            class="px-4 py-2 text-white bg-red-500 rounded-xl bg-tertiary">Kembali</button>
                        <button wire:click="submitTanggapan"
                            class="px-4 py-2 text-white bg-blue-500 rounded-xl bg-tertiary">Kirim Feedback</button>
            </div>
        </div>
    @endif
</div>
