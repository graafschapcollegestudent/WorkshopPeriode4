<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klant Toevoegen</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="toevoegen-container">
    <h2>Nieuwe klant toevoegen</h2>
    <form action="" method="post">
        <input type="text" name="voornaam" id="voornaam" placeholder="Voornaam" required>
        <input type="text" name="achternaam" id="achternaam" placeholder="Achternaam" required>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <input type="text" name="telefoon" id="telefoon" placeholder="Telefoon" required>
        <input type="text" name="adres" id="adres" placeholder="Adres" required>
        <input type="text" name="opmerking" id="opmerking" placeholder="Opmerking">
        <input type="submit" value="Toevoegen" name="submit">
    </form>
    <?php
    include_once '../src/kosten.php';
    include_once '../src/klant.php';
    $nieuweKlant = new Klant();

    if (isset($_POST['submit'])) {
        $naam = "{$_POST['voornaam']} {$_POST['achternaam']}";
        $adres = $_POST['adres'];
        $telefoon = $_POST['telefoon'];
        $email = $_POST['email'];
        $opmerking = $_POST['opmerking'];

        if ($nieuweKlant->voegKlantToe($naam, $adres, $telefoon, $email, $opmerking)) {
            header('Location: index.php');
            exit;
        } else {
            echo "<div style='color:#b00; margin-top:10px;'>Het toevoegen is niet gelukt.</div>";
        }
    }
    ?>
  </div>
</body>
</html>