<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: utama.php");
    exit();
}

include 'includes/header.php';
require 'db/config.php'; // Database configuration file
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<main>
    <div class="container mt-4">
        <h1 class="mb-4">Manage Users</h1>

        <div class="table-responsive">
            <?php
            // Fetch users from the database
            $query = "SELECT id, email, role FROM users";
            $result = mysqli_query($conn, $query);

            if ($result) { // Check if query was successful
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table table-striped">';
                    echo '<thead><tr><th>ID</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr id="row-' . $row['id'] . '">';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['role'] . '</td>';
                        echo '<td>';
                        echo '<button class="btn btn-primary btn-sm me-2" onclick="openEditModal(' . $row['id'] . ', \'' . $row['email'] . '\', \'' . $row['role'] . '\')">Edit</button>';
                        echo '<button class="btn btn-danger btn-sm" onclick="deleteUser(' . $row['id'] . ')">Delete</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No users found.</p>';
                }
            } else {
                echo '<p>Error retrieving users: ' . mysqli_error($conn) . '</p>';
            }
            ?>
        </div>
    </div>
</main>

<!-- Bootstrap Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role:</label>
                        <select class="form-select" id="editRole" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Open the modal and populate fields with current user data
function openEditModal(id, email, role) {
    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    document.getElementById('editUserId').value = id;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    modal.show();
}

// Handle form submission via AJAX
document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('update_user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Update the table row with new values
            const row = document.querySelector(`#row-${formData.get('id')}`);
            if (row) {
                row.cells[1].innerText = formData.get('email');
                row.cells[2].innerText = formData.get('role');
            }
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        } else {
            alert('Failed to update user: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the user.');
    });
});

// Handle delete action via AJAX
function deleteUser(id) {
    if (confirm('Are you sure you want to delete this user?')) {
        fetch('delete_user.php', {
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
                alert('Failed to delete user: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the user.');
        });
    }
}
</script>

<?php include 'includes/footer.php'; ?>
