<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: utama.php");
    exit();
}

$email = $_SESSION['user_id'];
$role = $_SESSION['role'];
?>
<?php include 'includes/header.php'; ?>
<!-- Link ke file CSS -->
<link rel="stylesheet" href="assets/css/home.css">

<main>
    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-content">
            <h2>Selamat Datang di HandyFix</h2>
            <p>Mendapatkan solusi cepat dan akurat untuk deteksi kerusakan smartphone Anda!</p>
            <p>Apakah smartphone Anda bermasalah? Temukan solusinya dengan deteksi otomatis dan diagnosis yang terpercaya. Dengan menggunakan algoritma canggih, kami membantu Anda memahami kondisi perangkat Anda dalam hitungan menit.</p>
            <a href="detect.php" class="cta-button">Mulai Diagnosis</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="about">
        <div>
            <h2>Tentang Kami</h2>
            <p>
                Kami menyediakan layanan sistem deteksi kerusakan smartphone dengan teknologi terkini untuk membantu Anda menemukan solusi terbaik.
            </p>
            <img src="images/bg.jpg" alt="Tentang Kami">
        </div>
    </div>

    <!-- Features Section -->
    <div class="features">
        <div>
            <h2>Fitur Utama</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <h3>Diagnosa Cepat</h3>
                    <p>Deteksi kerusakan smartphone dalam hitungan menit.</p>
                </div>
                <div class="feature-item">
                    <h3>Kompatibilitas Luas</h3>
                    <p>Mendukung berbagai merek dan model perangkat.</p>
                </div>
                <div class="feature-item">
                    <h3>Hasil Akurat</h3>
                    <p>Algoritma canggih memastikan hasil analisa terpercaya.</p>
                </div>
                <div class="feature-item">
                    <h3>Dukungan 24/7</h3>
                    <p>Tim kami siap membantu kapan saja Anda butuhkan.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="contact">
        <div>
            <h2>Hubungi Kami</h2>
            <p>Ingin tahu lebih lanjut? Hubungi kami melalui formulir di bawah ini:</p>
            <form>
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" placeholder="Nama Anda" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email Anda" required>

                <label for="message">Pesan:</label>
                <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini" rows="5" required></textarea>

                <button type="submit" class="btn">Kirim</button>
            </form>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
