{{-- Header --}}
<div wire:poll.1s>
    <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
        Data Pegawai
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <!-- Form -->
    <div class="h-auto mx-auto overflow-y-hidden shadow w-max-full sm:rounded-md sm:overflow-hidden">
        <div class="px-8 py-8 bg-[#F4F7FE] space-y-8 sm:p-8">
            @if ($currentPage === 1)
                <!-- Form Data Pegawai -->
                <div class="space-y-4">
                    <!-- Nama Pegawai dan NIP -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="namaPegawai" class="block text-sm font-medium text-gray-700">Nama Pegawai:</label>
                            <input wire:model="namaPegawai" type="text" id="namaPegawai"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                        <div class="w-1/2">
                            <label for="NIP" class="block text-sm font-medium text-gray-700">NIP:</label>
                            <input wire:model="NIP" type="text" id="NIP"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                    </div>

                    <!-- Unit Kerja Pegawai dan Jabatan -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="unitKerjaPegawai" class="block text-sm font-medium text-gray-700">Unit
                                Kerja:</label>
                            <input wire:model="unitKerjaPegawai" type="text" id="unitKerjaPegawai"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                        <div class="w-1/2">
                            <label for="jabatanPegawai" class="block text-sm font-medium text-gray-700">Jabatan:</label>
                            <input wire:model="jabatanPegawai" type="text" id="jabatanPegawai"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                    </div>

                    <!-- Masa Kerja dan Tanggal Input Pegawai -->
                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <label for="masaKerjaPegawai" class="block text-sm font-medium text-gray-700">Masa
                                Kerja:</label>
                            <input wire:model="masaKerjaPegawai" type="text" id="masaKerjaPegawai"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                        <div class="w-1/2">
                            <label for="tanggalInputPegawai" class="block text-sm font-medium text-gray-700">Tanggal
                                Input:</label>
                            <input wire:model="tanggalInputPegawai" type="date" id="tanggalInputPegawai"
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                        </div>
                    </div>
                </div>

                <!-- Daftar Jenis Cuti -->
                <div>
                    @foreach ($jenisCutiFields as $index => $field)
                        <div class="flex space-x-4" wire:key="jenisCutiField-{{ $index }}">
                            <!-- Dropdown Jenis Cuti -->
                            <div class="w-1/2">
                                <label for="jenisCuti{{ $index }}"
                                    class="block text-sm font-medium text-gray-700">
                                    Jenis Cuti:
                                </label>
                                <select wire:model="selectedJenisCuti.{{ $index }}"
                                    id="jenisCuti{{ $index }}"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC] tracking-widest">
                                    <option value="" hidden selected>Pilih Jenis Cuti</option>
                                    @foreach ($jenisCuti as $jenis)
                                        <option value="{{ $jenis['id'] }}">{{ $jenis['jenis_cuti'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dropdown Tahun (Hanya untuk Cuti Tahunan) -->
                            @if (isset($selectedJenisCuti[$index]) && $selectedJenisCuti[$index] == 1)
                                <div class="w-1/2">
                                    <label for="tahunCuti{{ $index }}"
                                        class="block text-sm font-medium text-gray-700">
                                        Tahun Cuti:
                                    </label>
                                    <select wire:model="tahun.{{ $index }}" id="tahunCuti{{ $index }}"
                                        class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC] tracking-widest">
                                        <option value="" selected hidden>Pilih Tahun</option>
                                        @foreach ($jenisCuti[0]['tahun'] as $tahun)
                                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <!-- Input Sisa Cuti -->
                            <div class="w-1/2">
                                <label for="sisaCuti{{ $index }}"
                                    class="block text-sm font-medium text-gray-700">
                                    Sisa Cuti:
                                </label>
                                <input wire:model="sisaCuti.{{ $index }}" type="number"
                                    id="sisaCuti{{ $index }}"
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC]">
                            </div>
                        </div>
                    @endforeach

                    <!-- Tombol Tambah dan Hapus -->
                    <div class="flex justify-end mt-4 space-x-4">
                        <button type="button" wire:click="addJenisCuti"
                            class="px-4 py-2 text-white bg-tertiary rounded-3xl">
                            Tambah
                        </button>
                        @if (count($jenisCutiFields) > 1)
                            <button type="button" wire:click="removeJenisCuti"
                                class="px-4 py-2 text-white bg-red-500 rounded-3xl">
                                Hapus
                            </button>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Buttons -->
        <div class="px-4 py-2 bg-[#F4F7FE] flex justify-center sm:px-6 space-x-6">
            @if ($currentPage > 1)
                <button type="button" wire:click="goToPreviousPage"
                    class="py-2 text-white bg-tertiary px-7 rounded-2xl">Sebelumnya</button>
            @endif
            @if ($currentPage < count($pages))
                <button type="button" wire:click="goToNextPage"
                    class="px-6 py-2 text-white bg-tertiary rounded-2xl">Selanjutnya</button>
            @endif
            @if ($currentPage === count($pages))
                <!-- Cek jika sudah di halaman terakhir -->
                <button type="submit" wire:click="submitForm"
                    class="px-6 py-2 text-white bg-tertiary rounded-2xl">Submit</button>
            @endif
        </div>
    </div>
</div>
