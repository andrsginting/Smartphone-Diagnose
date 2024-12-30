<?php
require 'db/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    // Cegah SQL Injection
    $query = "DELETE FROM detections WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Data Berhasil Dihapus']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal Menghapus Data']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>