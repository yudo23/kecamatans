Panduan Instalasi<br> 
-Clone project<br>
-Jalankan composer i<br>
-Jalankan cp .env.example .env<br>
-Buat database dengan nama kecamatans<br>
-Buka cmd, jalankan php artisan migrate<br>
-Buka cmd, jalankan php artisan db:seed<br>
-Buka cmd, jalankan php artisan superadmin:create<br>
-Buka cmd, jalankan php artisan key:generate<br>
-Buka cmd, jalankan php artisan serve<br>
-Buka browser buka alamat http://localhost:8000<br>

Panduan Fitur Email (Forgot Password dan Hubungi Kami)<br> 
-Download mailhog.exe <br>
-Buka mailhog <br>
-Buka browser buka alamat http://localhost:8025 <br>
-Buka cmd, jalankan php artisan queue:work (jangan tutup terminal ini) <br>
