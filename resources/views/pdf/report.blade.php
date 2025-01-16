<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permintaan dan Pemberian Cuti</title>
    <style>
        @page {
            size: A4;
            /* Ukuran tetap A4 */
            margin: 10mm;
            /* Kurangi margin agar lebih hemat ruang */
        }

        body {
            font-size: 11px;
            /* Kurangi ukuran font */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            /* Pastikan tabel menggunakan seluruh lebar yang tersedia */
            border-collapse: collapse;
            /* Hapus margin antar tabel */
        }

        th,
        td {
            padding: 5px;
            /* Kurangi padding */
            text-align: left;
            border: 1px solid black;
            /* Gunakan batas yang rapat */
            word-wrap: break-word;
            /* Bungkus kata agar tidak melampaui kolom */
        }

        .isiSurat,
        .dataPegawai,
        .jenisCuti,
        .alasanCuti,
        .lamaCuti,
        .catatanCuti,
        .alamatCuti,
        .pertimbanganAtasan,
        .keputusanPejabat {
            page-break-inside: avoid;
            /* Hindari elemen memisahkan halaman */
            margin-bottom: 5px;
            /* Kurangi jarak antar elemen */
        }

        .checkbox {
            width: 10px;
            /* Perkecil ukuran */
            height: 10px;
            display: inline-block;
            border: 1px solid black;
            /* Sesuaikan ukuran kotak */
            text-align: center;
            line-height: 10px;
            vertical-align: middle;
        }

        .data {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
        }

        .checkbox {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: none;
            text-align: center;
            vertical-align: middle;
        }

        .tanggalSurat p {
            margin: 0;
            padding: 5px 0;
            /* Beri sedikit jarak antar paragraf */
            text-align: right;
            /* Seluruh teks rata kanan */
            font-size: 12px;
            /* Sesuaikan ukuran font */
        }
    </style>
</head>

<body>

    <div class="tanggalSurat">
        <p style="text-align: right;">Jakarta, 24 Juni 2024</p>
        <p style="text-align: right;">Kepada</p>
        <p style="text-align: right;">Yth. Kepala Pusat Pendidikan dan Pelatihan</p>
        <p style="text-align: right;">di</p>
        <p style="text-align: right;">Tempat</p>
    </div>


    <div class="isiSurat">
        <h2 style="text-align: center;">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h2>
        <div class="dataPegawai">
            <table id="dataPegawai">
                <tr>
                    <th colspan="4">I. DATA PEGAWAI</th>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $pengajuan->nama_pengaju }}</td>
                    <th>NIP</th>
                    <td>{{ $pengajuan->nip_pengaju }}</td>
                </tr>
                <tr>
                    <th>Jabatan</th>
                    <td>{{ $pengajuan->jabatan_pengaju }}</td>
                    <th>Masa Kerja</th>
                    <td>{{ $pengajuan->masaKerja_pengaju }}</td>
                </tr>
                <tr>
                    <th>Unit Kerja</th>
                    <td colspan="3">{{ $pengajuan->unitKerja_pengaju }}</td>
                </tr>
            </table>

        </div>

        <div class="jenisCuti">
            <table id="jenisCuti">
                <tr>
                    <th colspan="6">II. JENIS CUTI</th>
                </tr>
                <tr>
                    <td> 1.{{ $pengajuan->jenis_cuti }}</td>
                    <td><span class="checkbox">✓</span></td>
                    <td> 4. Cuti melahirkan</td>
                    <td><span class="checkbox">✓</span></td>
                </tr>
                <tr>
                    <td> 2. Cuti besar</td>
                    <td><span class="checkbox">✓</span></td>
                    <td> 5. Cuti karena alasan penting</td>
                    <td><span class="checkbox">✓</span></td>
                </tr>
                <tr>
                    <td> 3. Cuti sakit</td>
                    <td><span class="checkbox">✓</span></td>
                    <td> 6. Cuti diluar tanggungan negara</td>
                    <td><span class="checkbox">✓</span></td>
                </tr>
            </table>
        </div>

        <div class="alasanCuti">
            <table>
                <tr>
                    <th colspan="6">III. ALASAN CUTI</th>
                </tr>
                <tr>
                    <td colspan="6">{{ $pengajuan->alasan }}</td>
                </tr>
            </table>
        </div>

        <div class="lamaCuti">
            <table>
                <tr>
                    <th>IV. LAMA CUTI</th>
                </tr>
                <tr>
                    <td>Selama</td>
                    <td>{{ $pengajuan->lama_cuti }}</td>
                    <td>Mulai Tanggal</td>
                    <td>{{ $pengajuan->start_cuti }}</td>
                </tr>
            </table>
        </div>

        <div class="catatanCuti">
            <table>
                <tr>
                    <th colspan="4">V. CATATAN CUTI</th>
                </tr>
                <tr>
                    <td colspan="3">1. CUTI TAHUNAN</td>
                    <td>2. CUTI BESAR</td>
                </tr>
                <tr>
                <tr>
                    <th>Tahun</th>
                    <th>Sisa</th>
                    <th>Tahun</th>
                    <td>3. CUTI SAKIT</td>
                </tr>
                <tr>
                    <td>2022</td>
                    <td>0</td>
                    <td>-</td>
                    <td>4. CUTI MELAHIRKAN</td>
                </tr>
                <tr>
                    <td>2022</td>
                    <td>0</td>
                    <td>-</td>
                    <td>5. CUTI KARENA ALASAN PENTING</td>
                </tr>
                <tr>
                    <td>2022</td>
                    <td>0</td>
                    <td>-</td>
                    <td>6. CUTI DILUAR TANGGUNGAN NEGARA</td>
                </tr>
                </tr>
            </table>
        </div>

        <div class="alamatCuti">
            <table>
                <tr>
                    <th colspan="4">VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
                </tr>
                <tr>
                    <th colspan="4">Telepon</th>
                </tr>
                <tr>
                    <td>{{ $pengajuan->alamat_cuti }}</td>
                    <td>{{ $pengajuan->nomor_hp }}</td>
                    <td>Ini TTD1</td>
                </tr>
            </table>
        </div>

        <div class="pertimbanganAtasan">
            <table>
                <tr>
                    <th colspan="4">VII. ALAMAT SELAMA MENJALANKAN CUTI</th>
                </tr>
                <tr>
                    <td>Disetujui</td>
                    <td>Perubahan****</td>
                    <td>Ditangguhkan****</td>
                    <td>Tidak Disetujui****</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">Ini TTD2</td>
                </tr>
            </table>
        </div>

        <div class="keputusanPejabat">
            <table>
                <tr>
                    <th colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI**</th>
                </tr>
                <tr>
                    <td>Disetujui</td>
                    <td>Perubahan****</td>
                    <td>Ditangguhkan****</td>
                    <td>Tidak Disetujui****</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="4">Ini TTD3</td>
                </tr>
            </table>
        </div>
</body>