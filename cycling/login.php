<?php
session_start();
include 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_login.html');
    exit;
}
$usernameInput = trim($_POST['username'] ?? '');
$passwordInput = trim($_POST['password'] ?? '');
if ($usernameInput === '' || $passwordInput === '') {
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><title>Login</title></head><body>
<div class="gear-bg gear-bg--large" aria-hidden="true"></div>
<div class="gear-bg gear-bg--small" aria-hidden="true"></div>
<div class="gear-bg gear-bg--mid"   aria-hidden="true"></div><div class="container py-5"><div class="alert alert-danger">Username and password are required.</div><a class="btn btn-primary" href="admin_login.html">Back to login</a></div></body></html>';
    exit;
}
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('SELECT * FROM user WHERE username = :username AND password = :password LIMIT 1');
    $stmt->execute([':username' => $usernameInput, ':password' => $passwordInput]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header('Location: admin_menu.php');
        exit;
    }
} catch (PDOException $e) {}
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><title>Login</title></head><body>
<div class="gear-bg gear-bg--large" aria-hidden="true"></div>
<div class="gear-bg gear-bg--small" aria-hidden="true"></div>
<div class="gear-bg gear-bg--mid"   aria-hidden="true"></div><div class="container py-5"><div class="alert alert-danger">Incorrect username or password.</div><a class="btn btn-primary" href="admin_login.html">Back to login</a></div></body></html>';
?>