<div class="flex flex-col items-center min-h-screen bg-white">
    <div class="w-full max-w-5xl mt-4 text-left">
        <h2 class="text-3xl font-bold text-gray-900">Data Pegawai</h2>
    </div>

    <div class="w-full max-w-5xl p-6 mt-6 shadow-xl bg-blue-50 rounded-xl" style="max-height: 700px; overflow-y: auto;">
        <div class="grid grid-cols-2 gap-4">
            <!-- Bagian Kiri -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-blue-900">🧑‍💼 Informasi Pegawai</h3>
                <div class="mb-4">
                    <label for="namaPegawai" class="block mb-2 font-medium text-gray-700 text-md">Nama Pegawai</label>
                    <input id="namaPegawai" type="text" class="w-full p-2 border border-gray-300 rounded-lg text-md"
                        wire:model="namaPegawai">
                    @error('namaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="NIP" class="block mb-2 font-medium text-gray-700 text-md">NIP</label>
                    <input id="NIP" type="text" class="w-full p-2 border border-gray-300 rounded-lg text-md"
                        wire:model="NIP">
                    @error('NIP')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="unitKerjaPegawai" class="block mb-2 font-medium text-gray-700 text-md">Unit
                        Kerja</label>
                    <input id="unitKerjaPegawai" type="text"
                        class="w-full p-2 border border-gray-300 rounded-lg text-md" wire:model="unitKerjaPegawai">
                    @error('unitKerjaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="jabatanPegawai" class="block mb-2 font-medium text-gray-700 text-md">Jabatan</label>
                    <input id="jabatanPegawai" type="text"
                        class="w-full p-2 border border-gray-300 rounded-lg text-md" wire:model="jabatanPegawai">
                    @error('jabatanPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="masaKerjaPegawai" class="block mb-2 font-medium text-gray-700 text-md">Masa
                        Kerja</label>
                    <input id="masaKerjaPegawai" type="number"
                        class="w-full p-2 border border-gray-300 rounded-lg text-md" wire:model="masaKerjaPegawai">
                    @error('masaKerjaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- Bagian Kanan -->
            <div>
                <h3 class="mb-4 text-lg font-semibold text-blue-900">📋 Data Cuti Pegawai</h3>
                @foreach ($jenisCutiFields as $index => $field)
                    <div class="flex space-x-4" wire:key="jenisCutiField-{{ $index }}">
                        <!-- Dropdown Jenis Cuti -->
                        <div class="w-1/2">
                            <label for="jenisCuti{{ $index }}" class="block text-sm font-medium text-gray-700">
                                Jenis Cuti:
                            </label>
                            <select wire:model="selectedJenisCuti.{{ $index }}" id="jenisCuti{{ $index }}"
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
                            <label for="sisaCuti{{ $index }}" class="block text-sm font-medium text-gray-700">
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
        </div>
    </div>

    <div class="flex justify-center gap-6 mt-6">
        <button type="button" wire:click="goBack"
            class="px-6 py-2 text-white bg-orange-500 rounded-lg hover:bg-orange-600">
            Kembali
        </button>
        <button type="button" wire:click="updatePegawai"
            class="px-6 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">
            Simpan
        </button>
        <button @click="confirmDelete(() => $wire.deletePegawai())"
            class="px-6 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
            Hapus Pegawai
        </button>
    </div>
</div>
<script>
    function confirmDelete(callback) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        });
    }

    Livewire.on('triggerRedirect', url => {
        setTimeout(() => {
            window.location.href = url;
        }, 3000); // Delay untuk menunggu notifikasi selesai
    });
</script>
