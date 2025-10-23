<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$file = 'users.json';
$users = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $users = json_decode($json, true) ?: [];
}

foreach ($users as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    }
}

echo "Username o password errati. <a href='login.html'>Riprova</a>";
?>
