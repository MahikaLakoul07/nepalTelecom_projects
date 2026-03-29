<?php
// components/auth_check.php

// Ensure session is started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if not logged in
if (!isset($_SESSION['userId'])) {
    header("Location: index.php");
    exit();
}

/**
 * Check if the current user has permission to access the page.
 * @param array $allowed_roles Array of allowed user types (e.g., ['Admin', 'Super_Admin'])
 */
function check_access($allowed_roles) {
    // If empty, allow everyone who is logged in
    if (empty($allowed_roles)) {
        return;
    }

    $current_role = $_SESSION['user_type'] ?? 'General';

    if (!in_array($current_role, $allowed_roles)) {
        echo "<script>
            alert('Access Denied: You do not have permission to view this page.');
            window.location.href='welcome.php';
        </script>";
        exit();
    }
}
?>
