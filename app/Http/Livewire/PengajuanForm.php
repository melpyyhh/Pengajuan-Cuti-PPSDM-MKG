<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PengajuanForm extends Component
{
    public $currentPage = 1;
    public $success;

    // Properti form
    public $jenisCuti;
    public $tanggalMulai;
    public $tanggalSelesai;
    public $keterangan;
    public $dokumen;

    public $pages = [
        1 => ['heading' => 'Jenis Cuti', 'subheading' => 'Pilih jenis cuti.'],
        2 => ['heading' => 'Tanggal Cuti', 'subheading' => 'Masukkan tanggal mulai dan selesai cuti.'],
        3 => ['heading' => 'Unggah Dokumen', 'subheading' => 'Unggah informasi tambahan melalui dokumen (jika ada).'],
        4 => ['heading' => 'Crosscheck', 'subheading' => 'Periksa kembali form pengajuan cuti anda.'],
    ];

    // inin validasinya baru ngetes doang bang, nanti tambahin lagi ajaa
    protected $validationRules = [
        1 => ['jenisCuti' => 'required|in:tahunan,sakit,lainnya'],
        2 => [
            'tanggalMulai' => 'required|date|before_or_equal:tanggalSelesai',
        ],
        3 => ['keterangan' => 'required|string|max:255'],
    ];

    public function goToNextPage()
    {
        // $this->validate($this->validationRules[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    // Atur lagi aja bang ini submit"annya, ini cuman sementara karena viewnya gabisa dinext kalo gaada submit
    public function submitForm()
    {
        // Validasi akhir
        $this->validate(array_merge(...array_values($this->validationRules)));

        // Logika pengajuan cuti
        // Contoh: Simpan ke database atau proses lainnya
        $this->success = 'Pengajuan cuti berhasil dikirim!';
        $this->reset(['jenisCuti', 'tanggalMulai', 'tanggalSelesai', 'keterangan', 'currentPage']);
    }

    public function resetSuccess()
    {
        $this->success = null;
    }

    public function render()
    {
        return view('livewire.pengajuan-form');
    }
}
