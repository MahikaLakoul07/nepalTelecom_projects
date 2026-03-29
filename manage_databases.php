<?php
include("config/connection.php");
include("components/auth_check.php");
check_access(['Admin', 'Super_Admin']);

// Handle Add Database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_database'])) {
    $database_name = mysqli_real_escape_string($conn, $_POST['database_name']);
    $db_version = mysqli_real_escape_string($conn, $_POST['db_version']);
    $serverId = mysqli_real_escape_string($conn, $_POST['serverId']);
    $backup_location = mysqli_real_escape_string($conn, $_POST['backup_location']);
    $is_backup_taken = isset($_POST['is_backup_taken']) ? 1 : 0;

    $sql = "INSERT INTO database_used (database_name, db_version, is_backup_taken, backup_location, serverId) 
            VALUES ('$database_name', '$db_version', '$is_backup_taken', '$backup_location', '$serverId')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Database added successfully'); window.location.href='manage_databases.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM database_used WHERE databaseId=$id");
    header("Location: manage_databases.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Databases - Nepal Telecom</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Databases</h1>
        </div>

        <!-- Add Form -->
        <div class="card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Add New Database</h3>
            <form method="POST" action="">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 1rem; align-items: end;">
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="database_name" placeholder=" " required>
                        <label class="input-label">DB Name</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="db_version" placeholder=" ">
                        <label class="input-label">Version</label>
                    </div>
                    
                    <div class="input-group" style="margin-bottom: 0;">
                        <select class="input-field" name="serverId">
                            <option value="">Select Server</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT serverId, server_name FROM servers");
                            while($r = mysqli_fetch_assoc($res)){
                                echo "<option value='{$r['serverId']}'>{$r['server_name']}</option>";
                            }
                            ?>
                        </select>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">Hosted On</label>
                    </div>

                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="backup_location" placeholder=" " >
                        <label class="input-label">Backup Location</label>
                    </div>
                </div>
                <div style="margin-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" id="backup" name="is_backup_taken" value="1">
                        <label for="backup" style="color: var(--text-dark);">Backup Taken?</label>
                    </div>
                    <button type="submit" name="add_database" class="btn-primary" style="margin-top: 0; width: auto; padding: 0.75rem 2rem;">Add Database</button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>DB Name</th>
                        <th>Version</th>
                        <th>Server</th>
                        <th>Backup Path</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT d.*, s.server_name FROM database_used d LEFT JOIN servers s ON d.serverId = s.serverId";
                    $result = mysqli_query($conn, $q);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['databaseId']}</td>
                            <td style='font-weight: 500; color: var(--text-dark);'>{$row['database_name']}</td>
                            <td>" . ($row['db_version'] ?? '-') . "</td>
                            <td>{$row['server_name']}</td>
                            <td>" . ($row['backup_location'] ?? '-') . "</td>
                            <td>
                                <a href='manage_databases.php?delete={$row['databaseId']}' class='action-link delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
