<?php
// nav.php - Reusable Navigation Bar
// nav.php - Reusable Navigation Bar
?>
<nav class="dashboard-nav">
    <a href="welcome.php" class="nav-logo" style="text-decoration: none; color: white;">Nepal Telecom</a>
    <div class="nav-links">
        <a href="welcome.php" style="color: white; text-decoration: none; margin-left: 20px;">Dashboard</a>
        
        <?php 
        // Only show management links to Admins and Super Admins
        if(isset($_SESSION['user_type']) && in_array($_SESSION['user_type'], ['Admin', 'Super_Admin'])): 
        ?>
            <a href="manage_projects.php" style="color: white; text-decoration: none; margin-left: 20px;">Projects</a>
            <a href="manage_servers.php" style="color: white; text-decoration: none; margin-left: 20px;">Servers</a>
            <a href="manage_databases.php" style="color: white; text-decoration: none; margin-left: 20px;">Databases</a>
            <a href="manage_languages.php" style="color: white; text-decoration: none; margin-left: 20px;">Languages</a>
        <?php endif; ?>

        <a href="auth/logout.php" class="btn-primary" style="margin-left: 20px; padding: 0.5rem 1.5rem; text-decoration: none; display: inline-flex; width: auto; font-size: 0.9rem;">Logout</a>
    </div>
</nav>
