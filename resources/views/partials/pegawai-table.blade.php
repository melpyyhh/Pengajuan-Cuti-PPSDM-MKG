<tbody>
    @foreach ($listPegawai as $data)
        <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
            <td class="px-10 py-10 text-center text-gray-800 text-s">{{ $loop->iteration }}</td>
            <td class="px-16 py-10 text-center text-gray-800 text-s">{{ $data->nama }}</td>
            <td class="px-10 py-10 text-center text-gray-800 text-s">{{ $data->nip }}</td>
            <td class="px-4 py-10 text-center text-gray-800 text-s">{{ $data->jabatan }}</td>
            <td class="px-4 py-10 text-center text-gray-800 text-s">{{ $data->unitKerja }}</td>
            <td class="px-10 py-10 text-center text-gray-800 text-s">
                <div class="flex items-center justify-center">
                    <a href="{{ route('admin.detail-pegawai', ['pegawaiId' => $data->id]) }}"
                        class="flex items-center justify-center w-12 h-12 text-white rounded-full bg-yellow-500 hover:bg-orange-300 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-6 h-6">
                            <path
                                d="M11 2a9 9 0 1 1-6.32 15.34l-4.05 4.05a1 1 0 0 1-1.41-1.41l4.05-4.05A9 9 0 0 1 11 2zm0 2a7 7 0 1 0 4.95 11.95A7 7 0 0 0 11 4zm-1 3h2v3h3v2h-3v3h-2v-3H7v-2h3V7z" />
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
