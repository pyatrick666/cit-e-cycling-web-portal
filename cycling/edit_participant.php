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
    <title>Update participants score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="gear-bg gear-bg--large" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--small" aria-hidden="true"></div>
    <div class="gear-bg gear-bg--mid" aria-hidden="true"></div>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 mb-0">Update participant score</h1>
            <div><a href="view_participants_edit_delete.php" class="btn btn-outline-secondary me-2">Back</a><a href="logout.php" class="btn btn-outline-danger">Logout</a></div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <?php
                include 'dbconnect.php';
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
                        $power_output = trim($_POST['power_output'] ?? '');
                        $distance = trim($_POST['distance'] ?? '');
                        $errors = [];
                        if ($id <= 0) $errors[] = 'Invalid participant selected.';
                        if ($power_output === '' || !is_numeric($power_output) || $power_output < 0) $errors[] = 'Power output must be a valid positive number.';
                        if ($distance === '' || !is_numeric($distance) || $distance < 0) $errors[] = 'Distance must be a valid positive number.';

                        if ($errors) {
                            echo '<div class="alert alert-danger"><ul class="mb-0">';
                            foreach ($errors as $error) echo '<li>' . htmlspecialchars($error) . '</li>';
                            echo '</ul></div>';
                        } else {
                            $stmt = $conn->prepare('UPDATE participant SET power_output = :power_output, distance = :distance WHERE id = :id');
                            $stmt->execute([':power_output' => $power_output, ':distance' => $distance, ':id' => $id]);
                            echo '<div class="alert alert-success">Participant scores updated successfully.</div>';
                            echo '<a href="view_participants_edit_delete.php" class="btn btn-primary">Return to participants</a>';
                        }
                    } else {
                        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                        if ($id <= 0) {
                            echo '<div class="alert alert-danger">Invalid participant selected.</div>';
                        } else {
                            $stmt = $conn->prepare('SELECT * FROM participant WHERE id = :id LIMIT 1');
                            $stmt->execute([':id' => $id]);
                            $participant = $stmt->fetch(PDO::FETCH_ASSOC);
                            if (!$participant) {
                                echo '<div class="alert alert-danger">Participant not found.</div>';
                            } else {
                                include 'edit_participant_form.php';
                            }
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger">Unable to process the participant update.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>