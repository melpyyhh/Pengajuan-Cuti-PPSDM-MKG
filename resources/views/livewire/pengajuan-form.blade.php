<div>
    <h1 class="py-2 font-bold text-3xl text-gray-800 tracking wider">
        Pengajuan
    </h1>
    <h2 class="py-2 font-semibold text-xl text-gray-800 leading-tight">
        {{ $pages[$currentPage]['heading'] }}
    </h2>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <!-- Form -->
    <div class="w-max-full mx-auto shadow sm:rounded-md sm:overflow-hidden h-auto">
        <div class="px-8 py-8 bg-[#F4F7FE] space-y-8 sm:p-8">
            @if ($currentPage === 1)
            <!-- Form Pilih Jenis Cuti -->
            <div>
                <label for="jenisCuti" class="block text-sm font-medium text-gray-700">Jenis Cuti yang diajukan:</label>
                <select wire:model="jenisCuti" id="jenisCuti"
                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC] tracking-widest">
                    <option value="tahunan">Cuti Tahunan</option>
                    <option value="sakit">Cuti Sakit</option>
                    <option value="lainnya">Cuti Lainnya</option>
                </select>
            </div>
            @elseif ($currentPage === 2)
            <!-- Form Isi Detail Formulir -->
            <div class="grid grid-cols-2 gap-8">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Cuti</label>
                        <textarea wire:model="alasan" id="alasan" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"></textarea>
                    </div>
                    <div>
                        <label for="alamatCuti" class="block text-sm font-medium text-gray-700">Alamat Selama Cuti</label>
                        <textarea wire:model="alamatCuti" id="alamatCuti" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label for="nomorHp" class="block text-sm font-medium text-gray-700">Nomor Handphone</label>
                        <input wire:model="nomorHp" type="text" id="nomorHp" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                    <div>
                        <label for="tanggalMulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input wire:model="tanggalMulai" type="date" id="tanggalMulai" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                    <div>
                        <label for="durasiCuti" class="block text-sm font-medium text-gray-700">Selama</label>
                        <input wire:model="durasiCuti" type="text" id="durasiCuti" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                </div>
            </div>
            @elseif ($currentPage === 3)
            <!-- Form Upload Dokumen -->
            <div class="mt-4">
                <label for="dokumen" class="block text-sm font-medium text-gray-700">Dokumen Pendukung</label>
                <input wire:model="dokumen" type="file" id="dokumen" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                @if ($dokumen)
                <p class="mt-2 text-sm text-gray-500">File yang dipilih: {{ $dokumen->getClientOriginalName() }}</p>
                @endif
            </div>
            @elseif ($currentPage === 4)
            <!-- Form Konfirmasi Pengajuan -->
            <!-- ini belum diatur get dari page 2 nya dit -->
            <div class="grid grid-cols-2 gap-8">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Cuti</label>
                        <textarea wire:model="alasan" id="alasan" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"></textarea>
                    </div>
                    <div>
                        <label for="alamatCuti" class="block text-sm font-medium text-gray-700">Alamat Selama Cuti</label>
                        <textarea wire:model="alamatCuti" id="alamatCuti" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"></textarea>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label for="nomorHp" class="block text-sm font-medium text-gray-700">Nomor Handphone</label>
                        <input wire:model="nomorHp" type="text" id="nomorHp" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                    <div>
                        <label for="tanggalMulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input wire:model="tanggalMulai" type="date" id="tanggalMulai" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                    <div>
                        <label for="durasiCuti" class="block text-sm font-medium text-gray-700">Selama</label>
                        <input wire:model="durasiCuti" type="text" id="durasiCuti" class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- Button -->
        <div class="px-4 py-3 bg-[#F4F7FE] flex justify-center sm:px-6 pt-20 space-x-6">
            @if ($currentPage > 1)
            <button type="button" wire:click="goToPreviousPage" class="bg-tertiary text-white py-2 px-7 rounded-2xl">Sebelumnya</button>
            @endif
            @if ($currentPage < count($pages))
                <button type="button" wire:click="goToNextPage" class="bg-tertiary text-white py-2 px-6 rounded-2xl">Selanjutnya</button>
                @endif
                @if ($currentPage === count($pages)) <!-- Cek jika sudah di halaman terakhir -->
                <button type="submit" class="bg-tertiary text-white py-2 px-6 rounded-2xl">Submit</button> <!-- Tombol Submit -->
                @endif
        </div>

    </div>
</div>