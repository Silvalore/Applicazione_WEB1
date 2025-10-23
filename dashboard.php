<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
  <h2>Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <p><a href="aggiungi_persona.php">Aggiungi una persona</a></p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>
