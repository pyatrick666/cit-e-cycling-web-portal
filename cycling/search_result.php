<?php
session_start();

if (empty($_SESSION['admin_logged_in'])) {

    header('Location: admin_login.html');
    exit;
}

include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search results</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>

    <div class="gear-bg gear-bg--large"></div>
    <div class="gear-bg gear-bg--small"></div>
    <div class="gear-bg gear-bg--mid"></div>

    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h1 class="h2 mb-0">
                Search results
            </h1>

            <div>

                <a href="search_form.php"
                    class="btn btn-outline-secondary me-2">
                    Back to search
                </a>

                <a href="admin_menu.php"
                    class="btn btn-outline-secondary">
                    Admin menu
                </a>

            </div>

        </div>

        <?php

        try {

            $conn = new PDO(
                "mysql:host=$servername;dbname=$database",
                $username,
                $password
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            if (isset($_POST['participant'])) {

                $term = trim($_POST['firstname'] ?? '');

                if ($term === '') {

                    echo '<div class="alert alert-danger">
Please enter a participant name.
</div>';
                } else {

                    $stmt = $conn->prepare(
                        'SELECT p.*, c.name AS club_name,
c.location AS club_location
FROM participant p
LEFT JOIN club c
ON p.club_id = c.id
WHERE p.firstname LIKE :term
OR p.surname LIKE :term
ORDER BY p.surname'
                    );

                    $stmt->execute([
                        ':term' => "%$term%"
                    ]);

                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$rows) {

                        echo '<div class="alert alert-warning">
No participant found.
</div>';
                    } else {

                        echo '
<div class="card card-glass shadow-sm">
<div class="card-body">

<div class="table-responsive">

<table class="table table-striped">

<thead>

<tr>

<th>ID</th>
<th>Firstname</th>
<th>Surname</th>
<th>Email</th>
<th>Power</th>
<th>Distance</th>
<th>Club</th>
<th>Location</th>

</tr>

</thead>

<tbody>';

                        foreach ($rows as $r) {

                            echo '<tr>

<td>' . htmlspecialchars($r['id']) . '</td>

<td>' . htmlspecialchars($r['firstname']) . '</td>

<td>' . htmlspecialchars($r['surname']) . '</td>

<td>' . htmlspecialchars($r['email']) . '</td>

<td>' . htmlspecialchars($r['power_output']) . '</td>

<td>' . htmlspecialchars($r['distance']) . '</td>

<td>' . htmlspecialchars($r['club_name'] ?? 'Individual') . '</td>

<td>' . htmlspecialchars($r['club_location'] ?? '-') . '</td>

</tr>';
                        }

                        echo '

</tbody>
</table>

</div>
</div>
</div>';
                    }
                }
            } else {

                $club = trim($_POST['club'] ?? '');

                if ($club === '') {

                    echo '<div class="alert alert-danger">
Please enter club name.
</div>';
                } else {

                    $stmt = $conn->prepare(
                        'SELECT * FROM club
WHERE name LIKE :club'
                    );

                    $stmt->execute([
                        ':club' => "%$club%"
                    ]);

                    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (!$clubs) {

                        echo '<div class="alert alert-warning">
No club found.
</div>';
                    } else {

                        foreach ($clubs as $c) {

                            echo '

<div class="card card-glass shadow-sm mb-4">

<div class="card-body">

<h2 class="h4">'
                                . htmlspecialchars($c['name']) . '
</h2>

<p class="text-muted">
Location:
' . htmlspecialchars($c['location']) . '
</p>

</div>
</div>';
                        }
                    }
                }
            }
        } catch (PDOException $e) {

            echo '<div class="alert alert-danger">
Database error occurred.
</div>';
        }

        ?>

    </div>

</body>

</html>