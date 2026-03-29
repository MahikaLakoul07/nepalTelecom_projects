<?php
include("config/connection.php");
include("components/auth_check.php");
check_access(['Admin', 'Super_Admin']);

// Handle Add Language
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_language'])) {
    $language_name = mysqli_real_escape_string($conn, $_POST['language_name']);
    $version = mysqli_real_escape_string($conn, $_POST['version']);

    $sql = "INSERT INTO programming_language (language_name, version) VALUES ('$language_name', '$version')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Language added successfully'); window.location.href='manage_languages.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM programming_language WHERE languageId=$id");
    header("Location: manage_languages.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Languages - Nepal Telecom</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Programming Languages</h1>
        </div>

        <!-- Add Form -->
        <div class="card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Add New Language</h3>
            <form method="POST" action="">
                <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="language_name" placeholder=" " required>
                        <label class="input-label">Language Name</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="version" placeholder=" ">
                        <label class="input-label">Version</label>
                    </div>
                    <button type="submit" name="add_language" class="btn-primary" style="margin-top: 0; width: auto; padding: 0.75rem 2rem;">Add</button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Language Name</th>
                        <th>Version</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM programming_language");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['languageId']}</td>
                            <td style='font-weight: 500; color: var(--text-dark);'>{$row['language_name']}</td>
                            <td>{$row['version']}</td>
                            <td>
                                <a href='manage_languages.php?delete={$row['languageId']}' class='action-link delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
