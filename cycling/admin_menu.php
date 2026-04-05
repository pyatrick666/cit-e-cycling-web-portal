<?php session_start();
if (empty($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.html');
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin menu</title>
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
                <h1 class="h2 mb-1">Cit-E Cycling admin portal</h1>
                <p class="text-muted mb-0">Manage participant records and event data.</p>
            </div>
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="card card-glass shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h5">Search participants and clubs</h2>
                        <p class="text-muted">Find individual participants or view a club with totals and averages.</p>
                        <a href="search_form.php" class="btn btn-primary">Open search</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card card-glass shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="h5">Edit or delete participants</h2>
                        <p class="text-muted">Update distance and power output, or remove a participant safely.</p>
                        <a href="view_participants_edit_delete.php" class="btn btn-primary">View participants</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>