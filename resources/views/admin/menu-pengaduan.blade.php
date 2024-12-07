<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengaduan') }}
        </h2>
    </x-slot>

    <!-- Main Content -->
    <div class="flex flex-col w-full">
        <!-- Title Section -->
        <div class="px-4 py-4">
            <h3 class="text-3xl font-bold text-black">Riwayat Cuti</h3>
        </div>

        <!-- Statistik Pengaduan -->
        <div class="grid grid-cols-3 gap-4 mb-6 px-4 max-w-full">
            <div class="bg-tertiary text-white text-center py-4 rounded-md">
                <div class="text-xl font-semibold">{{ $totalPengaduan }} Pengaduan</div>
            </div>
            <div class="bg-tertiary text-white text-center py-4 rounded-md">
                <div class="text-xl font-semibold">{{ $daftartungguCount }} Ditanggapi</div>
            </div>
            <div class="bg-tertiary text-white text-center py-4 rounded-md">
                <div class="text-xl font-semibold">{{ $ditanggapiCount }} Daftar Tunggu</div>
            </div>
        </div>

        <!-- Pencarian -->
        <div class="flex items-center mb-4 px-4">
            <input type="text" placeholder="Search ..."
                class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none">
            <button class="bg-yellow-500 text-white px-4 py-2 rounded-r-md">
                🔍
            </button>
        </div>

        <!-- Daftar Pengaduan -->
        <div class="px-4">
            @foreach ($pengaduans as $pengaduan)
                <div class="bg-blue-100 p-6 mb-2 rounded-md shadow-md flex justify-between">
                    <div>
                        <div class="font-semibold">{{ $pengaduan->descriptions }}</div>
                        <div class="text-sm text-gray-600">{{ $pengaduan->pegawai->nama }} -
                            {{ $pengaduan->pegawai->unitKerja }}</div>
                        <div class="text-sm text-gray-600">Admin yang terhormat, ....</div>
                    </div>
                    <button class="text-yellow-500 font-bold">Detail</button>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
