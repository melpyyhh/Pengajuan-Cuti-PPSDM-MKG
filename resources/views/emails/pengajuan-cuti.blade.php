<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Cuti</title>
</head>
<body>
    <h1>Pengajuan Cuti Baru</h1>
    <p>Halo,</p>
    <p>Pengajuan cuti baru telah diajukan oleh <strong>{{ $pengajuan->pengaju->nama }}</strong>.</p>
    <p>Jenis Cuti: <strong>{{ $pengajuan->cuti->jenis_cuti }}</strong></p>
    <p>Silakan login ke sistem untuk menyetujui atau menolak pengajuan ini.</p>
    <p>Terima kasih.</p>
</body>
</html>
