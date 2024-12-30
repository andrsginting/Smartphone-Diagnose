<?php
session_start();

include 'db/config.php'; // pastikan koneksi database terhubung

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $email = $_POST['email']; // Email pengguna
    $masalah = isset($_POST['masalah']) ? $_POST['masalah'] : [];
    $ciri = isset($_POST['ciri']) ? $_POST['ciri'] : [];

    // Gabungkan masalah dan ciri kerusakan menjadi satu array
    $selected_conditions = array_merge($masalah, $ciri);
    $results = [];

    // Mendapatkan data masalah kerusakan dari database
    $masalah_kerusakan = [];
    if (!empty($masalah)) {
        $masalah_query = "SELECT kode_masalah, masalah FROM masalah_kerusakan WHERE kode_masalah IN ('" . implode("','", $masalah) . "')";
        $masalah_result = $conn->query($masalah_query);
        while ($row = $masalah_result->fetch_assoc()) {
            $masalah_kerusakan[] = $row;
        }
    }

    // Mendapatkan data ciri kerusakan dari database
    $ciri_kerusakan = [];
    if (!empty($ciri)) {
        $ciri_query = "SELECT kode_ciri, ciri FROM ciri_kerusakan WHERE kode_ciri IN ('" . implode("','", $ciri) . "')";
        $ciri_result = $conn->query($ciri_query);
        while ($row = $ciri_result->fetch_assoc()) {
            $ciri_kerusakan[] = $row;
        }
    }

    // Rule Matching
    $rules = [];
    $total_percentage = 0; // Variabel untuk menghitung total persentase
    $count_results = 0; // Variabel untuk menghitung jumlah hasil deteksi yang valid

    // Aturan untuk pasangan masalah dan ciri kerusakan yang sesuai
    for ($i = 0; $i < 20; $i++) {
        $kode_masalah = "MK" . str_pad($i + 1, 2, "0", STR_PAD_LEFT);
        $kode_ciri = "CK" . str_pad($i + 1, 2, "0", STR_PAD_LEFT);

        if (in_array($kode_masalah, $masalah) && in_array($kode_ciri, $ciri)) {
            // Kondisi pasangan sejajar MK + CK
            $diagnose_query = "SELECT diagnosis, percentage FROM diagnose WHERE id = " . ($i + 1);
            $diagnose_result = $conn->query($diagnose_query);
            if ($diagnose_result->num_rows > 0) {
                $row = $diagnose_result->fetch_assoc();
                $rules[] = [
                    'masalah' => $kode_masalah,
                    'ciri' => $kode_ciri,
                    'diagnosis' => $row['diagnosis'],
                    'percentage' => $row['percentage']
                ];
                $total_percentage += $row['percentage'];
                $count_results++;
            }
        } elseif (in_array($kode_masalah, $masalah)) {
            // Jika hanya memilih masalah kerusakan saja
            $diagnose_query = "SELECT diagnosis, percentage FROM diagnose WHERE id = " . ($i + 1);
            $diagnose_result = $conn->query($diagnose_query);
            if ($diagnose_result->num_rows > 0) {
                $row = $diagnose_result->fetch_assoc();
                $rules[] = [
                    'masalah' => $kode_masalah,
                    'ciri' => 'None',
                    'diagnosis' => $row['diagnosis'],
                    'percentage' => $row['percentage'] / 2 // Setengah persentase
                ];
                $total_percentage += $row['percentage'] / 2;
                $count_results++;
            }
        } elseif (in_array($kode_ciri, $ciri)) {
            // Jika hanya memilih ciri kerusakan saja
            $diagnose_query = "SELECT diagnosis, percentage FROM diagnose WHERE id = " . ($i + 1);
            $diagnose_result = $conn->query($diagnose_query);
            if ($diagnose_result->num_rows > 0) {
                $row = $diagnose_result->fetch_assoc();
                $rules[] = [
                    'masalah' => 'None',
                    'ciri' => $kode_ciri,
                    'diagnosis' => $row['diagnosis'],
                    'percentage' => $row['percentage'] / 2 // Setengah persentase
                ];
                $total_percentage += $row['percentage'] / 2;
                $count_results++;
            }
        }
    }

    // Jika tidak ada hasil diagnosa
    if (empty($rules)) {
        $rules[] = ['diagnosis' => "Diagnosis tidak ditemukan", 'percentage' => 0];
        $total_percentage = 0;
    }

    // Hitung rata-rata persentase (keakuratan deteksi)
    $average_percentage = ($count_results > 0) ? ($total_percentage / $count_results) : 0;

    // Menyimpan hasil deteksi ke dalam tabel `detections`
    $insert_query = "INSERT INTO detections (user_id, conditions, result, percentage, created_at, email) 
                     VALUES (?, ?, ?, ?, NOW(), ?)";

    // Menggabungkan kondisi yang dipilih user
    $conditions_text = implode(", ", array_merge($masalah, $ciri));
    $results_text = implode(", ", array_column($rules, 'diagnosis'));
    $percentage_text = $average_percentage; // Gunakan rata-rata persentase sebagai keakuratan

    // Menyimpan hasil ke database
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssss", $_SESSION['user_id'], $conditions_text, $results_text, $percentage_text, $email);

    if ($stmt->execute()) {
        // Tampilkan hasil diagnosa kepada pengguna
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Hasil Diagnosa</title>
            <link rel='stylesheet' href='assets/css/process.css'>
        </head>
        <body>
            <div class='container'>
                <h3>Hasil Diagnosa</h3>
                <table border='1' style='width: 100%; text-align: left;'>
                    <thead>
                        <tr>
                            <th>Kondisi</th>
                            <th>Jenis Kerusakan</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                <tbody>";

        foreach ($rules as $rule) {
            // Menampilkan hasil hanya jika salah satu (masalah atau ciri) dipilih
            $condition_text = "";
            if ($rule['masalah'] != 'None') {
                $masalah_query = "SELECT masalah FROM masalah_kerusakan WHERE kode_masalah = '{$rule['masalah']}'";
                $masalah_result = $conn->query($masalah_query);
                $masalah_row = $masalah_result->fetch_assoc();
                $condition_text .= $masalah_row['masalah'];
            }

            if ($rule['ciri'] != 'None') {
                $ciri_query = "SELECT ciri FROM ciri_kerusakan WHERE kode_ciri = '{$rule['ciri']}'";
                $ciri_result = $conn->query($ciri_query);
                $ciri_row = $ciri_result->fetch_assoc();
                if ($condition_text != "") {
                    $condition_text .= " + "; // Jika sudah ada masalah, tambah tanda "+"
                }
                $condition_text .= $ciri_row['ciri'];
            }

            echo "<tr>
                    <td>{$condition_text}</td>
                    <td>{$rule['diagnosis']}</td>
                    <td>{$rule['percentage']}%</td>
                  </tr>";
        }

        echo "</tbody>
            </table>
            <p>Keakuratan Deteksi: <strong>{$average_percentage}%</strong></p>
            <a href='index.php' class='button'>Kembali ke Beranda</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
