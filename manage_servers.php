<?php
include("config/connection.php");
include("components/auth_check.php");
check_access(['Admin', 'Super_Admin']);

// Handle Add Server
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_server'])) {
    $server_name = mysqli_real_escape_string($conn, $_POST['server_name']);
    $ip_address = mysqli_real_escape_string($conn, $_POST['ip_address']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $operation_system = mysqli_real_escape_string($conn, $_POST['operation_system']);

    $sql = "INSERT INTO servers (server_name, ip_address, location, operation_system) VALUES ('$server_name', '$ip_address', '$location', '$operation_system')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Server added successfully'); window.location.href='manage_servers.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM servers WHERE serverId=$id");
    header("Location: manage_servers.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Servers - Nepal Telecom</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Servers</h1>
        </div>

        <!-- Add Form -->
        <div class="card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Add New Server</h3>
            <form method="POST" action="">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1rem; align-items: end;">
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="server_name" placeholder=" " required>
                        <label class="input-label">Server Name</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="ip_address" placeholder=" " required>
                        <label class="input-label">IP Address</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="location" placeholder=" " required>
                        <label class="input-label">Location</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="operation_system" placeholder=" " required>
                        <label class="input-label">OS</label>
                    </div>
                </div>
                <div style="margin-top: 1rem; text-align: right;">
                    <button type="submit" name="add_server" class="btn-primary" style="margin-top: 0; width: auto; padding: 0.75rem 2rem; display: inline-block;">Add Server</button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Server Name</th>
                        <th>IP Address</th>
                        <th>Location</th>
                        <th>OS</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM servers");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['serverId']}</td>
                            <td style='font-weight: 500; color: var(--text-dark);'>{$row['server_name']}</td>
                            <td>{$row['ip_address']}</td>
                            <td>{$row['location']}</td>
                            <td>{$row['operation_system']}</td>
                            <td>
                                <a href='manage_servers.php?delete={$row['serverId']}' class='action-link delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
