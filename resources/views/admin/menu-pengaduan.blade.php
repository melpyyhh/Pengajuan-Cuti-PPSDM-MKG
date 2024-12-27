<x-app-layout>
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
                <div class="text-xl font-semibold">{{ $daftartungguCount }} Ditanggapi</div>
            </div>
            <div class="py-4 text-center text-white bg-tertiary rounded-2xl">
                <div class="text-xl font-semibold">{{ $ditanggapiCount }} Daftar Tunggu</div>
            </div>
        </div>

        <!-- Pencarian -->
        <div class="flex items-center px-4 mb-5">
            <input type="text" placeholder="Search ..."
                class="flex-1 px-4 py-2 border rounded-l-md focus:outline-none">
            <button class="px-4 py-2 text-white bg-yellow-500 rounded-r-md">
                🔍
            </button>
        </div>

        <!-- Daftar Pengaduan -->
        <div class="px-4">
            @foreach ($pengaduans as $pengaduan)
            <div class="flex justify-between p-6 mb-2 bg-blue-100 rounded-md shadow-md">
                <div>
                    <div class="font-semibold">{{ $pengaduan->descriptions }}</div>
                    <div class="text-sm text-gray-600">{{ $pengaduan->pegawai->nama }} -
                        {{ $pengaduan->pegawai->unitKerja }}
                    </div>
                    <div class="text-sm text-gray-600">Admin yang terhormat, ....</div>
                </div>
                <button class="px-2 py-1 font-bold leading-tight text-gray-800 transition-all rounded-xl hover:bg-tertiary hover:text-white">
                    Detail
                </button>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
