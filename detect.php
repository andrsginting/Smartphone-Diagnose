<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: utama.php");
    exit();
}

$email = $_SESSION['user_id'];
$role = $_SESSION['role'];

include 'db/config.php'; // Koneksi database
?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" href="assets/css/detect.css">

<main>
    <!-- Container utama -->
    <div class="content-container">
        <form method="POST" action="process_detection.php">
            <div class="combined-container">
                <!-- Kolom Masalah Kerusakan -->
                <div class="column">
                    <h4>Masalah Kerusakan</h4>
                    <div class="checkbox-group">
                        <?php
                        $query = "SELECT kode_masalah, masalah FROM masalah_kerusakan";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<label>
                                        <input type='checkbox' name='masalah[]' value='{$row['kode_masalah']}'>
                                        {$row['masalah']}
                                      </label><br>";
                            }
                        } else {
                            echo "<p>Data masalah kerusakan tidak ditemukan.</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Kolom Ciri Kerusakan -->
                <div class="column">
                    <h4>Ciri-Ciri Kerusakan</h4>
                    <div class="checkbox-group">
                        <?php
                        $query = "SELECT kode_ciri, ciri FROM ciri_kerusakan";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<label>
                                        <input type='checkbox' name='ciri[]' value='{$row['kode_ciri']}'>
                                        {$row['ciri']}
                                      </label><br>";
                            }
                        } else {
                            echo "<p>Data ciri kerusakan tidak ditemukan.</p>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Kolom Email -->
                <div class="email-column">
                    <h4>Email Anda</h4>
                    <input type="email" name="email" placeholder="Masukkan email Anda" required>
                    <button type="submit" class="cta-button">Deteksi</button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php include 'includes/footer.php'; ?>