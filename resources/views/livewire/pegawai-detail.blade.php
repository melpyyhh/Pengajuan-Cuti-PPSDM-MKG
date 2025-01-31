<div>
    <div class="flex flex-col items-center min-h-screen bg-white">
        <div class="w-full max-w-5xl mt-4 text-left">
            <h2 class="text-3xl font-bold text-gray-900">Data Pegawai</h2>
        </div>

        <div class="w-full max-w-5xl p-6 mt-6 shadow-xl bg-blue-50 rounded-xl" style="max-height: 700px; overflow-y: auto;">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <!-- Bagian Kiri: Informasi Pegawai -->
                <div class="col-span-1">
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

                <!-- Bagian Kanan: Data Cuti Pegawai -->
                <div class="col-span-1">
                    <h3 class="mb-4 text-lg font-semibold text-blue-900">📋 Data Cuti Pegawai</h3>
                    @foreach ($tahun as $tahunValue)
                        <div class="flex space-x-4" wire:key="cutiTahunan-{{ $tahunValue }}">
                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-700">Jenis Cuti:</label>
                                <input type="text" value="Cuti Tahunan" readonly
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                            </div>

                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-700">Tahun Cuti:</label>
                                <input type="text" value="{{ $tahunValue }}" readonly
                                    class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                            </div>

                            <div class="w-1/2">
                                <label class="block text-sm font-medium text-gray-700">Sisa Cuti:</label>
                                <input
                                    wire:model="sisaCuti.{{ $tahunValue }}"
                                    type="number"
                                    class="mt-1 block w-full rounded-2xl border {{ $errors->has('sisaCuti.'.$tahunValue) ? 'border-red-500' : 'border-[#0032CC]' }} focus:ring-[#0032CC] focus:border-[#0032CC]">
                            </div>
                            @error('sisaCuti.'.$tahunValue)
                            <p class="px-2 mt-2 text-sm text-red-600 bg-red-200 border border-red-600 rounded-xl">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    {{-- Cuti Besar --}}
                    <div class="flex mt-2 space-x-4" wire:key="cutiBesar">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Jenis Cuti:</label>
                            <input type="text" value="Cuti Besar" readonly
                                class="mt-1 block w-full rounded-2xl border border-[#0032CC] bg-gray-200 tracking-widest">
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Sisa Cuti:</label>
                            <input wire:model="sisaCuti.cutiBesar" type="number"
                                class="mt-1 block w-full rounded-2xl border {{ $errors->has('sisaCuti.cutiBesar') ? 'border-red-500' : 'border-[#0032CC]' }} focus:ring-[#0032CC] focus:border-[#0032CC]">
                            @error('sisaCuti.cutiBesar')
                                <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div>
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
        </div>
    </div>
</div>
