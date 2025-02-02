<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permintaan dan Pemberian Cuti</title>
    <style>
        @page {
            size: A4;
            margin: 22mm;
        }

        body {
            font-size: 10px;
            font-family: Calibri, Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
        }

        th,
        td {
            padding: 2px;
            text-align: left;
            border: 1px solid black;
            word-wrap: break-word;
            font-size: 10px;
        }

        tr {
            height: auto;
        }

        table,
        tr,
        td,
        th {
            page-break-inside: avoid;
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
            margin-bottom: 5px;
        }

        .checkbox {
            width: 10px;
            height: 10px;
            display: inline-block;
            border: none;
            text-align: center;
            line-height: 10px;
            vertical-align: middle;
        }

        .data {
            border: 1px solid #000;
            padding: 10px;
            margin-bottom: 10px;
        }

        .tanggalSurat p {
            margin: 0;
            padding: 5px 0;
            text-align: right;
            font-size: 12px;
        }

        h2 {
            font-size: 14px;
            margin: 0;
            padding-bottom: 10px;
        }

        #jenisCuti td {
            width: 25%;
            text-align: left;
            padding: 2px;
        }

        .checkbox-small {
            width: 15px;
            height: 15px;
        }

        .tanggalSurat {
            margin-left: 340px;
        }

        .tanggalSurat p {
            text-align: left;
            margin: 2px 0;
            /* Reduces space above and below each <p> element */
            padding: 0;
            font-size: 12px;
        }

        th {
            font-weight: normal;
            /* Removes bold */
            font-size: 12px;
            /* Slightly increases font size */
        }
    </style>
</head>

<body>

    <!-- Tanggal Surat -->
    <div class="tanggalSurat">
        <p>{{ $pengajuan->tanggalDiajukanFormatted }}</p>
        <p>Kepada</p>
        <p>Yth. Kepala Pusat Pendidikan dan Pelatihan</p>
        <p>di</p>
        <p>Tempat</p>
    </div>

    <!-- Isi Surat -->
    <div class="isiSurat">
        <h2 style="text-align: center;">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h2>
        <!-- Tabel I Data Pegawai -->
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

        <!-- Tabel II Jenis Cuti -->
        <div class="jenisCuti">
            <table id="jenisCuti">
                <tr>
                    <th colspan="4">II. JENIS CUTI</th>
                </tr>
                <tr>
                    <td>1. Cuti Tahunan</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Tahunan')
                            <img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                    <td>4. Cuti Melahirkan</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Melahirkan')
                            <img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>2. Cuti Besar</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Besar')
                            <img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                    <td>5. Cuti Karena Alasan Penting</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Karena Alasan Penting')
                            <img src="{{ public_path('img/check-mark.jpg') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>3. Cuti Sakit</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Sakit')
                            <img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                    <td>6. Cuti Diluar Tanggungan Negara</td>
                    <td>
                        @if ($pengajuan->jenis_cuti == 'Cuti Diluar Tanggungan Negara')
                            <img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small">
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Tabel III Alasan Cuti -->
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

        <!-- Tabel IV Lama Cuti -->
        <div class="lamaCuti">
            <table>
                <tr>
                    <th colspan="4">IV. LAMA CUTI</th>
                </tr>
                <tr>
                    <td>Selama</td>
                    <td>{{ $pengajuan->lama_cuti }}</td>
                    <td>Mulai Tanggal</td>
                    <td>{{ $pengajuan->startCutiFormatted }}</td>
                </tr>
            </table>
        </div>

        <!-- Tabel V Catatan Cuti -->
        <!-- belum ngambil database -->
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
                    <th>Tahun</th>
                    <th>Sisa</th>
                    <th>Keterangan</th>
                    <td>3. CUTI SAKIT</td>
                </tr>
                @foreach ($sisaCuti as $index => $cuti)
                    <tr>
                        <td>{{ $cuti->tahun }}</td>
                        <td>{{ $cuti->sisa_cuti }}</td>
                        <td>{{ $cuti->tahun }}</td>
                        <td>
                            @if ($index == 0)
                                4. CUTI MELAHIRKAN
                            @elseif ($index == 1)
                                5. CUTI KARENA ALASAN PENTING
                            @elseif ($index == 2)
                                6. CUTI DI LUAR TANGGUNGAN NEGARA
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>

        <!-- Tabel VI Alamat Cuti -->
        <div class="alamatCuti">
            <table>
                <tr>
                    <th colspan="3">VI. ALAMAT SELAMA MENJALANKAN CUTI</th>
                </tr>
                <tr>
                    <th></th>
                    <th>Telepon</th>
                    <th></th>
                </tr>
                <tr>
                    <td>{{ $pengajuan->alamat_cuti }}</td>
                    <td>{{ $pengajuan->nomor_hp }}</td>
                    <td>
                        <table class="ttd1" style="border: none;">
                            <tr>
                                <td style="text-align: center; border: none;">Hormat saya,</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; border: none;"><img
                                        src="{{ public_path('img/dummy.jpg') }}"
                                        style="height: 50px; width: 50px; object-fit: contain;" alt="TTD1"></td>
                            </tr>
                            <tr>
                                <td style="text-align: center; border: none;">{{ $pengajuan->nama_pengaju }}</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; border: none;">{{ $pengajuan->nip_pengaju }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Tabel VII Pertimbangan Atasan -->
        <div class="pertimbanganAtasan">
            <table>
                <tr>
                    <th colspan="4">VII. PERTIMBANGAN ATASAN</th>
                </tr>
                <tr>
                    <td>DISETUJUI</td>
                    <td>PERUBAHAN</td>
                    <td>DITANGGUHKAN</td>
                    <td>TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <td><img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small"></td>
                    <td style="height: 10px;"></td>
                    <td style="height: 10px;"></td>
                    <td style="height: 10px;"></td>
                </tr>
                <tr>
                    <td style="text-align: right; vertical-align: middle; padding-right: 10px;" colspan="4">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span style="vertical-align: text-top; padding-right: 5px; font-size: 10px;">Kepala
                                PPSDM</span>
                            <br>
                            <img src="{{ public_path('img/dummy.jpg') }}"
                                style="height: 50px; width: 50px; object-fit: contain;" alt="TTD1">
                            <br>
                            <span
                                style="vertical-align: text-bottom; padding-right: 5px; font-size:10px; text-decoration:underline;">
                                {{ $pengajuan->nama_atasan }}
                            </span>
                            <br>
                            <span style="vertical-align: text-bottom; padding-right: 5px; font-size:10px;">
                                NIP.{{ $pengajuan->nip_atasan }}
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Tabel VIII Keputusan Atasan -->
        <div class="keputusanPejabat">
            <table>
                <tr>
                    <th colspan="4">VIII. KEPUTUSAN PEJABAT</th>
                </tr>
                <tr>
                    <td>DISETUJUI</td>
                    <td>PERUBAHAN</td>
                    <td>DITANGGUHKAN</td>
                    <td>TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <td><img src="{{ public_path('img/check-mark.png') }}" alt="checkbox" class="checkbox-small"></td>
                    <td style="height: 10px;"></td>
                    <td style="height: 10px;"></td>
                    <td style="height: 10px;"></td>
                </tr>
                <tr>
                    <td style="text-align: right; vertical-align: middle; padding-right: 10px;" colspan="4">
                        <div style="display: flex; flex-direction: column; align-items: center;">
                            <span style="vertical-align: text-top; padding-right: 5px; font-size: 10px;">Kepala
                                PPSDM</span>
                            <br>
                            <img src="{{ public_path('img/dummy.jpg') }}"
                                style="height: 50px; width: 50px; object-fit: contain;" alt="TTD1">
                            <br>
                            <span
                                style="vertical-align: text-bottom; padding-right: 5px; font-size:10px; text-decoration:underline;">
                                {{ $pengajuan->nama_penyetuju }}
                            </span>
                            <br>
                            <span style="vertical-align: text-bottom; padding-right: 5px; font-size:10px;">
                                NIP.{{ $pengajuan->nip_penyetuju }}
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
