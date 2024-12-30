<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db/config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $role = 'user'; // Default role untuk pengguna biasa
    $query = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $email, $hashed_password, $role);

    if ($stmt->execute()) {
        // Login otomatis setelah registrasi
        $_SESSION['user_id'] = $stmt->insert_id; // Dapatkan ID user yang baru dibuat
        $_SESSION['role'] = $role;

        // Set pesan register berhasil
        $_SESSION['message'] = "Register berhasil. Selamat datang!";
        header("Location: index.php");
        exit;
    } else {
        $error_message = "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" class="form">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="show-password">
                <input type="checkbox" id="show-password" onclick="togglePassword()">
                <label for="show-password">Show password</label>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>
