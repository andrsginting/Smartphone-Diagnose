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
<link rel="stylesheet" href="assets/css/about.css">
<main>
    <div class="container">
        <!-- Bagian Statistik -->
        <div class="stats-container">
            <div class="stat-item">
                <h3>👥 4 Members</h3>
                <p>Across all the fields from design, motion to copywriting</p>
            </div>
            <div class="stat-item">
                <h3>📄 400 million</h3>
                <p>Additional revenue we generated for our clients</p>
            </div>
            <div class="stat-item">
                <h3>✔️ +14 Projects</h3>
                <p>Completed just within the last year, all with success</p>
            </div>
        </div>

        <!-- Bagian Misi -->
        <div class="mission-card">
            <div class="mission-text">
                <h2>What is our mission?</h2>
                <p>
                    Di HandyFix, misi kami adalah memberikan layanan perbaikan handphone terbaik dengan kualitas unggul dan harga terjangkau.
                </p>
                <p>
                    Kami berkomitmen untuk memberikan solusi cepat dan efisien bagi setiap pelanggan, dengan mengutamakan kepuasan dan kepercayaan. Tim teknisi kami yang berpengalaman siap membantu memperbaiki perangkat Anda dengan teknologi terbaru dan suku cadang berkualitas tinggi, menjadikan setiap perangkat kembali berfungsi dengan optimal.
                </p>
                <p>
                    Kami berusaha menjadi mitra terpercaya dalam menjaga kinerja handphone Anda, kapan saja dan di mana saja.
                </p>
            </div>
            <div class="mission-image">
                <img src="portrait.jpg" alt="Portrait">
            </div>
        </div>
    </div>
</main>
<?php include 'includes/footer.php'; ?>
