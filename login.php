<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$file = 'users.json';
$users = [];

if(file_exists($file)){
    $json = file_get_contents($file);
    $users = json_decode($json, true);
    if(!is_array($users)) $users = [];
}

$foundUser = null;
foreach($users as $user){
    if($user['username'] === $username){
        $foundUser = $user;
        break;
    }
}

if($foundUser && password_verify($password, $foundUser['password'])){
    $_SESSION['username'] = $username;
    echo "Benvenuto, ";
} else {
    echo "Username o password errati. <a href='login.html'>Riprova</a>";
}
?>