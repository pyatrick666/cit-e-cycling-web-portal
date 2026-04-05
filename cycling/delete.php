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
    <title>Delete participant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="gear-bg gear-bg--large" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--small" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--mid" aria-hidden="true"></div>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Delete participant</h1>
            <div><a href="view_participants_edit_delete.php" class="btn btn-outline-secondary me-2">Back</a><a href="logout.php" class="btn btn-outline-danger">Logout</a></div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?php
                include 'dbconnect.php';
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
                        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
                        if ($id <= 0) {
                            echo '<div class="alert alert-danger">Invalid participant selected.</div>';
                        } else {
                            $stmt = $conn->prepare('DELETE FROM participant WHERE id = :id');
                            $stmt->execute([':id' => $id]);
                            echo '<div class="alert alert-success">Participant deleted successfully.</div>';
                            echo '<a href="view_participants_edit_delete.php" class="btn btn-primary">Return to participants</a>';
                        }
                    } else {
                        $id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['id']) ? (int)$_POST['id'] : 0);
                        if ($id <= 0) {
                            echo '<div class="alert alert-danger">Invalid participant selected.</div>';
                        } else {
                            $stmt = $conn->prepare('SELECT firstname, surname, email FROM participant WHERE id = :id LIMIT 1');
                            $stmt->execute([':id' => $id]);
                            $participant = $stmt->fetch(PDO::FETCH_ASSOC);
                            if (!$participant) {
                                echo '<div class="alert alert-danger">Participant not found.</div>';
                            } else {
                                echo '<div class="alert alert-warning">Please confirm that you want to delete this participant. This action cannot be undone.</div>';
                                echo '<ul class="list-group mb-3">';
                                echo '<li class="list-group-item"><strong>Name:</strong> ' . htmlspecialchars($participant['firstname'] . ' ' . $participant['surname']) . '</li>';
                                echo '<li class="list-group-item"><strong>Email:</strong> ' . htmlspecialchars($participant['email']) . '</li>';
                                echo '</ul>';
                                echo '<form method="POST" action="delete.php">';
                                echo '<input type="hidden" name="id" value="' . htmlspecialchars($id) . '">';
                                echo '<button type="submit" name="confirm_delete" value="1" class="btn btn-danger me-2">Yes, delete participant</button>';
                                echo '<a href="view_participants_edit_delete.php" class="btn btn-secondary">Cancel</a>';
                                echo '</form>';
                            }
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Unable to process the participant deletion.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>