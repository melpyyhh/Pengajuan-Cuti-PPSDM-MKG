<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Cuti Ditolak</title>
</head>
<body>
    <h1>Pengajuan Cuti Ditolak</h1>
    <p>Halo,</p>
    <p>Pengajuan cuti yang diajukan oleh <strong>{{ $pengajuan->pengaju->nama }}</strong> telah ditolak oleh atasan.</p>
    <p>Jenis Cuti: <strong>{{ $pengajuan->cuti->jenis_cuti }}</strong></p>
    <p>Silakan login ke sistem untuk melihat alasan penolakan dan melakukan tindakan lebih lanjut jika diperlukan.</p>
    <p>Terima kasih.</p>
</body>
</html>
