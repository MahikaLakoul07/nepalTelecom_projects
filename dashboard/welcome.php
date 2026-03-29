<?php
include("../config/connection.php");
// Counts
$count_projects = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM projects"));
$count_servers = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM servers"));
$count_users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Nepal Telecom Projects</title>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
</head>
<body class="dashboard-body">

    <?php include '../components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="welcome-card">
            <h1 style="color: var(--primary-dark); font-size: 2.5rem; margin-bottom: 1rem;">Welcome to the Portal</h1>
            <p style="color: var(--text-dark); font-size: 1.1rem; max-width: 600px; margin: 0 auto;">
                You have successfully logged in. This is your project dashboard where you can manage upcoming tasks and view reports.
            </p>
            
            <div style="margin-top: 3rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <!-- Dashboard cards -->
                <div style="background:#f1f5f9; padding: 2rem; border-radius: 12px; text-align: left; transition: transform 0.2s; cursor: pointer;" onclick="window.location.href='manage_projects.php'">
                    <h3 style="color:var(--text-dark); margin-bottom: 0.5rem;">Active Projects</h3>
                    <p style="font-size: 2.5rem; font-weight: 700; color: var(--primary); margin:0;"><?php echo $count_projects; ?></p>
                    <span style="font-size: 0.9rem; color: var(--text-muted);">Manage Projects &rarr;</span>
                </div>

                <div style="background:#f1f5f9; padding: 2rem; border-radius: 12px; text-align: left; transition: transform 0.2s; cursor: pointer;" onclick="window.location.href='manage_servers.php'">
                    <h3 style="color:var(--text-dark); margin-bottom: 0.5rem;">Servers</h3>
                    <p style="font-size: 2.5rem; font-weight: 700; color: var(--accent); margin:0;"><?php echo $count_servers; ?></p>
                    <span style="font-size: 0.9rem; color: var(--text-muted);">View Infrastructure &rarr;</span>
                </div>

                <div style="background:#f1f5f9; padding: 2rem; border-radius: 12px; text-align: left;">
                    <h3 style="color:var(--text-dark); margin-bottom: 0.5rem;">Total Users</h3>
                    <p style="font-size: 2.5rem; font-weight: 700; color: var(--text-dark); margin:0;"><?php echo $count_users; ?></p>
                    <span style="font-size: 0.9rem; color: var(--text-muted);">System Users</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>