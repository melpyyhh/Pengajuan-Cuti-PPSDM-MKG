<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Cuti Diterima</title>
</head>
<body>
    <h1>Pengajuan Cuti Telah Diterima</h1>
    <p>Halo,</p>
    <p>Pengajuan cuti yang diajukan oleh <strong>{{ $pengajuan->pengaju->nama }}</strong> telah disetujui oleh atasan.</p>
    <p>Jenis Cuti: <strong>{{ $pengajuan->cuti->jenis_cuti }}</strong></p>
    <p>Silakan login ke sistem untuk melihat detail lebih lanjut.</p>
    <p>Terima kasih.</p>
</body>
</html>