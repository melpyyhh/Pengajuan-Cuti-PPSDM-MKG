<?php

namespace App\Http\Livewire;

use App\Mail\AccountPassword;
use App\Models\DataCuti;
use App\Models\JenisCuti;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

#[Title('Input Pegawai Form')]
class InputPegawaiForm extends Component
{
    public $currentPage = 1;

    // Properti form
    public $namaPegawai;
    public $NIP;
    public $unitKerjaPegawai;
    public $jabatanPegawai;
    public $masaKerjaPegawai;
    public $tanggalInputPegawai;
    public $jenisCuti = [];
    public $sisaCuti = [];
    public $jenisCutiFields = [0]; // Mengelola input
    public $tahun = [];
    public $atasanId;
    public $atasan = [];
    public $email;
    public $email_confirmation;

    public $pages = [
        1 => ['heading' => 'Data Pegawai', 'subheading' => 'Isikan Data Pegawai'],
        2 => ['heading' => 'Email Pegawai', 'subheading' => 'Isikan Email Pegawai'],
    ];

    public function goToPreviousPage()
    {
        // Pastikan tidak keluar dari halaman pertama
        if ($this->currentPage > 1) {
            $this->currentPage--;

            // Muat ulang data yang telah diisi
            if ($this->currentPage === 1) {
                $this->loadFormData();
            }
        }
    }

    public function goToNextPage()
    {
        // Validasi halaman saat ini sebelum lanjut ke halaman berikutnya
        if (isset($this->validationRules[$this->currentPage])) {
            $this->validate($this->validationRules[$this->currentPage]);
        }

        // Pindah ke halaman berikutnya jika masih dalam range
        if ($this->currentPage < count($this->pages)) {
            $this->currentPage++;
        }
    }


    public function loadFormData()
    {
        // Simulasi pengisian ulang data pegawai dari session atau state sebelumnya
        $this->namaPegawai = session('namaPegawai', $this->namaPegawai);
        $this->NIP = session('NIP', $this->NIP);
        $this->unitKerjaPegawai = session('unitKerjaPegawai', $this->unitKerjaPegawai);
        $this->jabatanPegawai = session('jabatanPegawai', $this->jabatanPegawai);
        $this->masaKerjaPegawai = session('masaKerjaPegawai', $this->masaKerjaPegawai);
        $this->sisaCuti = session('sisaCuti', $this->sisaCuti);
    }

    protected $validationRules =
    [
        1 => [
            'namaPegawai' => 'required|string',
            'NIP' => 'required|string',
            'unitKerjaPegawai' => 'required|string',
            'masaKerjaPegawai' => 'required|integer|min:0',
            'jabatanPegawai' => 'required|string',
            'sisaCuti.*' => 'required|integer|min:0',
            'tahun.*' => 'nullable|integer',
        ],
        2 => [
            'email' => 'required|email|confirmed',
        ]
    ];

    protected $messages = [
        'namaPegawai.required' => 'Nama pegawai wajib diisi!',
        'namaPegawai.string' => 'Nama pegawai harus berupa teks!',
        'NIP.required' => 'NIP wajib diisi!',
        'NIP.string' => 'NIP harus berupa teks!',
        'email.required' => 'Email wajib diisi!',
        'email.email' => 'Format email tidak valid!',
        'email.confirmed' => 'Konfirmasi email tidak sesuai dengan email yang dimasukkan!',
        'unitKerjaPegawai.required' => 'Unit kerja pegawai wajib diisi!',
        'unitKerjaPegawai.string' => 'Unit kerja pegawai harus berupa teks!',
        'masaKerjaPegawai.required' => 'Masa kerja pegawai wajib diisi!',
        'masaKerjaPegawai.integer' => 'Masa kerja pegawai harus berupa angka!',
        'masaKerjaPegawai.min' => 'Masa kerja pegawai tidak boleh kurang dari 0 tahun!',
        'jabatanPegawai.required' => 'Jabatan pegawai wajib diisi!',
        'jabatanPegawai.string' => 'Jabatan pegawai harus berupa teks!',
        'sisaCuti.*.required' => 'Sisa cuti wajib diisi!',
        'sisaCuti.*.integer' => 'Sisa cuti harus berupa angka!',
        'sisaCuti.*.min' => 'Sisa cuti tidak boleh kurang dari 0!',
        'tahun.*.nullable' => 'Tahun boleh dikosongkan.',
        'tahun.*.integer' => 'Tahun harus berupa angka!'
    ];


    public function submitForm()
    {
        DB::beginTransaction();
        try {
            $this->sisaCuti = is_array($this->sisaCuti) ? array_map('intval', $this->sisaCuti) : [];
            $this->tahun = is_array($this->tahun) ? array_map('intval', $this->tahun) : [];
            $masaKerjaPegawai = intval(trim($this->masaKerjaPegawai));
            foreach ($this->tahun as $index => $tahun) {
                if ($index === 0) {
                    // Tahun saat ini, boleh sampai 12 hari
                    $this->validationRules[1]['sisaCuti.' . $tahun] = 'nullable|numeric|max:12';
                } else {
                    // Tahun sebelumnya, maksimal 6 hari
                    $this->validationRules[1]['sisaCuti.' . $tahun] = 'nullable|numeric|max:6';
                }
            }
            // Validasi untuk cuti besar
            $this->validationRules[1]['sisaCuti.cutiBesar'] = 'nullable|numeric|max:90';

            // Validasi akhir
            $this->validate(array_merge(...array_values($this->validationRules)));
            // Simpan data pegawai
            $pegawaiBaru = Pegawai::tambahPegawai([
                'nama' => $this->namaPegawai,
                'nip' => $this->NIP,
                'jabatan' => $this->jabatanPegawai,
                'unitKerja' => $this->unitKerjaPegawai,
                'masaKerja' => $masaKerjaPegawai,
            ]);
            // Simpan data cuti
            $pegawaiId = $pegawaiBaru->id;
            foreach ($this->tahun as $tahunValue) {
                DataCuti::tambahDataCuti([
                    'pegawai_id' => $pegawaiId,
                    'jenis_cuti_id' => 1, // Sesuaikan dengan ID Cuti Tahunan di database
                    'jumlah_cuti' => $this->sisaCuti[$tahunValue] ?? 0, // Ambil sesuai tahun
                    'sisa_cuti' => $this->sisaCuti[$tahunValue] ?? 0, // Ambil sesuai tahun
                    'tahun' => $tahunValue
                ]);
            }

            // Simpan Cuti Besar jika ada
            if (!empty($this->sisaCuti['cutiBesar'])) {
                DataCuti::tambahDataCuti([
                    'pegawai_id' => $pegawaiId,
                    'jenis_cuti_id' => 4, // ID untuk Cuti Besar
                    'jumlah_cuti' => $this->sisaCuti['cutiBesar'],
                    'sisa_cuti' => $this->sisaCuti['cutiBesar'],
                    'tahun' => date('Y') // Tahun saat ini untuk Cuti Besar
                ]);
            }
            $password = Str::random(10);
            $hashed = Hash::make($password);
            $user = User::tambahUser([
                'pegawai_id' => $pegawaiId,
                'email' => $this->email,
                'name' => $this->namaPegawai,
                'password' => $hashed,
                'role' => 'pengaju',
                'atasan_id' => $this->atasanId
            ]);
            Mail::to($user->email)->later(now()->addMinute(), new AccountPassword($user->nama, $user->email, $password));
            DB::commit();
            // Notifikasi sukses
            $this->dispatch(
                'custom-alert',
                type: 'success',
                title: 'Tambah Pegawai Berhasil',
                position: 'center',
                timer: 3000
            );
            // Reset form setelah sukses submit
            $this->reset([
                'namaPegawai',
                'NIP',
                'jabatanPegawai',
                'unitKerjaPegawai',
                'masaKerjaPegawai',
                'jenisCuti',
                'sisaCuti',
                'email',
                'email_confirmation',
                'currentPage',
            ]);
            $this->dispatch('redirect-after-alert', [
                'url' => request()->header('Referer'),
                'delay' => 3000, // Waktu tunggu sebelum redirect (ms)
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->dispatch(
                'custom-alert',
                type: 'error',
                title: 'Terjadi kesalahan saat menambahkan pegawai',
                position: 'center',
                timer: 3000
            );
        }
    }

    public function render()
    {
        return view('livewire.input-pegawai-form');
    }

    public function mount()
    {
        $this->jenisCuti = [
            [
                'id' => '1',
                'jenis_cuti' => "Cuti Tahunan",
            ],
            [
                'id' => '4',
                'jenis_cuti' => "Cuti Besar",
            ]
        ];
        $currentYear = now()->year;
        // Tahun cuti tahunan otomatis 3 tahun terakhir
        $this->tahun = [
            $currentYear,
            $currentYear - 1,
            $currentYear - 2
        ];
        // Inisialisasi sisa cuti untuk tiap tahun dengan nilai default (misal 0)
        foreach ($this->tahun as $tahun) {
            $this->sisaCuti[$tahun] = 0;
        }
        // Tambahkan untuk cuti besar
        $this->sisaCuti['cutiBesar'] = 0;

        $penyetuju = User::where('role', 'penyetuju')->get()->first();
        $dual_role = User::where('role', 'dual_role')->get()->first();

        $this->atasan = [
            [
                'id' => $penyetuju->pegawai_id,
                'nama' => $penyetuju->name,
            ],
            [
                'id' => $dual_role->pegawai_id,
                'nama' => $dual_role->name
            ]
        ];
    }
}
