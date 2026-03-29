<?php
include("config/connection.php");
include("components/auth_check.php"); // Starts session and handles redir if needed
// check_access([]); // Allow all logged-in users to view dashboard

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
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="welcome-header">
            <h1>Executive Dashboard</h1>
            <p>Real-time insights into Nepal Telecom's digital infrastructure.</p>
        </div>
        
        <!-- Hero Grid with Images -->
        <div class="hero-grid">
            <!-- Projects Card -->
            <a href="manage_projects.php" class="image-card">
                <img src="assets/img_projects.png" alt="Projects" class="card-bg">
                <div class="card-overlay">
                    <div class="card-count"><?php echo $count_projects; ?></div>
                    <div class="card-label">Active Projects</div>
                    <div class="card-action">Manage Workflow &rarr;</div>
                </div>
            </a>

            <!-- Servers Card -->
            <a href="manage_servers.php" class="image-card">
                <img src="assets/img_servers.png" alt="Servers" class="card-bg">
                <div class="card-overlay">
                    <div class="card-count"><?php echo $count_servers; ?></div>
                    <div class="card-label">Operational Servers</div>
                    <div class="card-action">View Infrastructure &rarr;</div>
                </div>
            </a>

            <!-- Users Card (Super Admin Only) -->
            <?php if ($_SESSION['user_type'] === 'Super_Admin'): ?>
            <a href="manage_users.php" class="image-card">
                <img src="assets/img_users.png" alt="Users" class="card-bg">
                <div class="card-overlay">
                    <div class="card-count"><?php echo $count_users; ?></div>
                    <div class="card-label">System Users</div>
                    <div class="card-action">Access Directory &rarr;</div>
                </div>
            </a>
            <?php endif; ?>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="table-header">
                <h3 class="table-title">Recent User Activity</h3>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Showing latest 5 users for cleanliness
                        $users_query = "SELECT * FROM users ORDER BY userId DESC LIMIT 5";
                        $users_result = mysqli_query($conn, $users_query);
                        
                        if(mysqli_num_rows($users_result) > 0) {
                            while($user = mysqli_fetch_assoc($users_result)) {
                                echo "<tr>
                                    <td>#{$user['userId']}</td>
                                    <td style='font-weight: 600;'>{$user['full_name']}</td>
                                    <td>" . ($user['username'] ?? '-') . "</td>
                                    <td><span style='background: #e0e7ff; color: #4338ca; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;'>" . ($user['user_type'] ?? 'General') . "</span></td>
                                    <td>{$user['email']}</td> 
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center; color: var(--text-muted); padding: 2rem;'>No recent activity found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
