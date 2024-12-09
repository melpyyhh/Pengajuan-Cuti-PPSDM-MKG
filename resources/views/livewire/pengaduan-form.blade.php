<div>
    <h1 class="py-2 font-bold text-4xl text-gray-800 tracking-widest">
        Pengaduan
    </h1>

    <div class="p-6 bg-[#F4F7FE] shadow-md rounded-lg">
        <!-- Header Data Pegawai -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2 tracking-wider">Data Pegawai</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <!-- tar tolong dibuatin getnamapegawaibyid yah bang -->
                    <label for="namaPegawai" class="block text-sm font-medium text-gray-700">Nama :</label>
                    <input type="text" id="namaPegawai" disabled value="John Doe"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
                <div>
                    <!-- divisinya juga tar dibuat getdivisibyid yah bang -->
                    <label for="divisiPegawai" class="block text-sm font-medium text-gray-700">Divisi :</label>
                    <input type="text" id="divisiPegawai" disabled value="IT Support"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
                <div>
                    <!-- ini juga bang gmailnya tolong di get -->
                    <label for="gmailPegawai" class="block text-sm font-medium text-gray-700">Gmail :</label>
                    <input type="text" id="gmailPegawai" disabled value="johndoe@gmail.com"
                        class="mt-1 block w-full rounded-md focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]">
                </div>
            </div>
        </div>

        <!-- Form Pengaduan -->
        <form wire:submit.prevent="submitPengaduan">
            <div class="space-y-6">
                <div>
                    <label for="subjek" class="block text-2xl font-bold text-gray-800 mb-2">Subjek:</label>
                    <input type="text" id="subjek" wire:model="subjek"
                        class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                        placeholder="Masukkan subjek pengaduan">
                </div>
                <div>
                    <label for="isi" class="block text-2xl font-bold text-gray-800 mb-2">Isi Pengaduan:</label>
                    <textarea id="isi" wire:model="isi" rows="5"
                        class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                        placeholder="Jelaskan pengaduan Anda secara rinci"></textarea>
                </div>
            </div>

            <!-- Button-->
            <div class="mt-6 flex justify-between">
                <button type="button" wire:click="goBack"
                    class="bg-tertiary text-white py-2 px-4 rounded-md shadow hover:bg-orange-300 transition-colors">Kembali</button>
                    <!-- ini blm ada method submitnya bang -->
                <button type="submit"
                    class="bg-tertiary text-white py-2 px-4 rounded-md shadow hover:bg-orange-300 transition-colors">Kirim Pengaduan</button>
            </div>
        </form>
    </div>
</div>
