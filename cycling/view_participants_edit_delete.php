<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View participants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="gear-bg gear-bg--large" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--small" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--mid" aria-hidden="true"></div>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">View all participants for edit or delete</h1>
                <p class="text-muted mb-0">Select an action for a participant record.</p>
            </div>
            <div>
                <a href="admin_menu.php" class="btn btn-outline-secondary me-2">Admin menu</a>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            </div>
        </div>
        <?php
        include 'dbconnect.php';
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query('SELECT p.*, c.name AS club_name FROM participant p LEFT JOIN club c ON p.club_id = c.id ORDER BY p.surname, p.firstname');
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$rows) {
                echo '<div class="alert alert-warning">No participants found.</div>';
            } else {
                echo '<div class="card card-glass shadow-sm"><div class="card-body"><div class="table-responsive"><table class="table table-striped align-middle"><thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Power output</th><th>Distance</th><th>Club</th><th>Actions</th></tr></thead><tbody>';
                foreach ($rows as $r) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($r['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($r['firstname'] . ' ' . $r['surname']) . '</td>';
                    echo '<td>' . htmlspecialchars($r['email']) . '</td>';
                    echo '<td>' . htmlspecialchars((string)$r['power_output']) . '</td>';
                    echo '<td>' . htmlspecialchars((string)$r['distance']) . '</td>';
                    echo '<td>' . htmlspecialchars($r['club_name'] ?? 'Individual') . '</td>';
                    echo '<td><a href="edit_participant.php?id=' . urlencode($r['id']) . '" class="btn btn-sm btn-primary me-2">Edit</a><a href="delete.php?id=' . urlencode($r['id']) . '" class="btn btn-sm btn-danger">Delete</a></td>';
                    echo '</tr>';
                }
                echo '</tbody></table></div></div></div>';
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Unable to load participants.</div>';
        }
        ?>
    </div>
</body>

</html>