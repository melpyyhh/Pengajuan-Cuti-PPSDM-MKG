<div>
    <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
        Pengaduan
    </h1>

    <div class="p-6 bg-[#F4F7FE] shadow-md rounded-lg">
        <!-- Header Data Pegawai -->
        <div class="mb-6">
            <h1 class="mb-2 text-2xl font-bold tracking-wider text-gray-800">Data Pegawai</h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label for="namaPegawai" class="block text-sm font-medium text-gray-700">Nama :</label>
                    <input type="text" id="namaPegawai" disabled value="{{ $nama }}"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
                <div>
                    <!-- divisinya tar dibuat getdivisibyid yah bang, kan blm ada tuh di tabel -->
                    <label for="divisiPegawai" class="block text-sm font-medium text-gray-700">Divisi :</label>
                    {{-- ini divisinya masih dummy --}}
                    <input type="text" id="divisiPegawai" disabled value="IT Support"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
                <div>
                    <label for="gmailPegawai" class="block text-sm font-medium text-gray-700">Gmail :</label>
                    <input type="text" id="gmailPegawai" disabled value="{{ $email }}"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
            </div>
        </div>

        <!-- Form Pengaduan -->
        <form wire:submit.prevent="submitPengaduan">
            <div class="space-y-6">
                <div>
                    <label for="subjek" class="block mb-2 text-2xl font-bold text-gray-800">Subjek:</label>
                    <input type="text" id="subjek" wire:model="subjek"
                        class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                        placeholder="Masukkan subjek pengaduan">
                </div>
                <div>
                    <label for="isi" class="block mb-2 text-2xl font-bold text-gray-800">Isi Pengaduan:</label>
                    <textarea id="isi" wire:model="isi" rows="5"
                        class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                        placeholder="Jelaskan pengaduan Anda secara rinci"></textarea>
                </div>
            </div>

            <!-- Button-->
            <div class="flex justify-between mt-6">
                <button type="button" wire:click="goBack"
                    class="px-4 py-2 text-white transition-colors rounded-md shadow bg-tertiary hover:bg-orange-300">Kembali</button>
                    <!-- ini blm ada method submitnya bang -->
                <button type="submit"
                    class="px-4 py-2 text-white transition-colors rounded-md shadow bg-tertiary hover:bg-orange-300">Kirim Pengaduan</button>
            </div>
        </form>
    </div>
</div>
