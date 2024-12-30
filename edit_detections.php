<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: utama.php");
    exit();
}

include 'includes/header.php';
require 'db/config.php'; // Database configuration file
?>

<link rel="stylesheet" href="assets/css/edit_detections.css">

<main>
    <h1>Manage Detections</h1>
    
    <div class="table-container">
        <?php
        // Fetch detections from the database
        $query = "SELECT id, conditions, result, percentage, created_at, email FROM detections";
        $result = mysqli_query($conn, $query);

        if ($result) { // Check if query was successful
            if (mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr><th>ID</th><th>Conditions</th><th>Result</th><th>Percentage</th><th>Email</th><th>Time</th><th>Action</th></tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr id="row-' . $row['id'] . '">'; // Add row ID for easy DOM manipulation
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['conditions'] . '</td>';
                    echo '<td>' . $row['result'] . '</td>';
                    echo '<td>' . $row['percentage'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['created_at'] . '</td>';
                    echo '<td>';
                    echo '<button class="delete" onclick="deleteUser(' . $row['id'] . ')">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No detections found.</p>';
            }
        } else {
            // Display an error message if the query failed
            echo '<p>Error retrieving detections: ' . mysqli_error($conn) . '</p>';
        }
        ?>
    </div>
</main>

<script>
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this detection?')) {
        fetch('delete_detection.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Remove the row from the table
                const row = document.querySelector(`#row-${id}`);
                if (row) row.remove();
            } else {
                alert('Failed to delete detection: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting detection.');
        });
    }
}
</script>

<?php include 'includes/footer.php'; ?>