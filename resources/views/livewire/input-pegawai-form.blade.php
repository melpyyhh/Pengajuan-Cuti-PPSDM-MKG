{{-- Header --}}
<div wire:poll.1s>
    <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
        Data Pegawai
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <!-- Form -->
    <div class="h-auto mx-auto overflow-y-hidden shadow w-max-full sm:rounded-md sm:overflow-hidden">
        <!-- Form -->
        <div class="h-auto mx-auto overflow-y-hidden shadow w-max-full sm:rounded-md sm:overflow-hidden">
            <div class="px-8 py-8 bg-[#F4F7FE] space-y-8 sm:p-8">
                @if ($currentPage === 1)
                    <!-- Form Data Pegawai -->
                    <div class="space-y-4">
                        <!-- Nama Pegawai dan NIP -->
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="namaPegawai" class="block text-sm font-medium text-gray-700">Nama
                                    Pegawai:</label>
                                <input wire:model="namaPegawai" type="text" id="namaPegawai"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                @error('namaPegawai')
                                    <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="NIP" class="block text-sm font-medium text-gray-700">NIP:</label>
                                <input wire:model="NIP" type="text" id="NIP"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                @error('NIP')
                                    <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Unit Kerja Pegawai dan Jabatan -->
                        <div class="flex space-x-4">
                            <div class="w-1/2">
                                <label for="unitKerjaPegawai" class="block text-sm font-medium text-gray-700">Unit
                                    Kerja:</label>
                                <input wire:model="unitKerjaPegawai" type="text" id="unitKerjaPegawai"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                @error('unitKerjaPegawai')
                                    <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-1/2">
                                <label for="jabatanPegawai"
                                    class="block text-sm font-medium text-gray-700">Jabatan:</label>
                                <input wire:model="jabatanPegawai" type="text" id="jabatanPegawai"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                @error('jabatanPegawai')
                                    <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Masa Kerja dan Tanggal Input Pegawai -->
                        <div class="flex space-x-4">
                            <div class="w-full">
                                <label for="masaKerjaPegawai" class="block text-sm font-medium text-gray-700">Masa
                                    Kerja:</label>
                                <input wire:model="masaKerjaPegawai" type="number" id="masaKerjaPegawai"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                @error('masaKerjaPegawai')
                                    <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                        {{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Jenis Cuti -->
                    <div>
                        <div>
                            {{-- Cuti Tahunan (3 Form) --}}
                            @foreach ($tahun as $index => $tahunValue)
                                <div class="flex space-x-4" wire:key="cutiTahunan-{{ $tahunValue }}">
                                    <!-- Dropdown Jenis Cuti -->
                                    <div class="w-1/2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Jenis Cuti:
                                        </label>
                                        <input type="text" value="Cuti Tahunan" readonly
                                            class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                                    </div>

                                    <!-- Tahun Cuti (Otomatis) -->
                                    <div class="w-1/2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Tahun Cuti:
                                        </label>
                                        <input type="text" value="{{ $tahunValue }}" readonly
                                            class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                                    </div>

                                    <!-- Input Sisa Cuti -->
                                    <div class="w-1/2">
                                        <label class="block text-sm font-medium text-gray-700">
                                            Sisa Cuti:
                                        </label>
                                        <input wire:model="sisaCuti.{{ $tahunValue }}" type="number"
                                            class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Cuti Besar --}}
                        <div class="flex mt-2 space-x-4" wire:key="cutiBesar">
                            <!-- Dropdown Jenis Cuti -->
                            <div class="w-1/2">
                                <label for="jenisCutiBesar" class="block text-sm font-medium text-gray-700">
                                    Jenis Cuti:
                                </label>
                                <input type="text" value="Cuti Besar" readonly
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                            </div>

                            <!-- Input Sisa Cuti Besar -->
                            <div class="w-1/2">
                                <label for="sisaCutiBesar" class="block text-sm font-medium text-gray-700">
                                    Sisa Cuti:
                                </label>
                                <input wire:model="sisaCuti.cutiBesar" type="number" id="sisaCutiBesar"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                            </div>
                        </div>
                    </div>
                @elseif ($currentPage === 2)
                    <!-- Form Input Email Akun Pengguna -->
                    <div class="space-y-4">
                        <div class="w-full">
                            <label for="emailPengguna" class="block text-sm font-medium text-gray-700">
                                Email Akun Pengguna:
                            </label>
                            <input wire:model="email" type="email" id="emailPengguna"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]"
                                placeholder="Masukkan email pengguna">
                        </div>

                        <div class="w-full">
                            <label for="konfirmasiEmail" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Email:
                            </label>
                            <input wire:model="email_confirmation" type="email" id="konfirmasiEmailPengguna"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]"
                                placeholder="Masukkan ulang email pengguna">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Buttons -->
    <div class="px-4 py-2 bg-[#F4F7FE] flex justify-center sm:px-6 space-x-6">
        @if ($currentPage > 1)
            <button type="button" wire:click="goToPreviousPage"
                class="px-4 py-2 text-white transition-colors shadow rounded-xl bg-tertiary hover:bg-orange-300">Sebelumnya</button>
        @endif
        @if ($currentPage < count($pages))
            <button type="button" wire:click="goToNextPage"
                class="px-4 py-2 text-white transition-colors shadow rounded-xl bg-tertiary hover:bg-orange-300">Selanjutnya</button>
        @endif
        @if ($currentPage === count($pages))
            <!-- Cek jika sudah di halaman terakhir -->
            <button type="submit" wire:click="submitForm"
                class="px-6 py-2 text-white bg-tertiary rounded-2xl">Submit</button>
        @endif
    </div>
</div>


<script>
    window.Livewire.on('redirect-after-alert', (data) => {
        setTimeout(() => {
            window.location.href = data.url;
        }, data.delay);
    });
</script>
