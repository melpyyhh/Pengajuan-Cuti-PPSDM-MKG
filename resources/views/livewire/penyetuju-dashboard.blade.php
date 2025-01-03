<div class="flex pr-64">
  <div class="flex-1 p-4 rounded-lg dark:border-gray-700">
    <!-- BarChart -->
    <div class="relative flex flex-col items-start justify-start h-64 mb-4 rounded-[25px] dark:bg-gray-800" style="background-color: #FFB916">
      <div class="flex flex-col items-center justify-center w-full h-full p-4">
        <p class="mt-4 mb-4 text-xl font-bold text-black">Distribusi Pengajuan Cuti berdasarkan Unit Kerja</p>
        <canvas id="barChart" class="w-full h-auto"></canvas>
      </div>
    </div>

    <div class="p-4 bg-[#08244B] dark:bg-[#061c3a] rounded-[25px]">
      <div class="p-4 bg-[#08244B] dark:bg-[#061c3a] rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
          <!-- Kolom Kiri -->
          <div class="relative flex flex-col items-start justify-start min-h-[150px] h-full rounded-[25px] dark:bg-gray-800" style="background-color: #FFFFFF">
            <div class="flex flex-col items-center justify-center w-full h-full p-4">
              <p class="mt-4 mb-4 text-xl font-bold text-black">Proporsi Jenis Cuti</p>
              <canvas id="pieChart" class="w-full h-auto"></canvas>
            </div>
          </div>
          <!-- Kolom Tengah -->
          <div class="grid grid-rows-2 items-start gap-4 h-full">
            <div class="flex items-center justify-center rounded-[25px] bg-gray-50 dark:bg-gray-800 h-full" style="background-color: #FFFFFF">
              <div class="text-black text-center py-4 rounded-lg" style="background-color: #FFFFFF">
                <div class="mt-4 mb-4 text-xl font-semibold">
                  Terdapat {{ $cutiData->count() }} pengajuan cuti yang diajukan
                </div>
              </div>
            </div>
            <div class="flex items-center justify-center rounded-[25px] bg-gray-50 dark:bg-gray-800 h-full" style="background-color: #FFFFFF">
              <div class="text-black text-center py-4 rounded-lg" style="background-color: #FFFFFF">
                <div class="mt-4 mb-4 text-xl font-semibold">
                  {{ $cutiDataDisetujui->count() }} pengajuan cuti berhasil disetujui
                </div>
              </div>
            </div>
          </div>

          <!-- Kolom Kanan -->
          <div class="relative flex flex-col items-start justify-start min-h-[150px] h-full rounded-[25px] dark:bg-gray-800" style="background-color: #FFFFFF">
            <div class="flex flex-col items-center justify-center w-full h-full p-4">
              <p class="mt-4 mb-4 text-xl font-bold text-black">Pengajuan Cuti</p>
              <canvas id="polarChart" class="w-full h-auto"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- LineChart -->
      <div class="relative flex flex-col items-start justify-start h-64 mb-4 rounded-[25px] dark:bg-gray-800" style="background-color: #FFFFFF">
        <div class="flex flex-col items-center justify-center w-full h-full p-4">
          <p class="mt-4 mb-4 text-xl font-bold text-black">Trend Pengajuan Cuti</p>
          <canvas id="lineChart" class="w-full h-auto"></canvas>
        </div>
      </div>

    </div>
  </div>

  <div class="fixed top-0 right-0 z-40 w-64 h-full pt-20 bg-white border-r border-gray-200 dark:bg-primary dark:border-gray-700" style="background-color: #CED5E1;">
    <div class="flex flex-col items-center justify-center h-20">
      <p class="text-2xl font-bold text-black text-center">Top 10 on Leave</p>
    </div>
    @foreach($cutiPerPegawai as $pegawai)
    <div class="p-4 rounded-lg shadow">
      <div class="flex justify-between items-center">
        <!-- Kolom Kiri -->
        <div>
          <!-- Nama Pegawai -->
          <div class="text-xl text-black">
            {{ $pegawai->nama_pegawai }}
          </div>
          <!-- Unit Kerja -->
          <div class="text-sm text-gray-600">
            {{ $pegawai->unitKerja }}
          </div>
        </div>
        <!-- Kolom Kanan -->
        <div>
          <!-- Total Cuti -->
          <div class="text-xl text-black">
            {{ $pegawai->total_cuti }}
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>

<!-- BarChart -->
<script>
  var barChart = JSON.parse('<?php echo $barChartData; ?>');
  console.log(barChart);
  const ctx = document.getElementById('barChart').getContext('2d');
  const myChart = new Chart(ctx, {
    width: '100%',
    hight: 'auto',
    type: 'bar',
    data: {
      labels: barChart.labels,
      datasets: barChart.datasets
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          top: 0, // Tambahkan ruang di atas
          bottom: 10, // Tambahkan ruang di bawah untuk legenda
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
        },
        y: {
          beginAtZero: true,
          grid: {
            display: false
          },
          ticks: {
            stepSize: 10
          }
        }
      },
      plugins: {
        legend: {
          position: 'bottom',
        },
      }
    }

  });
</script>

<!-- LineChart -->
<script>
  // Line Chart
  var lineChart = JSON.parse('<?php echo $lineChartData; ?>');
  const ctxLine = document.getElementById('lineChart').getContext('2d');
  const myLineChart = new Chart(ctxLine, {
    width: '100%',
    hight: 'auto',
    type: 'line',
    data: {
      labels: lineChart.labels, // Label bulan/tahun
      datasets: lineChart.datasets // Dua dataset: bulanan dan tahunan
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          top: 10,
          bottom: 10,
          left: 10,
          right: 10
        }
      },
      scales: {
        x: {
          grid: {
            display: false
          },
          title: {
            display: true,
            text: 'Waktu (Tahun)'
          }
        },
        y: {
          grid: {
            display: true
          },
          title: {
            display: true,
            text: 'Jumlah Cuti'
          },
          beginAtZero: true
        }
      },
      plugins: {
        legend: {
          position: 'top' // Posisi legend
        },
      }
    }
  });
</script>

<!-- PieChart -->
<script>
  // Pie Chart
  var pieChart = JSON.parse('<?php echo $pieChartData; ?>');
  const ctxPie = document.getElementById('pieChart').getContext('2d');
  const myPieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
      labels: pieChart.labels,
      datasets: pieChart.datasets
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        }
      }
    }
  });
</script>

<!-- PolarChart -->
<script>
  // Polar Chart
  var polarChart = JSON.parse('<?php echo $polarChartData; ?>');
  console.log(polarChart);
  const ctxPolar = document.getElementById('polarChart').getContext('2d');
  const myPolarChart = new Chart(ctxPolar, {
    type: 'polarArea',
    data: {
      labels: polarChart.labels,
      datasets: polarChart.datasets
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
        }
      }
    }
  });
</script>