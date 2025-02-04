# Project Title: Aplikasi Sistem Pengajuan Cuti PPSDM BMKG Berbasis Web

## Deskripsi Singkat

Website ini dirancang dalam rangka menciptakan serangkaian proses pengajuan cuti berbasis elektronik (website) dalam lingkungan PPSDM BMKG.

- Adapun identifikasi masalah yang ditemui antara lain minimnya monitoring dan transparansi pengajuan cuti antara pegawai (pihak yang mengajukan cuti) dan atasan (pihak yang menyetujui cuti), adanya ketergantungan pengajuan cuti yang masih dikelola oleh Badan Kepegawaian Negara (BKN), serta masih adanya urgensi bukti fisik pengajuan cuti dalam bentuk hardfile.
- Harapannya dengan dirancang serta dibangunnya sistem pengajuan cuti ini berhasil menyelesaikan masalah-masalah yang telah dijelaskan sebelumnya.

#Fitur-fitur Utama Sistem

1. Modul Pengajuan Cuti Online dengan Form Digital

- User dapat mengajukan cuti dengan mengakses form digital secara online.
- User cukup mengisi pertanyaan yang telah disediakan, sistem telah menyesuaikan dengan kebutuhan terkait sistem pengajuan cuti yang sedang berjalan di PPSDM BMKG.
- User secara tidak langsung dapat mengetahui sisa cuti atau apakah user masih dapat mengajukan cuti saat mengajukan pengajuan cuti di sistem ini.

2. Sistem Persetujuan Bertingkat sesuai hierarki organisasi

- Proses penyetujuan cuti telah disesuaikan dengan kebutuhan terkait sistem pengajuan cuti yang sedang berjalan di PPSDM BMKG.

3. Fitur Ekspor Dokumen Cuti dalam Format PDF

- User dapat mengunduh bukti pengajuan cuti yang telah disetujui dalam format PDF, kemudian dapat menyimpannya di direktori masing-masing jika perlu akan kebutuhan dokumen fisik di kemudian hari.

4. Sistem Tracking dan Monitoring Status Pengajuan Cuti

- User (pegawai maupun pengaju) dapat mengakses status pengajuan cuti yang sedang diajukan untuk melihat perubahannya setiap waktu.

5. Implementasi Chabot untuk Bantuan Informasi

- User dapat mengajukan pertanyaan seputar pengajuan cuti atau pengiriman pengaduan ke admin melalui fitur chatbot.

6. Manajemen Data Pegawai dan Sisa Cuti

- Admin dapat menambahkan data pegawai beserta data sisa cuti masing-masing pegawainya.
- Penambahan data pegawai secara tidak langsung akan membuat akun untuk pegawai tersebut agar dapat mengakses aplikasi web ini menggunakan email dan password.

5. Sistem Pelaporan dan Analisis Data Cuti

- Atasan/Penyetuju dapat melihat analisis deskriptif atau ringkasan pengajuan cuti yang terjadi di PPSDM BMKG melalui dashboard.

#Struktur repositori
root/
app/
├── Console/ # Folder untuk menyimpan perintah Artisan custom (Console Commands)
│ └── Commands/ # Folder untuk menyimpan perintah-perintah khusus yang dapat dijalankan melalui Artisan
├── Http/ # Folder yang berisi logika untuk menangani HTTP request
│ ├── Controllers/ # Folder untuk menyimpan controller yang menangani permintaan HTTP
│ ├── Livewire/ # Folder untuk komponen Livewire, yang memungkinkan interaktivitas langsung di frontend
│ ├── Middleware/ # Folder untuk middleware, yaitu lapisan antara request dan aplikasi
│ ├── Requests/ # Folder untuk form request validation
│ └── Mail/ # Folder untuk pengaturan pengiriman email
├── Models/ # Folder untuk menyimpan model yang berhubungan dengan database
├── Policies/ # Folder untuk menyimpan kebijakan yang mengatur akses ke resource
├── Providers/ # Folder untuk menyimpan service providers, yang mendaftarkan berbagai layanan dalam aplikasi
└── View/ # Folder untuk menyimpan komponen-komponen Blade
└── Components/ # Folder untuk menyimpan komponen Blade reusable
├── bootstrap/ # Berisi file bootstrap untuk caching
├── config/ # Berisi file konfigurasi aplikasi, seperti setting database, mail, dll.
├── database/ # Berisi file yang berhubungan dengan migrasi dan seeder database
├── public/ # Folder yang berisi file publik seperti file CSS, JS, dan gambar
├── resources/ # Folder untuk tampilan dan resource lainnya
├── routes/ # Berisi file untuk mendefinisikan rute aplikasi
├── storage/ # Tempat penyimpanan file yang dihasilkan aplikasi, seperti logs
├── tests/ # Berisi file untuk unit testing aplikasi
├── .editorconfig # File konfigurasi editor untuk menyamakan gaya kode
├── .env.example # Contoh file .env untuk konfigurasi lingkungan
├── .gitattributes # Menentukan aturan untuk file yang ada di repositori Git
├── .gitignore # Mengatur file/folder yang diabaikan oleh Git
├── README.md # Dokumentasi umum tentang proyek
├── artisan # Skrip artisan untuk menjalankan perintah di Laravel
├── composer.json # File konfigurasi Composer untuk dependensi PHP
├── composer.lock # File lock untuk dependensi yang digunakan oleh Composer
├── package-lock.json # File lock untuk dependensi Node.js
├── package.json # File konfigurasi untuk dependensi Node.js
├── phpunit.xml # File konfigurasi untuk PHPUnit
├── postcss.config.js # File konfigurasi untuk PostCSS
├── tailwind.config.js # File konfigurasi untuk Tailwind CSS
└── vite.config.js # File konfigurasi untuk Vite (tool untuk bundling)

## Teknologi yang Digunakan

### Presentation Tier

- **HTML**
- **CSS (Framework Tailwind)**
- **JavaScript**
- **JavaScript (Framework ChartJS)**

### Application Tier

- **PHP (Framework Laravel)**
- **PHP (Livewire, Framework Laravel)**

### Database Tier

- **MySQL**

## Cara Menggunakan

1. Clone repositori menggunakan git clone:
   ```bash
   git clone https://github.com/melpyyhh/Pengajuan-Cuti-PPSDM-MKG
   ```
2. Instal dependensi menggunakan Composer:
   ```bash
   composer install
   ```
3. Generate key
   ```bash
   php artisan generate:key
   ```
4. Konfigurasi file `.env` sesuai dengan database dan email:

   ```env
   database.default.hostname = localhost
   database.default.database = nama_database
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi

   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=465
   MAIL_USERNAME=
   MAIL_PASSWORD=
   MAIL_ENCRYPTION=ssl
   MAIL_FROM_ADDRESS=""
   MAIL_FROM_NAME="${APP_NAME}"
   ```

5. Migrasi database:
   ```bash
   php artisan migrate
   php artisan db:seed --class=JenisCutiSeeder  # menjalankan seeder untuk jenis cuti
   php artisan db:seed --class=DummyPegawaiSeeder  # menjalankan seeder untuk dummy pegawai
   php artisan db:seed --class=DummyUserSeeder  # menjalankan seeder untuk dummy user
   ```
6. Untuk penggunaan lokal, hidupkan erver dengan:
   ```bash
   php artisan serve
   php artisan queue:work
   ```
   dan di terminal yang berbeda jalankan:
   ```bash
   nmp run dev
   ```
7. Untuk deploy gunakan perintah:
   ```
   npm run build
   ```
8. Set cron job untuk Queue Worker:
   ```
   /usr/local/bin/php /home/username/public_html/laravel/artisan queue:work --tries=3
   /home/username/public_html/laravel/artisan # sesuaikan menuju folder yang memiliki file artisan
   ```
9. Set cron job untuk Scheduler:
   ```
   * * * * * /usr/local/bin/php /home/username/laravel_app/artisan schedule:run >> /dev/null 2>&1
   ```
