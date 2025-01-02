## **Sistem Pakar Deteksi Kerusakan Smartphone**  
Sistem ini adalah sebuah **web-based expert system** yang dirancang untuk membantu pengguna dalam mendiagnosis kerusakan pada smartphone mereka menggunakan metode **Forward Chaining**. Dengan input berupa gejala atau masalah kerusakan, sistem akan memberikan hasil diagnosis berupa jenis kerusakan dan keakuratan deteksinya.  

### **Latar Belakang**  
Kemajuan teknologi membuat smartphone menjadi perangkat yang sangat penting dalam kehidupan sehari-hari. Namun, masalah teknis sering kali menjadi kendala bagi pengguna. Tidak semua pengguna memiliki kemampuan untuk mendiagnosis jenis kerusakan yang terjadi, sehingga mereka harus membawa perangkat ke tempat servis, yang memakan waktu dan biaya. Sistem ini bertujuan untuk memberikan solusi cepat dan akurat bagi pengguna dalam mendeteksi kerusakan smartphone sebelum melakukan langkah perbaikan lebih lanjut.  

### **Tujuan**  
1. Membantu pengguna dalam mendiagnosis kerusakan smartphone tanpa harus datang ke tempat servis.  
2. Memberikan rekomendasi jenis kerusakan berdasarkan gejala yang diinputkan pengguna.  
3. Memudahkan admin untuk mengelola data pengguna, deteksi, dan aturan diagnosis.  

### **Fitur Sistem**  
#### **Fitur Utama untuk Pengguna**  
1. **Diagnosis Kerusakan Smartphone**  
   - Pengguna dapat memasukkan masalah dan ciri kerusakan pada smartphone melalui checkbox yang tersedia.  
   - Hasil diagnosis ditampilkan dalam tabel, mencakup jenis kerusakan, persentase keakuratan, dan rata-rata keakuratan diagnosis.  

2. **Berita Terkini Seputar Smartphone**  
   - Halaman "News" menyediakan informasi terbaru yang relevan tentang teknologi smartphone.  

3. **Informasi Sistem**  
   - Halaman "About Us" berisi penjelasan tentang sistem pakar ini dan manfaatnya bagi pengguna.  

#### **Fitur Tambahan untuk Admin**  
1. **Manage Users**  
   - Admin dapat melihat, mengedit, dan menghapus data pengguna.  

2. **Manage Rules**  
   - Admin dapat memanipulasi aturan diagnosis (rules) yang digunakan dalam proses inferensi sistem.  

3. **Manage Detections**  
   - Admin dapat mengelola data hasil deteksi pengguna, termasuk melihat riwayat deteksi beserta detailnya.  

#### **Desain Responsif dan Interaktif**  
- Sistem dirancang untuk memberikan pengalaman pengguna yang nyaman, baik untuk pengguna awam maupun admin.  

### **Panduan Instalasi**  
Ikuti langkah-langkah berikut untuk menjalankan sistem ini secara lokal:  

1. **Clone Repository**  
   ```bash
   git clone https://github.com/username/repo-name.git
   cd repo-name
   ```  

2. **Setup Database**  
   - Buat database bernama `smartphone_diagnostics` di server MySQL Anda.  
   - Import file SQL yang ada di folder `db/` ke dalam database:  
     ```bash
     mysql -u username -p smartphone_diagnostics < db/schema.sql
     ```  

3. **Konfigurasi Database**  
   - Buka file `db/config.php` dan sesuaikan pengaturan koneksi database Anda:  
     ```php
     <?php
     $host = 'localhost';
     $user = 'root';
     $password = '';
     $database = 'smartphone_diagnostics';
     $conn = new mysqli($host, $user, $password, $database);
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     ?>
     ```  

4. **Menjalankan Web Server**  
   - Pastikan Anda memiliki **XAMPP** atau **WAMP**.  
   - Pindahkan folder project ini ke dalam folder `htdocs` di XAMPP/WAMP.  
   - Jalankan web server melalui panel kontrol XAMPP/WAMP.  

5. **Akses Sistem**  
   - Buka browser dan akses:  
     ```bash
     http://localhost/repo-name
     ```  

6. **Akun Admin (Opsional)**  
   - Buat akun admin secara manual melalui tabel `users` di database.  
   - Pastikan kolom `role` diisi dengan nilai `admin`.  

---

### **Tech Stack yang Digunakan**  
1. **Frontend**: HTML, CSS  
2. **Backend**: PHP  
3. **Database**: MySQL  

---

Dengan sistem ini, pengguna dapat dengan mudah mendiagnosis masalah smartphone mereka, sementara admin memiliki kontrol penuh untuk mengelola data yang relevan.  

--- 
