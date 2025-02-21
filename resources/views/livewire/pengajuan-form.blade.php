{{-- Header --}}
<div>
    <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
        Pengajuan
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <!-- Form -->
    <div class="h-auto mx-auto shadow w-max-full sm:rounded-md sm:overflow-hidden">
        <div class="px-8 py-8 bg-[#F4F7FE] space-y-8 sm:p-8">
            @if ($currentPage === 1)
                <!-- Form Pilih Jenis Cuti -->
                <div>
                    <label for="jenisCuti" class="block text-sm font-bold text-gray-700">Jenis Cuti yang
                        Diajukan:</label>
                    <select wire:model="jenisCutiTerpilih" id="jenisCuti"
                        class="mt-1 block w-full rounded-2xl border border-[#0032CC] focus:ring-[#0032CC] focus:border-[#0032CC] tracking-widest">
                        <option value="" hidden selected>Pilih Jenis Cuti</option>
                        @foreach ($jenisCutiList as $jenis)
                            <option value="{{ $jenis['id'] }}">{{ $jenis['jenis_cuti'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @elseif ($currentPage === 2)
                <!-- Form Isi Detail Formulir -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label for="alasan" class="block text-sm font-bold text-gray-700">Alasan Cuti</label>
                            <textarea wire:model="alasan" id="alasan" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"
                                placeholder="Isikan dengan keterangan alasan cuti anda"></textarea>
                            @error('alasan')
                                <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="alamatCuti" class="block text-sm font-bold text-gray-700">Alamat Selama
                                Cuti</label>
                            <textarea wire:model="alamatCuti" id="alamatCuti" rows="6"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]" placeholder="Isikan dengan alamat anda selama cuti"></textarea>
                            @error('alamatCuti')
                                <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label for="nomorHp" class="block text-sm font-bold text-gray-700">Nomor
                                Handphone</label>
                            <input wire:model="nomorHp" type="text" id="nomorHp"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]"
                                placeholder="Isikan dengan format 08xxxxxxxxxx">
                            @error('nomorHp')
                                <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggalMulai" class="block text-sm font-bold text-gray-700">Tanggal
                                Mulai</label>
                            <input wire:model="tanggalMulai" type="date" id="tanggalMulai"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                            @error('tanggalMulai')
                                <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="tanggalAkhir" class="block text-sm font-bold text-gray-700">Tanggal
                                Akhir</label>
                            <input wire:model="tanggalAkhir" type="date" id="tanggalAkhir"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                            @error('tanggalAkhir')
                                <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            @if ($sisaCuti && $sisaCuti->isNotEmpty())
                                @foreach ($sisaCuti as $cuti)
                                    <label for="sisaCuti_{{ $cuti['tahun'] }}"
                                        class="block text-sm font-bold text-gray-700">Sisa Cuti Tahun
                                        {{ $cuti['tahun'] }}
                                    </label>
                                    <input type="text" id="sisaCuti_{{ $cuti['tahun'] }}"
                                        value="{{ $cuti['sisa_cuti'] }}" readonly
                                        class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">Tidak ada data sisa cuti untuk jenis cuti ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @elseif ($currentPage === 3)
                <!-- Form Upload Dokumen -->
                <div class="mt-4">
                    <label for="dokumen" class="block text-sm font-bold text-gray-700">Dokumen Pendukung</label>

                    <!-- Hidden File Input -->
                    <input wire:model="dokumen" type="file" id="dokumen" x-ref="fileInput" class="hidden" />

                    <!-- Custom Label -->
                    <label for="dokumen"
                        class="mt-4 flex items-center justify-center px-4 py-2 border border-[#0032CC] rounded-xl text-[#0032CC] bg-white hover:bg-[#0032CC] hover:text-white cursor-pointer">
                        Pilih File
                    </label>
                    <div wire:loading wire:target="dokumen">
                        Mengupload...
                    </div>

                    @error('dokumen')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    @if ($dokumen)
                        <p class="mt-2 text-sm text-gray-500">File yang dipilih:
                            {{ $dokumen->getClientOriginalName() }}
                        </p>

                        <!-- Remove Button -->
                        <button type="button" class="mt-2 text-sm text-red-600 hover:text-red-800"
                            x-on:click="
                        $refs.fileInput.value = '';
                        @this.set('dokumen', null);  <!-- Update the Livewire model -->
                        ">
                            Batalkan Unggah Dokumen
                        </button>
                    @endif
                </div>
            @elseif ($currentPage === 4)
                <!-- Form Konfirmasi Pengajuan -->
                <div class="grid grid-cols-2 gap-8">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label for="alasan" class="block text-sm font-bold text-gray-700">Alasan Cuti</label>
                            <textarea wire:model="alasan" id="alasan" rows="6" class="mt-1 block w-full rounded-xl border border-[#0032CC]"
                                disabled></textarea>
                        </div>
                        <div>
                            <label for="alamatCuti" class="block text-sm font-bold text-gray-700">Alamat Selama
                                Cuti</label>
                            <textarea wire:model="alamatCuti" id="alamatCuti" rows="6"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]" disabled></textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label for="nomorHp" class="block text-sm font-bold text-gray-700">Nomor
                                Handphone</label>
                            <input wire:model="nomorHp" type="text" id="nomorHp"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]" disabled>
                        </div>
                        <div>
                            <label for="tanggalMulai" class="block text-sm font-bold text-gray-700">Tanggal
                                Mulai</label>
                            <input wire:model="tanggalMulai" type="date" id="tanggalMulai"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]" disabled>
                        </div>
                        <div>
                            <label for="tanggalAkhir" class="block text-sm font-bold text-gray-700">Tanggal
                                Akhir</label>
                            <input wire:model="tanggalAkhir" type="date" id="tanggalAkhir"
                                class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                        </div>
                        <div>
                            @if ($sisaCuti && $sisaCuti->isNotEmpty())
                                @foreach ($sisaCuti as $cuti)
                                    <label for="sisaCuti_{{ $cuti['tahun'] }}"
                                        class="block text-sm font-bold text-gray-700">Sisa Cuti Tahun
                                        {{ $cuti['tahun'] }}
                                    </label>
                                    <input type="text" id="sisaCuti_{{ $cuti['tahun'] }}"
                                        value="{{ $cuti['sisa_cuti'] }}" readonly
                                        class="mt-1 block w-full rounded-xl border border-[#0032CC]">
                                @endforeach
                            @else
                                <p class="text-sm text-gray-500">Tidak ada data sisa cuti untuk jenis cuti ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Button -->
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
                <!-- Tombol Submit -->
                <button type="submit" wire:click="submitForm"
                    class="px-4 py-2 text-white transition-colors shadow rounded-xl bg-tertiary hover:bg-orange-300">Submit</button>
            @endif
        </div>
    </div>
</div>
<script>
    window.Livewire.on('redirect-after-alert', (data) => {
        setTimeout(() => {
            window.location.href = data.url;
        }, data.delay);
    });
</script>
