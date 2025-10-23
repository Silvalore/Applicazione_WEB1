<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';

    if ($nome && $cognome) {
        $file = 'persone.json';
        $persone = [];

        if (file_exists($file)) {
            $persone = json_decode(file_get_contents($file), true) ?: [];
        }

        $persone[] = [
            'nome' => $nome,
            'cognome' => $cognome,
            'inserito_da' => $_SESSION['username']
        ];

        file_put_contents($file, json_encode($persone, JSON_PRETTY_PRINT));

        echo "Persona aggiunta con successo. <a href='dashboard.php'>Torna alla dashboard</a>";
        exit;
    } else {
        echo "Compila tutti i campi.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Aggiungi Persona</title></head>
<body>
  <h2>Aggiungi una persona</h2>
  <form method="POST">
    Nome: <input type="text" name="nome" required><br><br>
    Cognome: <input type="text" name="cognome" required><br><br>
    <button type="submit">Aggiungi</button>
  </form>
  <p><a href="dashboard.php">Torna alla dashboard</a></p>
</body>
</html>
