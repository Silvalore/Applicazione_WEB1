<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$file = 'users.json';
$users = [];

if (file_exists($file)) {
    $json = file_get_contents($file);
    $users = json_decode($json, true) ?: [];
}

foreach ($users as $user) {
    if ($user['username'] === $username) {
        echo "Username già esistente. <a href='registrazione.html'>Torna indietro</a>";
        exit;
    }
}

$users[] = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

echo "Registrazione completata. <a href='login.html'>Vai al login</a>";
?>
