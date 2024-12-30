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
<link rel="stylesheet" href="assets/css/news.css">

<main>
    <h1>Berita Terkini Seputar Smartphone</h1>
    <div class="news-container">
        <!-- Card 1 -->
        <div class="news-card">
            <img src="images/berita1.jpg" alt="Berita 1">
            <h2>Kemenperin Ancam Blokir IMEI Ponsel Google Pixel di Indonesia</h2>
            <p>Google Pixel tidak didistribusikan secara resmi di Indonesia dan belum mengajukan sertifikat Tingkat Komponen Dalam Negeri (TKDN)...</p>
            <button class="btn-more" 
            data-title="Kemenperin Ancam Blokir IMEI Ponsel Google Pixel di Indonesia" 
            data-content="'Semua Google Pixel belum ada TKDN,' kata Juru Bicara Kementerian Perindustrian, Febri Hendri Antoni Arief. Dia juga menganjurkan masyarakat untuk tidak membeli ponsel Pixel karena dapat merugikan pengguna dan berpotensi diblokir IMEI-nya. 
            
            Febri mempersilakan Google untuk mengajukan sertifikasi TKDN bila ingin menjual ponsel Pixel di Indonesia secara resmi. Seperti vendor smartphone lainnya, raksasa teknologi itu bisa memilih tiga skema TKDN yang tersedia yaitu skema inovasi, pembangunan manufaktur, atau skema aplikasi. Dia pun menegaskan bahwa segala produk perangkat telekomunikasi yang masuk ke Indonesia, perlu memenuhi regulasi Peraturan Pemerintah (PP) Nomor 46 Tahun 2021 yang mengatur tentang pos, telekomunikasi, dan penyiaran.">More</button>
        </div>

        <!-- Card 2 -->
        <div class="news-card">
            <img src="images/berita2.jpg" alt="Berita 2">
            <h2>Peluncuran Android 16 Bakal Lebih Cepat dari Biasanya</h2>
            <p>Perusahaan raksasa Google bakal meluncurkan sistem operasi (OS) Android terbaru lebih cepat dari biasanya mulai tahun 2025 mendatang...</p>
            <button class="btn-more" data-title="Peluncuran Android 16" 
            data-content="Google mengungkapkan, Android 16 versi final dijadwalkan akan dirilis pada kuartal kedua 2025 (Q2 2025) atau antara bulan April hingga Juni tahun depan. Jadwal ini lebih cepat dari tradisi Google biasanya. Menurut riwayat sebelumnya, Google biasanya meluncurkan Android versi final pada bulan kuartal tiga atau sekitar bulan Agustus hingga Oktober setiap tahunnya.
            
            'Kami merencanakan rilis utama (Android 16) untuk Q2, bukan Q3, agar lebih sesuai dengan jadwal peluncuran perangkat di seluruh ekosistem kami,' tulis Vice President, Product Management, Android Developer, Matthew McCullough dalam blog Android Developers.">More</button>
        </div>

        <!-- Tambahkan lebih banyak card di sini -->
        <div class="news-card">
            <img src="images/berita3.jpg" alt="Berita 3">
            <h2>Kelamaan Menatap Layar Smartphone Bisa Merusak Mata?</h2>
            <p>pengguna kiranya perlu mewaspadai kebiasaan menatap layar HP dalam waktu lama. Lantas, apa akibat terlalu sering menatap layar HP? ...</p>
            <button class="btn-more" data-title="Kelamaan Menatap Layar Smartphone Bisa Merusak Mata?" 
            data-content="Sebagian besar gejala kelelahan mata akibat penggunaan komputer menyebabkan perubahan sementara. Namun, gejalanya dapat meningkat atau berlanjut jika tidak ditangani dengan tepat, sehingga nantinya bisa mengurangi kemampuan penglihatan.
            
            Menatap layar HP terlalu lama tidak langsung merusak mata. Layar HP menghasilkan cahaya biru. Paparan cahaya biru dalam jangka panjang dapat merusak penglihatan dan kesehatan mata karena merusak retina.">More</button>
        </div>
    </div>
</main>

<!-- Modal -->
<div id="news-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title"></h2>
        <p id="modal-content"></p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Script untuk modal -->
<script>
document.querySelectorAll('.btn-more').forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.getElementById('news-modal');
        const title = button.getAttribute('data-title');
        const content = button.getAttribute('data-content');
        
        document.getElementById('modal-title').innerText = title;
        document.getElementById('modal-content').innerText = content;

        modal.style.display = 'flex';
    });
});

document.querySelector('.modal .close').addEventListener('click', () => {
    document.getElementById('news-modal').style.display = 'none';
});

window.addEventListener('click', (e) => {
    if (e.target.id === 'news-modal') {
        document.getElementById('news-modal').style.display = 'none';
    }
});
</script>
