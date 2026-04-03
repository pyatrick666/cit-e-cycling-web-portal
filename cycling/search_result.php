<?php
session_start();
if (empty($_SESSION['admin_logged_in'])) { header('Location: admin_login.html'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search results</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><div class="container py-5"><div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h2 mb-0">Search results</h1><div><a href="search_form.php" class="btn btn-outline-secondary me-2">Back to search</a><a href="admin_menu.php" class="btn btn-outline-secondary">Admin menu</a></div></div>
<?php
include 'dbconnect.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (isset($_POST['participant']) && $_POST['participant'] == '1') {
        $term = trim($_POST['firstname'] ?? '');
        if ($term === '') {
            echo '<div class="alert alert-danger">Please enter a participant firstname or surname.</div>';
        } else {
            $stmt = $conn->prepare('SELECT p.*, c.name AS club_name, c.location AS club_location FROM participant p LEFT JOIN club c ON p.club_id = c.id WHERE p.firstname LIKE :term OR p.surname LIKE :term ORDER BY p.surname, p.firstname');
            $stmt->execute([':term' => "%$term%"]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$rows) {
                echo '<div class="alert alert-warning">No participant was found for that search.</div>';
            } else {
                echo '<div class="card shadow-sm"><div class="card-body"><div class="table-responsive"><table class="table table-striped align-middle"><thead><tr><th>ID</th><th>Firstname</th><th>Surname</th><th>Email</th><th>Power output</th><th>Distance</th><th>Club</th><th>Location</th></tr></thead><tbody>';
                foreach ($rows as $r) {
                    echo '<tr><td>' . htmlspecialchars($r['id']) . '</td><td>' . htmlspecialchars($r['firstname']) . '</td><td>' . htmlspecialchars($r['surname']) . '</td><td>' . htmlspecialchars($r['email']) . '</td><td>' . htmlspecialchars((string)$r['power_output']) . '</td><td>' . htmlspecialchars((string)$r['distance']) . '</td><td>' . htmlspecialchars($r['club_name'] ?? 'Individual') . '</td><td>' . htmlspecialchars($r['club_location'] ?? '-') . '</td></tr>';
                }
                echo '</tbody></table></div></div></div>';
            }
        }
    } else {
        $club = trim($_POST['club'] ?? '');
        if ($club === '') {
            echo '<div class="alert alert-danger">Please enter a club name.</div>';
        } else {
            $clubStmt = $conn->prepare('SELECT * FROM club WHERE name LIKE :club ORDER BY name');
            $clubStmt->execute([':club' => "%$club%"]);
            $clubs = $clubStmt->fetchAll(PDO::FETCH_ASSOC);
            if (!$clubs) echo '<div class="alert alert-warning">No club was found for that search.</div>';
            foreach ($clubs as $c) {
                $memberStmt = $conn->prepare('SELECT * FROM participant WHERE club_id = :club_id ORDER BY surname, firstname');
                $memberStmt->execute([':club_id' => $c['id']]);
                $members = $memberStmt->fetchAll(PDO::FETCH_ASSOC);
                $statsStmt = $conn->prepare('SELECT COUNT(*) AS total_members, COALESCE(SUM(distance),0) AS total_distance, COALESCE(SUM(power_output),0) AS total_power, COALESCE(AVG(distance),0) AS avg_distance, COALESCE(AVG(power_output),0) AS avg_power FROM participant WHERE club_id = :club_id');
                $statsStmt->execute([':club_id' => $c['id']]);
                $s = $statsStmt->fetch(PDO::FETCH_ASSOC);
                echo '<div class="card shadow-sm mb-4"><div class="card-body"><h2 class="h4 mb-1">' . htmlspecialchars($c['name']) . '</h2><p class="text-muted">Location: ' . htmlspecialchars($c['location']) . '</p>';
                echo '<div class="row g-3 mb-3"><div class="col-6 col-md-3"><div class="border rounded p-3"><strong>Total members</strong><br>' . htmlspecialchars((string)$s['total_members']) . '</div></div><div class="col-6 col-md-3"><div class="border rounded p-3"><strong>Total distance</strong><br>' . htmlspecialchars(number_format((float)$s['total_distance'], 2)) . '</div></div><div class="col-6 col-md-3"><div class="border rounded p-3"><strong>Total power</strong><br>' . htmlspecialchars(number_format((float)$s['total_power'], 2)) . '</div></div><div class="col-6 col-md-3"><div class="border rounded p-3"><strong>Average distance</strong><br>' . htmlspecialchars(number_format((float)$s['avg_distance'], 2)) . '</div></div></div>';
                echo '<div class="mb-3"><div class="border rounded p-3 d-inline-block"><strong>Average power</strong><br>' . htmlspecialchars(number_format((float)$s['avg_power'], 2)) . '</div></div>';
                if (!$members) {
                    echo '<div class="alert alert-warning mb-0">No participants are linked to this club.</div>';
                } else {
                    echo '<div class="table-responsive"><table class="table table-striped align-middle mb-0"><thead><tr><th>ID</th><th>Firstname</th><th>Surname</th><th>Email</th><th>Power output</th><th>Distance</th></tr></thead><tbody>';
                    foreach ($members as $m) {
                        echo '<tr><td>' . htmlspecialchars($m['id']) . '</td><td>' . htmlspecialchars($m['firstname']) . '</td><td>' . htmlspecialchars($m['surname']) . '</td><td>' . htmlspecialchars($m['email']) . '</td><td>' . htmlspecialchars((string)$m['power_output']) . '</td><td>' . htmlspecialchars((string)$m['distance']) . '</td></tr>';
                    }
                    echo '</tbody></table></div>';
                }
                echo '</div></div>';
            }
        }
    }
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Unable to retrieve the search results.</div>';
}
?>
</div></body></html>
