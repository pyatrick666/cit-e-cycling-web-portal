<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register your interest</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"><div class="container py-5"><div class="row justify-content-center"><div class="col-12 col-md-8 col-lg-6"><div class="card shadow-sm"><div class="card-body p-4">
<a href="." class="btn btn-outline-secondary btn-sm mb-3">Back to index</a>
<?php
include 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<div class="alert alert-warning">Invalid request.</div>';
} else {
    $firstname = trim($_POST['firstname'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $terms = isset($_POST['terms']) ? 1 : 0;
    $errors = [];
    if ($firstname === '' || strlen($firstname) > 50) $errors[] = 'Please enter a valid firstname.';
    if ($surname === '' || strlen($surname) > 50) $errors[] = 'Please enter a valid surname.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) $errors[] = 'Please enter a valid email address.';
    if ($terms !== 1) $errors[] = 'You must accept the terms and conditions.';
    if ($errors) {
        echo '<div class="alert alert-danger"><ul class="mb-0">';
        foreach ($errors as $error) echo '<li>' . htmlspecialchars($error) . '</li>';
        echo '</ul></div><a href="register_form.html" class="btn btn-primary">Back to form</a>';
    } else {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('INSERT INTO interest (firstname, surname, email, terms) VALUES (:firstname, :surname, :email, :terms)');
            $stmt->execute([':firstname' => $firstname, ':surname' => $surname, ':email' => $email, ':terms' => $terms]);
            echo '<div class="alert alert-success">Thank you. Your interest has been registered successfully.</div><a href="register_form.html" class="btn btn-primary me-2">Register another interest</a><a href="." class="btn btn-outline-secondary">Return to home</a>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger">Unable to save your details at the moment.</div>';
        }
    }
}
?>
</div></div></div></div></div></body></html>
