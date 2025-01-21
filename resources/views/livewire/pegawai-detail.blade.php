<div class="bg-white min-h-screen flex flex-col items-center">
    <div class="text-left w-full max-w-5xl mt-4">
        <h2 class="text-3xl font-bold text-gray-900">Data Pegawai</h2>
    </div>

    <div class="bg-blue-50 p-6 rounded-xl shadow-xl max-w-5xl w-full mt-6" style="max-height: 700px; overflow-y: auto;">
        <div class="grid grid-cols-2 gap-8">
            <!-- Bagian Kiri -->
            <div>
                <h3 class="text-lg font-semibold text-blue-900 mb-4">🧑‍💼 Informasi Pegawai</h3>
                <div class="mb-4">
                    <label for="namaPegawai" class="block text-md text-gray-700 font-medium mb-2">Nama Pegawai</label>
                    <input id="namaPegawai" type="text" class="w-full border border-gray-300 rounded-lg p-2 text-md"
                        wire:model="namaPegawai">
                    @error('namaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="NIP" class="block text-md text-gray-700 font-medium mb-2">NIP</label>
                    <input id="NIP" type="text" class="w-full border border-gray-300 rounded-lg p-2 text-md"
                        wire:model="NIP">
                    @error('NIP')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="unitKerjaPegawai" class="block text-md text-gray-700 font-medium mb-2">Unit
                        Kerja</label>
                    <input id="unitKerjaPegawai" type="text"
                        class="w-full border border-gray-300 rounded-lg p-2 text-md" wire:model="unitKerjaPegawai">
                    @error('unitKerjaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="jabatanPegawai" class="block text-md text-gray-700 font-medium mb-2">Jabatan</label>
                    <input id="jabatanPegawai" type="text"
                        class="w-full border border-gray-300 rounded-lg p-2 text-md" wire:model="jabatanPegawai">
                    @error('jabatanPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="masaKerjaPegawai" class="block text-md text-gray-700 font-medium mb-2">Masa
                        Kerja</label>
                    <input id="masaKerjaPegawai" type="number"
                        class="w-full border border-gray-300 rounded-lg p-2 text-md" wire:model="masaKerjaPegawai">
                    @error('masaKerjaPegawai')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- <!-- Daftar Jenis Cuti -->
            <div>
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
            @endif
        </div> --}}
            <!-- Bagian Kanan -->
            <div>
                <h3 class="text-lg font-semibold text-blue-900 mb-4">📋 Data Cuti Pegawai</h3>
                @if (!empty($jenisCutiFields))
                    @foreach ($jenisCutiFields as $fieldIndex)
                        @if (!is_null($fieldIndex) && $fieldIndex !== 0)
                            <div class="mb-4">
                                <label for="jenisCuti-{{ $fieldIndex }}"
                                    class="block text-md text-gray-700 font-medium mb-2">
                                    Jenis Cuti
                                </label>
                                <select id="jenisCuti-{{ $fieldIndex }}"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-md"
                                    wire:model="jenisCutiFields.{{ $fieldIndex }}">
                                    <option value="">Pilih Jenis Cuti</option>
                                    @foreach ($selectedJenisCuti as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('jenisCutiFields.' . $fieldIndex)
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="sisaCuti-{{ $fieldIndex }}"
                                    class="block text-md text-gray-700 font-medium mb-2">
                                    Sisa Cuti
                                </label>
                                <input id="sisaCuti-{{ $fieldIndex }}" type="number"
                                    class="w-full border border-gray-300 rounded-lg p-2 text-md"
                                    wire:model="sisaCuti.{{ $fieldIndex }}" min="0">
                                @error('sisaCuti.' . $fieldIndex)
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-gray-600">Tidak ada data cuti untuk ditampilkan.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="flex justify-center gap-6 mt-6">
        <button type="button" wire:click="goBack"
            class="bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600">
            Kembali
        </button>
        <button type="button" wire:click="updatePegawai"
            class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
            Simpan
        </button>
        <button @click="confirmDelete(() => $wire.deletePegawai())"
            class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
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
