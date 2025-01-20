<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use App\Models\DataCuti;
use App\Models\JenisCuti;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Detail Pegawai')]
class PegawaiDetail extends Component
{
    public $pegawaiId;
    public $namaPegawai;
    public $NIP;
    public $unitKerjaPegawai;
    public $jabatanPegawai;
    public $masaKerjaPegawai;
    public $tanggalInputPegawai;
    public $jenisCutiFields = [];
    public $selectedJenisCuti = [
        1 => 'Cuti Tahunan',
        2 => 'Cuti Sakit',
        3 => 'Cuti Bersalin',
        4 => 'Cuti Besar',
        5 => 'Cuti Alasan Penting',
        6 => 'Cuti di Luar Tanggunan Negara (CLTN)',
    ];
    public $sisaCuti = [];

    public function mount($pegawaiId)
    {
        $pegawai = Pegawai::find($pegawaiId);

        if ($pegawai) {
            $this->pegawaiId = $pegawaiId;
            $this->namaPegawai = $pegawai->nama;
            $this->NIP = $pegawai->nip;
            $this->unitKerjaPegawai = $pegawai->unitKerja;
            $this->jabatanPegawai = $pegawai->jabatan;
            $this->masaKerjaPegawai = $pegawai->masaKerja;
            $this->tanggalInputPegawai = $pegawai->created_at->format('Y-m-d');

            // Initialize data cuti
            $dataCuti = DataCuti::where('pegawais_id', $pegawaiId)->get();

            foreach ($dataCuti as $cuti) {
                if (isset($cuti->jenis_cuti_id) && isset($cuti->sisa_cuti)) {
                    $this->jenisCutiFields[$cuti->jenis_cuti_id] = $cuti->jenis_cuti_id;
                    $this->sisaCuti[$cuti->jenis_cuti_id] = $cuti->sisa_cuti;
                }
            }
        } else {
            Log::error("Data pegawai dengan ID {$pegawaiId} tidak ditemukan.");
            session()->flash('error', 'Data pegawai tidak ditemukan.');
            return redirect()->route('admin.daftar-pegawai');
        }

        // Normalize jenisCutiFields
        $this->normalizeJenisCutiFields();
    }

    public function normalizeJenisCutiFields()
    {
        // Fill missing indices (1 to 6) with null
        $this->jenisCutiFields = array_replace(array_fill(1, 6, null), $this->jenisCutiFields);
    }

    public function updatePegawai()
    {
        $this->validate([
            'namaPegawai' => 'required|string|max:255',
            'NIP' => 'required|string|max:20',
            'unitKerjaPegawai' => 'required|string|max:255',
            'jabatanPegawai' => 'required|string|max:255',
            'masaKerjaPegawai' => 'required|int|max:255',
            'tanggalInputPegawai' => 'required|date',
        ]);

        $pegawai = Pegawai::find($this->pegawaiId);
        if ($pegawai) {
            $pegawai->update([
                'nama' => $this->namaPegawai,
                'nip' => $this->NIP,
                'unitKerja' => $this->unitKerjaPegawai,
                'jabatan' => $this->jabatanPegawai,
                'masaKerja' => $this->masaKerjaPegawai,
                'tanggal_input' => $this->tanggalInputPegawai,
            ]);

            foreach ($this->jenisCutiFields as $index => $jenisCutiId) {
                if ($jenisCutiId && isset($this->sisaCuti[$index]) && is_numeric($this->sisaCuti[$index])) {
                    DataCuti::updateOrCreate(
                        [
                            'pegawais_id' => $this->pegawaiId,
                            'jenis_cuti_id' => $jenisCutiId,
                        ],
                        [
                            'sisa_cuti' => $this->sisaCuti[$index],
                        ]
                    );
                }
            }

            session()->flash('success', 'Data pegawai berhasil diperbarui!');
            return redirect()->to(request()->header('Referer'));
        } else {
            session()->flash('error', 'Data pegawai tidak ditemukan!');
        }
    }

    public function deletePegawai()
    {
        try {
            $pegawai = Pegawai::find($this->pegawaiId);
            if ($pegawai) {
                $pegawai->dataCuti()->delete();
                $pegawai->delete();

                session()->flash('success', 'Data pegawai berhasil dihapus!');
                return redirect()->route('admin.daftar-pegawai');
            } else {
                session()->flash('error', 'Data pegawai tidak ditemukan!');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus data pegawai.');
        }
    }
    public function goBack()
    {
        return redirect()->route('admin.daftar-pegawai');
    }

    public function render()
    {
        // Normalize fields before rendering
        $this->normalizeJenisCutiFields();

        return view('livewire.pegawai-detail');
    }
}
