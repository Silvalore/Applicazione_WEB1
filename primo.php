<?php
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$file = 'users.json';

$users = [];
if(file_exists($file)){
    $json = file_get_contents($file);
    $users = json_decode($json, true);
    if(!is_array($users)) $users = [];
}

foreach($users as $user){
    if($user['username'] === $username){
        echo "username già registrato. <a href='registrazione.html'>Torna indietro</a>";
        exit;
    }
}

$users[] = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];

file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));

echo "registrazione completata con successo. <a href='login.html'>Vai al login</a>";
?>