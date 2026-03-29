<?php
include("config/connection.php");
include("components/auth_check.php");
check_access(['Super_Admin']);

// Handle Delete Request
if(isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    $sql = "DELETE FROM users WHERE userId = '$id'";
    if(mysqli_query($conn, $sql)) {
        echo "<script>alert('User deleted successfully.'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Nepal Telecom Projects</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">User Management</h1>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">View and manage registered system users.</p>
        </div>

        <div class="card">
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM users ORDER BY userId DESC";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>#{$row['userId']}</td>
                                    <td><strong>{$row['full_name']}</strong></td>
                                    <td>" . ($row['username'] ?? '-') . "</td>
                                    <td><span style='background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;'>" . ($row['user_type'] ?? 'General') . "</span></td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone_no']}</td>
                                    <td>
                                        <a href='manage_users.php?delete={$row['userId']}' class='action-link delete' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align: center; padding: 2rem;'>No users found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
