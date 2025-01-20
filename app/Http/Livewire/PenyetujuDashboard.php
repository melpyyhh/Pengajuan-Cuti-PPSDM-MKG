<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\RiwayatCuti;
use Carbon\carbon;

use Livewire\Attributes\Title;

#[Title('Dashboard')]
class PenyetujuDashboard extends Component
{
    public $barChartData = [];
    public $cutiData;
    public $cutiDataDisetujui;

    public $lineChartData = [];
    public $thisYear;
    public $pieChartData = [];
    public $polarChartData = [];

    public $cutiPerPegawai = [];

    public function mount()
    {
        $this->cutiDataDisetujui = RiwayatCuti::select(
            DB::raw('COUNT(riwayat_cutis.id) as total')
        )
            ->where('riwayat_cutis.status_ajuan', 'disetujui')
            ->get();

        // BarChart
        // Ambil data riwayat cuti dengan join ke jenis_cuti dan pegawais
        $this->cutiData = RiwayatCuti::select(
            'jenis_cuti.jenis_cuti as jenis_cuti',
            'pegawais.unitKerja as unitKerja',
            DB::raw('COUNT(riwayat_cutis.id) as total')
        )
            ->join('jenis_cuti', 'riwayat_cutis.cuti_id', '=', 'jenis_cuti.id')
            ->join('pegawais', 'riwayat_cutis.pegawai_id', '=', 'pegawais.id')
            ->where('riwayat_cutis.status_ajuan', 'diproses')
            ->groupBy('jenis_cuti.jenis_cuti', 'pegawais.unitKerja')
            ->get();

        // Mengelompokkan data berdasarkan jenis cuti
        $groupedData = [];
        $unitKerjaList = [];
        foreach ($this->cutiData as $item) {
            $groupedData[$item->jenis_cuti][$item->unitKerja] = $item->total;
            if (!in_array($item->unitKerja, $unitKerjaList)) {
                $unitKerjaList[] = $item->unitKerja;
            }
        }

        // Membentuk struktur dataset buat label dan data untuk Chart.js
        $data = [
            'labels' => array_keys($groupedData),
            'datasets' => []
        ];

        foreach ($unitKerjaList as $unitKerja) {
            $dataset = [
                'label' => $unitKerja,
                'data' => [],
                'backgroundColor' => $this->generateColor($unitKerja),
                'borderWidth' => 2,
                'borderRadius' => 15,

            ];

            foreach ($data['labels'] as $jenisCuti) {
                $dataset['data'][] = $groupedData[$jenisCuti][$unitKerja] ?? 0;
            }

            $data['datasets'][] = $dataset;
        }

        $this->barChartData = json_encode($data);

        // LineChart
        $fiveYearsAgo = now()->subYears(4)->startOfYear(); // Lima tahun terakhir termasuk tahun ini
        $currentYear = now()->year;

        // Dataset 1: Total cuti per bulan di tahun berjalan
        /* $monthlyData = RiwayatCuti::select(
            DB::raw("DATE_FORMAT(tanggal_awal, '%Y-%m') as month"),
            DB::raw('COUNT(id) as total')
        )
            ->whereYear('tanggal_awal', $currentYear)
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();*/

        // Dataset 2: Total cuti per tahun dalam lima tahun terakhir
        $yearlyData = RiwayatCuti::select(
            DB::raw("YEAR(tanggal_awal) as year"),
            DB::raw('COUNT(id) as total')
        )
            ->where('tanggal_awal', '>=', $fiveYearsAgo)
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get();

        // Format data untuk Line Chart
        $lineChart = [
            'labels' => $yearlyData->pluck('year'), // Label bulan dalam tahun berjalan
            'datasets' => [
                [
                    'label' => "Tahun ($currentYear)",
                    'data' => $yearlyData->pluck('total'), // Total cuti per bulan
                    'borderColor' => 'rgba(8, 36, 75, 1)',
                    'backgroundColor' => 'rgba(8, 36, 75, 0.25)',
                    'fill' => true,
                ]
            ]
        ];

        // Kirimkan data ke view
        $this->lineChartData = json_encode($lineChart);


        // Pie Chart
        // Data untuk Pie Chart (proporsi jenis cuti)
        $totalData = RiwayatCuti::count(); // Total semua data

        $pieChartData = RiwayatCuti::select(
            'jenis_cuti.jenis_cuti as jenis_cuti',
            DB::raw('COUNT(riwayat_cutis.id) as total'),
            DB::raw('ROUND((COUNT(riwayat_cutis.id) / ' . $totalData . ' * 100), 2) as percentage')
        )
            ->join('jenis_cuti', 'riwayat_cutis.cuti_id', '=', 'jenis_cuti.id')
            ->groupBy('jenis_cuti.jenis_cuti')
            ->get();


        // Format data Pie Chart
        $pieChart = [
            'labels' => $pieChartData->pluck('jenis_cuti'),
            'datasets' => [
                [
                    'data' => $pieChartData->pluck('percentage'),
                    'backgroundColor' => [
                        'rgba(8, 36, 75, 0.75)',
                        'rgba(0, 81, 123, 0.75)',
                        'rgba(0, 128, 148, 0.75)',
                        'rgba(0, 175, 145, 0.75)',
                        'rgba(127, 216, 124, 0.75)',
                        'rgba(249, 248, 113, 0.75)',
                    ],
                    'borderColor' => [
                        'rgba(8, 36, 75, 0.75)',
                        'rgba(0, 81, 123, 0.75)',
                        'rgba(0, 128, 148, 0.75)',
                        'rgba(0, 175, 145, 0.75)',
                        'rgba(127, 216, 124, 0.75)',
                        'rgba(249, 248, 113, 0.75)',
                    ],
                    'borderWidth' => 1,
                ]
            ]
        ];
        $this->pieChartData = json_encode($pieChart);

        //PolarChart
        $polarChartData = RiwayatCuti::select(
            'pegawais.unitKerja as unitKerja',
            DB::raw('COUNT(riwayat_cutis.id) as total'),
        )
            ->join('pegawais', 'riwayat_cutis.pegawai_id', '=', 'pegawais.id')
            ->groupBy('pegawais.unitKerja')
            ->get();


        // Format data Pie Chart
        $polarChart = [
            'labels' => $polarChartData->pluck('unitKerja'),
            'datasets' => [
                [
                    'data' => $polarChartData->pluck('total'),
                    'backgroundColor' => [
                        'rgba(8, 36, 75, 0.75)',
                        'rgba(0, 81, 123, 0.75)',
                        'rgba(0, 128, 148, 0.75)',
                        'rgba(0, 175, 145, 0.75)',
                        'rgba(127, 216, 124, 0.75)',
                        'rgba(249, 248, 113, 0.75)',
                    ],
                    'borderColor' => [
                        'rgba(8, 36, 75, 0.75)',
                        'rgba(0, 81, 123, 0.75)',
                        'rgba(0, 128, 148, 0.75)',
                        'rgba(0, 175, 145, 0.75)',
                        'rgba(127, 216, 124, 0.75)',
                        'rgba(249, 248, 113, 0.75)',
                    ],
                    'borderWidth' => 1,
                ]
            ]
        ];
        $this->polarChartData = json_encode($polarChart);

        // Data Sidebar
        $this->cutiPerPegawai = RiwayatCuti::select(
            'pegawais.nama as nama_pegawai',
            'pegawais.unitKerja as unitKerja',
            DB::raw('COUNT(riwayat_cutis.id) as total_cuti')
        )
            ->join('pegawais', 'riwayat_cutis.pegawai_id', '=', 'pegawais.id')
            ->groupBy('pegawais.nama', 'pegawais.unitKerja')
            ->orderByDesc('total_cuti')
            ->limit(5) // Batasi 10 pegawai dengan cuti terbanyak
            ->get();
    }

    public function render()
    {
        return view('livewire.penyetuju-dashboard', [
            'cutiPerPegawai' => $this->cutiPerPegawai,
        ]);
    }

    // Warna Diagram
    private function generateColor($unitKerja)
    {
        // Pilihan warna berdasarkan unit kerja *) ini masih manual gitu, aku ga ngerti kalo otomatis dari si $unitKerja nya :3
        $colors = [
            'DevOps' => 'rgba(8, 36, 75, 1)',
            'DevOps1' => 'rgba(0, 81, 123, 1)',
            'DevOps2' => 'rgba(0, 128, 148, 1)',
            'STIS' => 'rgba(0, 175, 145, 1)',
            'STIS1' => 'rgba(127, 216, 124, 1)',
            'STIS2' => 'rgba(249, 248, 113, 1)',
        ];

        return $colors[$unitKerja] ?? 'rgba(201, 203, 207, 0.75)';
    }
}
