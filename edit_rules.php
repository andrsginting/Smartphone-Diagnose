<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: utama.php");
    exit();
}

include 'includes/header.php';
require 'db/config.php'; // Database configuration file

?>

<link rel="stylesheet" href="assets/css/edit_rules.css">

<main>
    <h1>Manage Rules</h1>
    
    <div class="table-container">
        <?php
        // Query untuk mendapatkan semua kombinasi MK, CK, dan Diagnose
        $query = "
            SELECT 
                mk.kode_masalah AS masalah_id, 
                mk.masalah AS masalah_description,
                ck.kode_ciri AS ciri_id, 
                ck.ciri AS ciri_description,
                d.id AS diagnosis_id,
                d.diagnosis,
                d.percentage
            FROM masalah_kerusakan mk
            JOIN ciri_kerusakan ck ON SUBSTRING(mk.kode_masalah, 3) = SUBSTRING(ck.kode_ciri, 3)
            JOIN diagnose d ON d.id = CAST(SUBSTRING(mk.kode_masalah, 3) AS UNSIGNED)
            WHERE mk.kode_masalah BETWEEN 'MK01' AND 'MK20'
              AND ck.kode_ciri BETWEEN 'CK01' AND 'CK20'
              AND d.id BETWEEN 1 AND 20
            ORDER BY d.id;
        ";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>
                    <th>Masalah ID</th>
                    <th>Masalah Description</th>
                    <th>Ciri ID</th>
                    <th>Ciri Description</th>
                    <th>Diagnosis</th>
                    <th>Percentage</th>
                    <th>Actions</th>
                  </tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['masalah_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['masalah_description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ciri_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['ciri_description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['diagnosis']) . '</td>';
                echo '<td>' . htmlspecialchars($row['percentage']) . '%</td>';
                echo '<td>';
                echo '<button class="delete" onclick="deleteRule(' . $row['diagnosis_id'] . ')">Delete</button>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No rules found.</p>';
        }
        ?>
    </div>
</main>

<script>
function editRule(id) {
    window.location.href = edit_rule.php?id=${id};
}
function deleteRule(id) {
    if (confirm('Are you sure you want to delete this rule?')) {
        window.location.href = delete_rule.php?id=${id};
    }
}
</script>

<?php include 'includes/footer.php'; ?>