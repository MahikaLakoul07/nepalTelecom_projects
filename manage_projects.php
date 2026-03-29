<?php
include("config/connection.php");
include("components/auth_check.php");
check_access(['Admin', 'Super_Admin']);

// Handle Add Project
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_project'])) {
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $languageId = mysqli_real_escape_string($conn, $_POST['languageId']);
    $databaseId = mysqli_real_escape_string($conn, $_POST['databaseId']);
    $developed_by = mysqli_real_escape_string($conn, $_POST['developed_by']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "INSERT INTO projects (project_name, description, languageId, databaseId, developed_by, start_date, status) 
            VALUES ('$project_name', '$description', '$languageId', '$databaseId', '$developed_by', '$start_date', '$status')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Project added successfully'); window.location.href='manage_projects.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM projects WHERE projectId=$id");
    header("Location: manage_projects.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - Nepal Telecom</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="dashboard-body">

    <?php include 'components/nav.php'; ?>

    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Projects</h1>
        </div>

        <!-- Add Form -->
        <div class="card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1rem; color: var(--text-dark);">Add New Project</h3>
            <form method="POST" action="">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; align-items: end;">
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="project_name" placeholder=" " required>
                        <label class="input-label">Project Name</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="text" class="input-field" name="developed_by" placeholder=" " required>
                        <label class="input-label">Lead Developer</label>
                    </div>
                    <div class="input-group" style="margin-bottom: 0;">
                        <input type="date" class="input-field" name="start_date" placeholder=" " required>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">Start Date</label>
                    </div>

                    <div class="input-group" style="margin-bottom: 0;">
                        <select class="input-field" name="languageId">
                            <option value="">Select Language</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT languageId, language_name FROM programming_language");
                            while($r = mysqli_fetch_assoc($res)){
                                echo "<option value='{$r['languageId']}'>{$r['language_name']}</option>";
                            }
                            ?>
                        </select>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">Language</label>
                    </div>
                    
                    <div class="input-group" style="margin-bottom: 0;">
                        <select class="input-field" name="databaseId">
                            <option value="">Select Database</option>
                            <?php
                            $res = mysqli_query($conn, "SELECT databaseId, database_name FROM database_used");
                            while($r = mysqli_fetch_assoc($res)){
                                echo "<option value='{$r['databaseId']}'>{$r['database_name']}</option>";
                            }
                            ?>
                        </select>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">Database</label>
                    </div>

                    <div class="input-group" style="margin-bottom: 0;">
                        <select class="input-field" name="status">
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                            <option value="On hold">On Hold</option>
                        </select>
                        <label class="input-label" style="top: -0.5rem; font-size: 0.75rem; color: var(--primary);">Status</label>
                    </div>
                </div>
                <div class="input-group" style="margin-top: 1rem; margin-bottom: 0;">
                     <input type="text" class="input-field" name="description" placeholder=" ">
                     <label class="input-label">Description</label>
                </div>
                
                <div style="margin-top: 1rem; text-align: right;">
                    <button type="submit" name="add_project" class="btn-primary" style="margin-top: 0; width: auto; padding: 0.75rem 2rem; display: inline-block;">Create Project</button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Project Name</th>
                        <th>Developer</th>
                        <th>Lang</th>
                        <th>DB</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q = "SELECT p.*, l.language_name, d.database_name 
                          FROM projects p 
                          LEFT JOIN programming_language l ON p.languageId = l.languageId 
                          LEFT JOIN database_used d ON p.databaseId = d.databaseId";
                    $result = mysqli_query($conn, $q);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$row['projectId']}</td>
                            <td style='font-weight: 500; color: var(--text-dark);'>{$row['project_name']}</td>
                            <td>{$row['developed_by']}</td>
                            <td>{$row['language_name']}</td>
                            <td>{$row['database_name']}</td>
                            <td><span style='padding: 0.25rem 0.75rem; border-radius: 99px; background: #e0e7ff; color: var(--primary); font-size: 0.85rem; font-weight: 600;'>{$row['status']}</span></td>
                            <td>
                                <a href='manage_projects.php?delete={$row['projectId']}' class='action-link delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
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
