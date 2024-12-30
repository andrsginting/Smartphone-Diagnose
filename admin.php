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

<link rel="stylesheet" href="assets/css/admin.css">

<main>
    <h1>Admin Panel</h1>
    <p style="text-align: center;">
        Welcome, Admin! Use the options below to manage database tables.
    </p>

    <section class="container">
        <a href="edit_users.php" class="card card-green">
            <div class="icon">👤</div>
            <div>
                <h2>Manage Users</h2>
                <p>Edit and manage user accounts.</p>
            </div>
        </a>
        <a href="edit_rules.php" class="card card-blue">
            <div class="icon">📜</div>
            <div>
                <h2>Manage Rules</h2>
                <p>Edit and manage Rules.</p>
            </div>
        </a>
        <a href="edit_detections.php" class="card card-red">
            <div class="icon">📊</div>
            <div>
                <h2>Manage Detections</h2>
                <p>Edit and manage Detections Data.</p>
            </div>
        </a>
    </section>
</main>

<?php include 'includes/footer.php'; ?>